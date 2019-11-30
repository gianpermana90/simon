<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'user';

    protected $primarykey = 'id';

    public $timestamps = false;
}
