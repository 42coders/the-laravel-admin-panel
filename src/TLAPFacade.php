<?php

namespace the42coders\TLAP;

use Illuminate\Support\Facades\Facade;

/**
 * @see \MaxHutschenreiter\TLAP\Skeleton\SkeletonClass
 */
class TLAPFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'tlap';
    }
}
