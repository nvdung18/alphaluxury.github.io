<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminAccount extends Model
{
    use HasFactory;
    protected $accTable="account";
    protected $userTable="user";

    public function getAllAccountCus(){
        $listAcc=DB::table($this->accTable)->join('user','account.idUser','=','user.idUser')->where('user.role','=','1')->paginate(10);
        return $listAcc;
    }

    public function getAccountByID($idAccount){
        $acc=DB::table($this->accTable)->join('user','account.idUser','=','user.idUser')->where('account.idAccount','=',$idAccount)->get();
        return $acc;
    }
}
