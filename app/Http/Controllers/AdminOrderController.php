<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminOrder;
use App\Models\Account;
use App\Models\AdminReceipt;
use App\Models\product;
use App\Models\Revenue;
use App\Http\Controllers\RevenueController;
use Illuminate\Support\Arr;

class AdminOrderController extends Controller
{
    //

    public function __construct()
    {
        $this->order = new AdminOrder();
        $this->account = new Account();
        $this->product = new product();
        $this->receipt = new AdminReceipt();
        $this->revenue = new Revenue();
        $this->revController = new RevenueController();
    }

    // load all order paginate
    public function getAllOrderPaginate()
    {
        // dd(date("Y-m-d h:i:sa"));
        $listOrder = $this->order->getAllOrderPaginate();
        $listStatus = array(
            "Wait for confirmation",
            "Order confirmed",
            "Delivering",
            "Order deliveried"
        );
        // dd($listStatus);
        // get recipient and form payment
        $listIdRP = array();
        $listCheckout = array();
        $listPayment = array();
        foreach ($listOrder as $key => $item) {
            array_push($listIdRP, [$item->idPayment, $item->idCheckout]);
        }

        foreach ($listIdRP as $key => $value) {
            array_push($listPayment, $this->order->getFormPayment($value[0]));
            array_push($listCheckout, $this->account->getCheckout($value[1]));
        }
        // dd($listIdRP);

        return view('admins.order', compact('listOrder', 'listStatus', 'listPayment', 'listCheckout'));
    }

    // get details order 
    public function getDetailsOrder(Request $request)
    {
        $idOrder = $request->idOrder;
        $tag=$request->tag;
        $order = $this->order->getOrderByID($idOrder);
        $detailsOrder = $this->order->getDetailsOrder($idOrder);

        if(isset($request->idReceipt)){
            $idReceipt=$request->idReceipt;
        }else{
            $idReceipt=null;
        }

        /* get id account to get checkout of the receipient and get id product to get the infor of product
            get idPayment to get form payment and idPromocode to get promotion
        */
        $listIdProduct = array();
        $idAccount = "";
        $idPromoCode = "";
        $idPayment = "";
        foreach ($detailsOrder as $item) {
            array_push($listIdProduct, $item->idProduct);
        }
        foreach ($order as $item) {
            $idAccount = $item->idAccount;
            $idPayment = $item->idPayment;
            $idPromoCode = $item->idPromoCode;
        }
        // get product information, checkout information, promocode and form payment
        $checkout = $this->account->getCheckout($order[0]->idCheckout);
        // dd($checkout);
        $payment = $this->order->getFormPayment($idPayment);
        $promotion = $this->order->getPromoCodeById($idPromoCode);
        $listInforProduct = array();
        foreach ($listIdProduct as $item) {
            array_push($listInforProduct, $this->product->getProductById($item));
        }

        // Calculate Promotion
        $promotionProduct = 0;
        foreach ($promotion as $item) {
            if ($item->discountPercent != 0) {
                foreach ($order as $value) {
                    $promotionProduct = (float)(($value->productMoney * $item->discountPercent) / 100);
                }
            }
        }
        // $product=
        // dd($promotionProduct);
        return view('admins.details-order', compact('idOrder', 'order', 'detailsOrder', 'checkout', 'listInforProduct', 'payment', 'promotionProduct','tag','idReceipt'));
    }

