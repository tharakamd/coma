<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    protected $table = 'course';
    protected $primaryKey = ['course_id','user_id'];
    public $timestamps = false;

}
