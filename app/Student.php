<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
     protected $table = 'students';
    
     protected $fillable = [
         'stud_firstname',
         'stud_lastname',
         'stud_image',
         'stud_description',
         'user_id'
         ];
         
}
