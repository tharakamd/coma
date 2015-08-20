<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $table = 'code';
    public $primaryKey = 'code_id';
    public $timestamps = false;
}
