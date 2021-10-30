<?php

namespace the42coders\TLAP\Tests\models;

use Illuminate\Database\Eloquent\Model;
use the42coders\TLAP\Traits\TLAPAdminTrait;

class User extends Model
{
    use TLAPAdminTrait;

    protected $guarded = [];

}
