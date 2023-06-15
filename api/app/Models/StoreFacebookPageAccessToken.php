<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreFacebookPageAccessToken extends Model
{
    use HasFactory;
     protected $table= 'facebook_page_access_token';
    protected $fillable = [
      'user_id', 'client_id', 'page_name', 'access_token', 'page_category',  'page_id'
    ];
      public function user(){
        return $this->belongsTo(User::class, 'user_id' , 'id');
    }
}
