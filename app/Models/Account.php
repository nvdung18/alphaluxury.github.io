<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function getCheckout($idAccount){
        $checkout=DB::table('checkout')->where('idAccount','=',$idAccount)->get();
        return $checkout;
    }
}
