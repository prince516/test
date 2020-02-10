<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'vehicles';
    protected $fillable = [ 'account_id', 'name', 'number', ];
}
