<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    public $timestamps = false;
    protected $primaryKey = 'idOrder';
    public $incrementing = false;

    protected $fillable = [
        'idOrder',
        'status',
        'deliveryTime',
        'orderNotes',
        'deliveryCharges',
        'productMoney',
        'totalMoney',
        'idAccount',
        'idPayment',
        'idPromoCode'
    ];

    public function getlistorder()
    {
        $listorder = DB::table('order')->get();
        if (count($listorder) != 0) {
            return $listorder;
        } else {
            return [];
        }
    }

    public function getlastorder()
    {
        $lastorder = DB::table('order')->get()->last();
        return $lastorder;
    }

    public function getidOrderLastest()
    {
        $idOrder = DB::table('order')->get()->last();
        if (isset($idOrder) || $idOrder != null) {
            return $idOrder;
        } else {
            return null;
        }
    }
}
