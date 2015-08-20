<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'assignment';
    public $primaryKey = 'assignment_id';
    public $timestamps = false;
}
