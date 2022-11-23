<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use Illuminate\Http\Request;

class AdminDasboard extends Controller
{
    //
    public function __construct() {
        $this->rev=new Revenue();
    }

    public function loadDashboard(){
        $weekRev=$this->rev->getLastWeekRev();
        $daykRev=$this->rev->getLastDayRev();
        // dd($weekRev->idWRrevenue);
        return view('admins.index',compact("weekRev",'daykRev'));
    }
}
