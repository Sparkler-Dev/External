<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreFBInstaPageAccessToken extends Model
{
    use HasFactory;
     protected $table= 'fbinsta_page_access_token';
    protected $fillable = [
      'user_id', 'client_id', 'page_name', 'access_token', 'page_category',  'page_id'
    ];
     public function user(){
         return $this->belongsTo(User::class);
     }
}
