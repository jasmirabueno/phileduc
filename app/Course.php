<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    
    protected $fillable = [
         'course_name',
         'course_description',
         'prof_id',
         'course_image',
         'category_id',
         'inst_id'
         ];
}
