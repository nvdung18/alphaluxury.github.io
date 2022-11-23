<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AdminOrder;
use App\Models\AdminReceipt;
use App\Models\product;
use Illuminate\Http\Request;

class AdminReceiptController extends Controller
{
    //
    public function __construct()
    {
        $this->order = new AdminOrder();
        $this->account = new Account();
        $this->product = new product();
        $this->receipt = new AdminReceipt();
    }

    public function getAllReceiptPaginate(){
        $listReceipt=$this->receipt->getAllReceiptPagiante();

        
        $listOrder = array();
        foreach($listReceipt as $key=>$item){
            $order=$this->order->getOrderByID($item->idOrder);
            $listOrder+=[$key=>$order];
            // array_push($listOrder,$order);
        }
        // dd($listOrder);
        // get recipient and form payment
        $listIdRP = array();
        $listCheckout = array();
        $listPayment = array();
        foreach ($listOrder as $key => $item) {
            array_push($listIdRP, [$item[0]->idPayment, $item[0]->idCheckout]);
        }
        foreach ($listIdRP as $key => $value) {
            array_push($listPayment, $this->order->getFormPayment($value[0]));
            array_push($listCheckout, $this->account->getCheckout($value[1]));
        }
        // dd($listPayment);

        return view('admins.receipt', compact('listReceipt', 'listPayment', 'listCheckout','listOrder'));
    }

}
