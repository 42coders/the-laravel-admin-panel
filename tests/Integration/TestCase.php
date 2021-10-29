<?php

namespace the42coders\TLAP\Tests\Integration;

use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use the42coders\TLAP\TLAP;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom('tests/database/migrations');
        $this->loadDefaultConfig();
        $this->setUpViews();
        $this->generateAppKey();
        $this->setUpRoutes();
    }

    protected function loadDefaultConfig(): void
    {
        config(['tlap' => $this->getDefaultConfig()]);
    }

    protected function getDefaultConfig(): array
    {
        return include __DIR__ . '/../../config/config.php';
    }

    protected function setUpViews(): void
    {
        View::addNamespace('tlap', __DIR__ . '/../../resources/views');
        View::addLocation(__DIR__ . '/../../resources/views');
    }

    protected function generateAppKey(): void
    {
        $key = base64_encode(Encrypter::generateKey('AES-256-CBC'));
        config(['app.key' => 'base64:' . $key]);
    }

    protected function setUpRoutes(): void
    {
        Route::middleware('web')->group(function () {
            TLAP::routes();
        });
    }
}
