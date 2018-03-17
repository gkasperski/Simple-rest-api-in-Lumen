<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Words extends Model
{
   protected $table = 'words';
   protected $fillable = ['word','translation','set_id'];
}