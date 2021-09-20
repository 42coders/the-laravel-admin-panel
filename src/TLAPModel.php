<?php


namespace the42coders\TLAP;


use the42coders\TLAP\Fields\TextField;

class TLAPModel
{

    static function getModel($name)
    {
        $model = config('tlap.models.'.$name);

        return new $model();
    }


}
