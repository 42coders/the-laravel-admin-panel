<?php

namespace the42coders\TLAP\Tests;

use Orchestra\Testbench\TestCase;
use the42coders\TLAP\TLAPServiceProvider;

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
