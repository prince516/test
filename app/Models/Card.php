<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'cards';
    protected $fillable = [ 'account_id', 'name', 'number', 'expiry', 'cvc', 'type' ];
}
