<?php

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
use Illuminate\Contracts\Auth\Authenticatable;
 
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
 
 
class Users extends Model implements Authenticatable
 
{
   use AuthenticableTrait;
   
   protected $fillable = ['username','email','password'];
   protected $hidden = ['password'];
 
   /**
    * Get sets of User
    */
   public function sets()
   {
       return $this->hasMany('App\Sets','user_id');
   }
 
}