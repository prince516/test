<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'accounts';
    protected $fillable = [ 'email', 'email_verified_at', 'remember_token', 'recovery_email' ];
}
