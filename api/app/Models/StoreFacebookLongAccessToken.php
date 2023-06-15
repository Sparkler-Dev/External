<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreFacebookLongAccessToken extends Model
{
    use HasFactory;
     protected $table= 'fb_long_tk';
    protected $fillable = [
      'user_id', 'client_id', 'long_lived_access_token'
    ];

    protected $with = ['facebook_userdetails'];
    public function user(){
         return $this->belongsTo(User::class,);
     }
    public function facebook_userdetails(){
       return $this->belongsTo(StoreFacebookUserDetails::class, 'client_id', 'client_id' );
    }
}
