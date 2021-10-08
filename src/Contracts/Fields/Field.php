<?php

namespace the42coders\TLAP\Contracts\Fields;

use Illuminate\Database\Eloquent\Model;

interface Field
{
    public function getValue(Model $model = null);

    public function getInput($value);

    public function render($model = null);

    public function __toString();
}
