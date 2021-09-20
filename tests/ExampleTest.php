<?php

namespace MaxHutschenreiter\TLAP\Tests;

use Orchestra\Testbench\TestCase;
use MaxHutschenreiter\TLAP\TLAPServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [TLAPServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
