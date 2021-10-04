<?php

namespace the42coders\TLAP\Filters;

use Illuminate\Support\Carbon;

class FormatTimestamps
{
    public function filter($value){
        if(empty($value)){
            return $value;
        }

        $carbon = new Carbon($value);

        return $carbon->format('d.m.Y H:i');
    }
}
