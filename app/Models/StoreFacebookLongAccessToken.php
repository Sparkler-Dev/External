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

    public function user(){
         return $this->belongsTo(User::class);
     }
}
