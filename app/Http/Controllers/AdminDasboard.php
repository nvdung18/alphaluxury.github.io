<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Revenue;
use Illuminate\Http\Request;

class AdminDasboard extends Controller
{
    //
    public function __construct() {
        $this->rev=new Revenue();
        $this->payment=new Payment();
    }

    public function loadDashboard(){
        $weekRev=$this->rev->getLastWeekRev();
        $daykRev=$this->rev->getLastDayRev();
        $listPayment=$this->payment->getAllPayment();
        // dd($weekRev->idWRrevenue);
        return view('admins.index',compact("weekRev",'daykRev','listPayment'));
    }
}
