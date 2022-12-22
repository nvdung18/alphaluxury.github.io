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
        // check if today exists
        $exitdailyRev=$this->checkDaiylyRevExists();
        if($exitdailyRev==null){
            $idDailyRev=$this->revenue->createDailyRev(date("Y-m-d"));
            $this->checkMonthlyRevExists($idDailyRev);
            $this->checkWeeklyRevExists($idDailyRev);
        }
        $listRev=$this->revenue->getAllDailyRevPaginate();
        
        // if tag = 'day' there will be no button to show the chart, tag='week' or tag='month' there will be a button to show the chart
        $tag='day'; 
        return view('admins.revenue',compact('listRev','tag'));
    }

    public function filterRev(Request $request){
        $table="";
        if ($request->table_filter=='day') {
            # code...
            $table='dailyrevenue';
        }elseif($request->table_filter=='week'){
            $table='weeklyrevenue';
        }else{
            $table='monthlyrevenue';
        }
        $listRev=$this->revenue->getFilterRev($request->filter_date_rev,$table);
        // dd($listRev);
        $tag=$request->table_filter; 
        return view('admins.revenue',compact('listRev','tag'));
    }

    // to check if dayli revenue exists or not, then we crete new dayily revenue if it not exists.
    public function checkDaiylyRevExists(){
        $nowDate=date("Y-m-d");
        $exit=$this->revenue->checkDailyRevExit($nowDate);
        if($exit->first()!=null){
            return $exit;
        }else{
            return null;
        }
        // dd(date("Y/m/d"));
    }

    public function checkWeeklyRevExists($position){
        $nowDate=date("Y-m-d");
        $rev=$this->revenue->getAllWeeklyRevPaginate();
        if($rev->first()==null){
            $this->revenue->createWeeklyRev($nowDate,$position);
        }else{
            $checkExists=$this->revenue->checkWeekLyRevExit($nowDate);
            // if checkExists=false, its mean new week. If this is true -> don't crete new week
            if($checkExists==false){
                $this->revenue->createWeeklyRev($nowDate,$position);
            }
        }
    }

    public function checkMonthlyRevExists($position){
        $nowDate=date("Y-m-d");
        // dd($nowDate);
        $rev=$this->revenue->getAllMonthlyRevPaginate();
        if($rev->first()==null){
            $this->revenue->createMonthlyRev($nowDate,$position);
        }else{
            // if current day=01 or month+=1 => new month
            $currentDay=date("d");
            $currentMonth=date('m');

            // to check what month is last month and compare with current month
            $lastMonthRev=$this->revenue->getLastMonthRev();
            $lastMonth=date("m",strtotime($lastMonthRev->releaseDate));

            if($currentDay=="01"||$currentMonth!=$lastMonth){
                $this->revenue->createMonthlyRev($nowDate,$position);
            }
        }
    }

    //get weekly rev
    public function getWeeklyRevenue(Request $request){
        $listRev=$this->revenue->getAllWeeklyRevPaginate();
        $tag='week';
        return view('admins.revenue',compact('listRev','tag'));
    }

    public function getMonthlyRevenue(Request $request){
        $listRev=$this->revenue->getAllMonthlyRevPaginate();
        $tag='month';
        return view('admins.revenue',compact('listRev','tag'));
    }

    public function getChartWeeklyRevenut(Request $request){
        $tag='week';
        $rev=$this->revenue->getChartWeek($request->position);
        // dd($rev);
        return view('admins.chart',compact('rev','tag'));
    }

    public function getChartMonthlyRevenut(Request $request){
        $tag='month';
        $rev=$this->revenue->getChartMonth($request->position);
        // dd($rev);
        return view('admins.chart',compact('rev','tag'));
    }
}
