<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Sets extends Model
 
{
   protected $table = 'sets';
 
   protected $fillable = ['title', 'user_id'];

    /**
    * Get words of Set
    */
    public function words()
    {
        return $this->hasMany('App\Words','set_id');
    }
 
}