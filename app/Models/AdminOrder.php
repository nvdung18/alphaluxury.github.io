<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminOrder extends Model
{
    use HasFactory;
    protected $orderTable = "order";
    protected $orderDetailTable = "orderdetail";

    public function getAllOrderPaginate(){
        $order=DB::table($this->orderTable)->orderBy('idOrder','desc')->paginate(10);
        return $order;
    }

    // get order by ID
    public function getOrderByID($idOrder){
        $order=DB::table($this->orderTable)->where('idOrder','=',$idOrder)->get();
        return $order;
    }

    // get details order
    public function getDetailsOrder($idOrder){
        $order=DB::table($this->orderDetailTable)->where('idOrder','=',$idOrder)->get();
        return $order;
    }

    // get details order
    public function getPromoCodeById($idPromocode){
        $promotion=DB::table('promocode')->where('idPromocode','=',$idPromocode)->get();
        return $promotion;
    }

    // get details order
    public function getFormPayment($idPayment){
        $payment=DB::table('payment')->where('idPayment','=',$idPayment)->get();
        return $payment;
    }

    // update status
    public function updateStatus($idOrder,$statusDetails){
        $affected = DB::table($this->orderTable)
            ->where('idOrder', $idOrder)
            ->update([
                'status' => $statusDetails,
            ]);
    }

    // filter
    public function getOrderByDate($date){
        $order=DB::table($this->orderTable)->where('deliveryTime','like',$date.'%')->orderBy('idOrder','desc')->paginate(10);
        return $order;
    }

    // search
    public function searchOrderByID($key){
        $listOrder= DB::table($this->orderTable)->where('idOrder', 'like', '%'.$key.'%')->paginate(10);
        return $listOrder;
    }
}
