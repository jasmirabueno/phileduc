<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $table = 'institutions';
        
     protected $fillable = [
         'inst_name',
         'inst_description',
         'contactno',
         'logo',
         'admin_id'
         ];
     
     public function user()
     {
         return $this-hasOne('App\User');
     }
}
