<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Revenue extends Model
{
    use HasFactory;
    protected $dailyTable = 'dailyrevenue';
    protected $weeklyTable = 'weeklyrevenue';
    protected $monthlyTable = 'monthlyrevenue';

    public function countElement()
    {
        $lenght = DB::table($this->dailyTable)->count();
        return $lenght;
    }

    public function getAllDailyRevPaginate()
    {
        $rev = DB::table($this->dailyTable)->paginate(10);
        return $rev;
    }

    public function getAllWeeklyRevPaginate()
    {
        $rev = DB::table($this->weeklyTable)->paginate(10);
        return $rev;
    }

    public function getAllMonthlyRevPaginate()
    {
        $rev = DB::table($this->monthlyTable)->paginate(10);
        return $rev;
    }


    public function getFilterRev($date)
    {
        $rev = DB::table($this->dailyTable)->where('releaseDate', '=', $date)->paginate(10);
        return $rev;
    }

    // check daily revnue exists or not to create new daily revnue, if not exists we crete new daily rev and exists we process it depends on requets
    public function checkDailyRevExit($nowDate)
    {
        $exit = DB::table($this->dailyTable)->where('releaseDate', '=', $nowDate)->get();
        return $exit;
    }
    
    public function createDailyRev($nowDate)
    {
        $lenght = $this->countElement();
        DB::table($this->dailyTable)->insert([
            'idDRevenue' => $lenght + 1,
            'releaseDate' => $nowDate,
        ]);
        return $lenght + 1;
    }
    
    // check weelly revnue exists or not to create new weelly revnue, if not exists we crete new weelly rev and exists we process it depends on requets
    public function checkWeekLyRevExit($nowDate)
    {
        $weekRev = DB::table($this->weeklyTable)
        ->select(DB::raw('*'))
        ->orderByRaw('idWRrevenue DESC')
        ->limit(1)->get();
        // to get that week's release date
        $position=$weekRev[0]->position;
        
        // check if now date exists in week or not
        $dailyRev = DB::table($this->dailyTable)->offset($position-1)->limit(7)->get();
        // dd($dailyRev);
        $checkExists=false;
        foreach ($dailyRev as $key=>$item){
            // echo'<pre>';echo $item->releaseDate.'.'.$nowDate;echo'</pre>';
            if($item->releaseDate==$nowDate){
                $checkExists=true;
            }
        }
        // dd($checkExists);
        return $checkExists;
    }
    
    public function createWeeklyRev($nowDate, $position)
    {
        DB::table($this->weeklyTable)->insert([
            'releaseDate' => $nowDate,
            'position' => $position,
        ]);
    }
    
    // check monthly revnue exists or not to create new monthly revnue, if not exists we crete new monthly rev and exists we process it depends on requets
    public function createMonthlyRev($nowDate, $position)
    {
        DB::table($this->monthlyTable)->insert([
            'releaseDate' => $nowDate,
            'position' => $position,
        ]);
    }

    public function getChartWeek($position){
        $weekRev = DB::table($this->dailyTable)->offset($position-1)->limit(7)->get();
        return $weekRev;
    }

    public function getChartMonth($position){
        $monthRev = DB::table($this->monthlyTable)->where('position','=',$position)->get();
        
        // get month and then check next month if exists or not 
        $d=date_parse_from_format('Y-m-d',$monthRev[0]->releaseDate);
        $month=$d["month"];
        $nextMonth=$month+1;
        // $a="07";
        // check next month if exists or not
        $dailyRev=DB::table($this->dailyTable)->whereRaw("releaseDate REGEXP '[0-9]+.-$nextMonth-01$'")->get();

        if ($dailyRev->first()==null) {
            # code...
            $lastRow=DB::table($this->dailyTable)
            ->select(DB::raw('*'))
            ->orderByRaw('idDRevenue DESC')
            ->limit(1)->get();

            $btStart=$position;
            $btEnd=$lastRow[0]->idDRevenue;
            $rev=DB::table($this->dailyTable)->whereRaw("idDRevenue BETWEEN $btStart AND $btEnd")->get();
            // dd($rev);
            return $rev;
        }else{
            $btStart=$position;
            $btEnd=$dailyRev[0]->idDRevenue;
            $rev=DB::table($this->dailyTable)->whereRaw("idDRevenue BETWEEN $btStart AND $btEnd")->get();
            return $rev;
            // dd($rev);   
        }

    }
}
