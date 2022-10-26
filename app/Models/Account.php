<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table='account';
    public $timestamps = false;
    protected $primaryKey = 'idAccount';
    public $incrementing = false;

    protected $fillable = [
        'idAccount',
        'method',
        'userName',
        'password',
        'idUser'
    ];

}
