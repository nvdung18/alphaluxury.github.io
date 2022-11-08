<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Trademark extends Model
{
    use HasFactory;
    protected $table = "trademark";
    public function getAllTrademark()
    {
        $tradematk = DB::table($this->table)->get();
        return $tradematk;
    }
    public function countTrademark()
    {
        $countTradematk = DB::table($this->table)->count();
        return $countTradematk;
    }
    public function getTrademarkByID($branch)
    {
        $trademark = DB::table($this->table)->where('idTrademark', '=', $branch)->get();
        return $trademark;
    }

    public function getAllTrademarkPaginate()
    {
        $tradematk = DB::table($this->table)->paginate(10);
        return $tradematk;
    }

    // get number of products available in trademark
    public function getNumOfProductsInTrademark()
    {
        $numOfProducts = DB::table('product')->select(DB::raw('idTrademark, count(*) as numofproducts'))->groupBy('idTrademark')->get();
        return $numOfProducts;
    }

    public function updateTrademark($trademarkArr)
    {
        $affected = DB::table($this->table)
            ->where('idTrademark', $trademarkArr['idTrademark'])
            ->update([
                'nameTrademark'=>$trademarkArr['nameTrademark']
            ]);
    }

    // delete product
    public function deleteTrademark($idTrademark){
        $deleted = DB::table($this->table)->where('idTrademark', '=', $idTrademark)->delete();
    }

    // Add new trademark
    public function getMaxIdTrademark()
    {
        $listIdTrademark = DB::table($this->table)->select(DB::raw('substring_index(idTrademark,\'tm\',-1) as idTrademark'))->get();
        $maxIdTrademark=0;
        foreach($listIdTrademark as $value){
            if((int)$value->idTrademark>=$maxIdTrademark){
                $maxIdTrademark=(int)$value->idTrademark;
            }
        }
        return $maxIdTrademark;
    }

    public function addNewTrademark($trademarkArr){
        DB::table($this->table)->insert([
            'idTrademark' => $trademarkArr['idTrademark'],
            'nameTrademark' => $trademarkArr['nameTrademark']
        ]);
    }
}
