<?php

namespace the42coders\TLAP\Filters;

class ShortenTextFilter
{
    public function filter($value){
        return substr($value, 0, 150);
    }
}
