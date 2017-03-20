<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    //
//    protected  $hidden = ['body'];
protected $fillable = ['title','body','free'];
}
