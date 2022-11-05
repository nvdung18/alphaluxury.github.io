<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Revenue extends Model
{
    use HasFactory;
    protected $dailyTable='dailyrevenue';
    protected $weeklyTable='weeklyrevenue';
    protected $monthlyTable='monthlyrevenue';

    public function countElement(){
        $lenght=DB::table($this->dailyTable)->count();
        return $lenght;
    }

    public function getAllDailyRevPaginate(){
        $rev=DB::table($this->dailyTable)->paginate(10);
        return $rev;
    }

    public function getAllWeeklyRevPaginate(){
        $rev=DB::table($this->weeklyTable)->paginate(10);
        return $rev;
    }

    public function getAllMonthlyRevPaginate(){
        $rev=DB::table($this->monthlyTable)->paginate(10);
        return $rev;
    }


    public function getFilterRev($date){
        $rev=DB::table($this->dailyTable)->where('releaseDate','=',$date)->paginate(10);
        return $rev;
    }

    // check daily revnue exists or not to create new daily revnue, if not exists we crete new daily rev and exists we process it depends on requets
    public function checkDailyRevExit($nowDate){
        $exit=DB::table($this->dailyTable)->where('releaseDate','=',$nowDate)->get();
        return $exit;
    }

    public function createDailyRev($nowDate){
        $lenght=$this->countElement();
        DB::table($this->dailyTable)->insert([
            'idDRevenue'=>$lenght+1,
            'releaseDate' => $nowDate,
        ]);
        return $lenght+1;
    }
    
    // check weelly revnue exists or not to create new weelly revnue, if not exists we crete new weelly rev and exists we process it depends on requets
    public function checkWeekLyRevExit($nowDate,$position){
        
    }

    public function createWeeklyRev($nowDate,$position){
        DB::table($this->weeklyTable)->insert([
            'releaseDate' => $nowDate,
            'position'=>$position,
        ]);
    }
}
