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
        $acc=DB::table($this->accTable)->join('user','account.idUser','=','user.idUser')->where('user.role','=','1')->get();
        return $acc;
    }
}
