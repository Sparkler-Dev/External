<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreFacebookAccessToken extends Model
{
    use HasFactory;

     protected $table= 'fb_short_tk';
    protected $fillable = [
      'user_id', 'client_id', 'access_token'
    ];

       public function user(){
         return $this->belongsTo(User::class);
     }
}
