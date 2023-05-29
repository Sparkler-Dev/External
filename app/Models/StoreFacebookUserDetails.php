<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreFacebookUserDetails extends Model
{
    use HasFactory;
     protected $table= 'store_facebook_user_details';
    protected $fillable = [
      'user_id', 'client_id', 'facebook_username', 'facebook_user_id'
    ];
}
