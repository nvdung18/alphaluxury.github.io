<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{
    use HasFactory;
    protected $table='payment';
    public $timestamps = false;
    protected $primaryKey = 'idPayment';
    public $incrementing = false;

    protected $fillable = [
        'idPayment ',
        'namePayment',
        'totalPayment'
    ];

    // public function addTotalpayment($idpayment, $totalmoney) {
    //     $payment = DB::table('payment')->where('idPayment', '=', $idpayment)->get()->first();
    //     print_r($num);
    //     die();
    //     DB::table('payment')->where('idPayment', '=', $payment->idPayment)
    //                         ->update([
    //                             'totalPayment' => $num
    //                         ]);
    // }

}
