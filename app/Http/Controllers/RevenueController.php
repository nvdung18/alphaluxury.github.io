<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Revenue;

class RevenueController extends Controller
{
    public function __construct()
    {
        $this->revenue=new Revenue();
    }
    public function getDailyRevenue(Request $request)
    {
        $exitdailyRev=$this->checkDaiylyRevExists($request);
        if($exitdailyRev==null){
            $idDailyRev=$this->revenue->createDailyRev(date("Y/m/d"));
            $this->checkWeeklyRevExists($idDailyRev);
        }
        $listRev=$this->revenue->getAllDailyRevPaginate();        
        return view('admins.revenue',compact('listRev'));
    }

    public function filterRev(Request $request){
        $listRev=$this->revenue->getFilterRev($request->filter_date_rev);
        return view('admins.revenue',compact('listRev'));
    }

    // to check if dayli revenue exists or not, then we crete new dayily revenue if it not exists.
    public function checkDaiylyRevExists(Request $request){
        $nowDate=date("Y/m/d");
        $exit=$this->revenue->checkDailyRevExit($nowDate);
        if($exit->first()!=null){
            return $exit;
        }else{
            return null;
        }
        // dd(date("Y/m/d"));
    }

    public function checkWeeklyRevExists($position){
        $nowDate=date("Y/m/d");
        $rev=$this->revenue->getAllWeeklyRevPaginate();
        if($rev->first()==null){
            $this->revenue->createWeeklyRev($nowDate,$position);
        }
    }
}
