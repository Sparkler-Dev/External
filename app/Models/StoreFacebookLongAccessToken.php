<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreFacebookLongAccessToken extends Model
{
    use HasFactory;
     protected $table= 'store_facebook_long_access_tokens';
    protected $fillable = [
      'user_id', 'long_lived_access_token'
    ];

     public function user(){
        return $this->belongsTo(User::class);
    }
}
