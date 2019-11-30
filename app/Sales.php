<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'sales';

    protected $primarykey = 'id';
    
    public $timestamps = false;    
}
