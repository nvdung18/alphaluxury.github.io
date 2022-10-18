<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Trademark extends Model
{
    use HasFactory;
    protected $table="trademark";
    public function getAllTrademark(){
        $tradematk=DB::table($this->table)->get();
        return $tradematk;
    }
    public function countTrademark(){
        $countTradematk=DB::table($this->table)->count();
        return $countTradematk;
    }
    public function getTrademarkByID($branch){
        $trademark=DB::table($this->table)->where('idTrademark','=',$branch)->get();
        return $trademark;
    }
}
