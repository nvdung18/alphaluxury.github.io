<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class UserOrder extends Model
{
    use HasFactory;
    protected $orderTable = "order";

    public function getOrderAndDetailByID($idUser){

        // get idAccount to join order and orderdetail
        $account=DB::table('account')->where('idUser','=',$idUser)->get();
        $idAccount=$account[0]->idAccount;
        
        // get list Order
        $listOrder=DB::table($this->orderTable)
        ->join('orderdetail','order.idOrder','=','orderdetail.idOrder')
        ->join('product','orderdetail.idProduct','=','product.idProduct')
        ->join('promocode','order.idPromoCode','=','promocode.idPromoCode')
        ->where('idAccount','=',$idAccount)
        ->select('order.*','orderdetail.*','promocode.*','product.nameProduct','product.image','product.price')
        ->orderBy('order.idOrder','desc')
        ->get();

        // dd($listOrder);
        return $listOrder;
    }

    public function getAddressOrder($idAccount,$idOrder){
        $checkout=DB::table('checkout')
        ->join('order','order.idAccount','=','checkout.idAccount')
        ->where('order.idAccount','=',$idAccount)
        ->where('idOrder','=',$idOrder)
        ->limit(1)
        ->get();

        return $checkout;
    }

    public function getPaymentOrder($idOrder){
        $payment=DB::table('payment')
        ->join('order','order.idPayment','=','payment.idPayment')
        ->where('idOrder','=',$idOrder)
        ->select('payment.namePayment')
        ->limit(1)
        ->get();

        return $payment;
    }
}
