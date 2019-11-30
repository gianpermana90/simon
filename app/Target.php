<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    protected $table = 'target';

    protected $primarykey = 'id';

    public $timestamps = false;
}
