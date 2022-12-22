<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminReceipt extends Model
{
    use HasFactory;
    protected $table = "receipt";

    public function addNewReceipt($recepitArr){
        DB::table($this->table)->insert([
            'idReceipt' => $recepitArr['idReceipt'],
            'releaseDate' => $recepitArr['releaseDate'],
            'idOrder'=>$recepitArr['idOrder']
        ]);
    }

    public function getAllReceipt(){
        $receipt=DB::table($this->table)->get();
        return $receipt;
    }

    public function getAllReceiptPagiante(){
        $receipt=DB::table($this->table)->orderBy('idReceipt','desc')->paginate(10);
        return $receipt;
    }

    public function getReceiptByDate($date){
        $receipt=DB::table($this->table)->where('releaseDate','like',$date.'%')->paginate(10);
        return $receipt;
    }
    
    public function searchReceiptByID($key){
        $listReceipt=DB::table($this->table)->where('idReceipt','like','%'.$key.'%')->paginate(10);
        return $listReceipt;
    }
}
