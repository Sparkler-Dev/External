<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreFacebookFeeds extends Model
{
    use HasFactory;
    protected $table= 'store_facebook_feeds';
    protected $fillable = [
      'user_id', 'client_id', 'message', 'published_photo', 'published_video', 'post_id', 'created_time'
    ];
}
