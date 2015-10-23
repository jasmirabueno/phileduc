<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
     protected $table = 'lectures';
    
     protected $fillable = [
         'lecture_name',
         'course_id',
         'lecture_description',
         'video',
         ];
}
