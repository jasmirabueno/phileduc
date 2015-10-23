<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $table = 'professors';
    
     protected $fillable = [
         'prof_firstname',
         'prof_lastname',
         'prof_description',
         'prof_image',
         'inst_id',
         'user_id'
         ];
         
     protected $primaryKey = 'prof_id';
}
