<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ClientID extends Model
{
    use HasApiTokens, HasFactory, Notifiable  ;
    use HasFactory;
      protected $table= 'clientid';

      protected $fillable = [
      'user_id', 'name', 'email', 'client_id'
    ];
}