    // update status
    public function updateStatus(Request $request)
    {
        $listStatus = array(
            "Wait for confirmation",
            "Order confirmed",
            "Delivering",
            "Order deliveried"
        );

        // get status update
        $statusUpdate = $request->status;

        // get date time to update
        $date = date("Y/m/d");
        $time = date("h:i:sa");
        // dd($date,$time);

        // get now status from database to insert status
        $order = $this->order->getOrderByID($request->idOrder);
        $statusNow = "";
        foreach ($order as $item) {
            $statusNow = $item->status;
            $statusNow = json_decode($statusNow);
        }

        // get max Key to get now status
        $maxKey = 0;
        foreach ($statusNow as $key => $item) {
            $maxKey = $key;
        }

        // check exits of staus
        if ($statusNow->$maxKey[2] != $statusUpdate && $statusUpdate != null) {
            $statusNow = (array)$statusNow;
            array_push($statusNow, [$date, $time, $statusUpdate]);

            $statusDetails = json_encode($statusNow);

            // if order deliveried we will create new receipt
            if ($statusUpdate == "Order deliveried") {
                $listReceipt = $this->receipt->getAllReceipt();
                $lengtListReeipt = count($listReceipt);

                // get last id of receipt to create new receipt
                $lastIdReceipt = $listReceipt[$lengtListReeipt - 1]->idReceipt;
                $lastIdReceipt = explode("recpt_", $lastIdReceipt);
                // dd((int)$lastIdReceipt[1] + 1);
                $num = (int)$lastIdReceipt[1] + 1;
                if ($num <= 10) {
                    $newIdReceipt = 'recpt_0' . (string)$num;
                } else {
                    $newIdReceipt = 'recpt_' . (string)$num;
                }

                // create arr to contains information
                $receiptArr = array(
                    "idReceipt" => $newIdReceipt,
                    "releaseDate" => date("Y-m-d h:i:s"),
                    "idOrder" => $request->idOrder
                );

                // add new receipt
                $this->receipt->addNewReceipt($receiptArr);

                // add daily revenue, weekly revenue and monthly revenue
                $exitdailyRev = $this->revController->checkDaiylyRevExists(); // check if today exists
                if($exitdailyRev==null){
                    //if today not exists, we crete new dailyrev, check weeklyrev and monthlyrev
                    $idDailyRev=$this->revenue->createDailyRev(date("Y-m-d"));
                    $this->revController->checkWeeklyRevExists($idDailyRev);
                    $this->revController->checkMonthlyRevExists($idDailyRev);
                }
                $nowDate=date("Y-m-d"); //Check what day is today to update the revenue
                $this->revenue->updateAllRevenue($nowDate,$order);
            }
            $this->order->updateStatus($request->idOrder, $statusDetails);
        }

        // dd($statusDetails);

        return redirect()->route('ad.order');
    }

    public function filterOrder(Request $request){
        // dd(date("Y-m-d h:i:sa"));
        $listOrder = $this->order->getOrderByDate($request->filter_date_order);
        // dd($listOrder);
        $listStatus = array(
            "Wait for confirmation",
            "Order confirmed",
            "Delivering",
            "Order deliveried"
        );
        // dd($listStatus);
        // get recipient and form payment
        $listIdRP = array();
        $listCheckout = array();
        $listPayment = array();
        foreach ($listOrder as $key => $item) {
            array_push($listIdRP, [$item->idPayment, $item->idCheckout]);
        }

        foreach ($listIdRP as $key => $value) {
            array_push($listPayment, $this->order->getFormPayment($value[0]));
            array_push($listCheckout, $this->account->getCheckout($value[1]));
        }
        // dd($listIdRP);

        return view('admins.order', compact('listOrder', 'listStatus', 'listPayment', 'listCheckout'));
    }

    public function searchOrder(Request $request){
        $listOrder = $this->order->searchOrderByID($request->input_search_order);
        
        $listStatus = array(
            "Wait for confirmation",
            "Order confirmed",
            "Delivering",
            "Order deliveried"
        );
        // dd($listStatus);
        // get recipient and form payment
        $listIdRP = array();
        $listCheckout = array();
        $listPayment = array();
        foreach ($listOrder as $key => $item) {
            array_push($listIdRP, [$item->idPayment, $item->idCheckout]);
        }

        foreach ($listIdRP as $key => $value) {
            array_push($listPayment, $this->order->getFormPayment($value[0]));
            array_push($listCheckout, $this->account->getCheckout($value[1]));
        }
        // dd($listIdRP);

        return view('admins.order', compact('listOrder', 'listStatus', 'listPayment', 'listCheckout'));
    }
}
