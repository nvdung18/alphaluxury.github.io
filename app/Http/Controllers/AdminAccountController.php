<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminAccount;

class AdminAccountController extends Controller
{
    //
    public function __construct()
    {
        $this->acc = new AdminAccount();

    }
    public function getAllAccountCus(){
        $listAcc=$this->acc->getAllAccountCus();
        // dd($listAcc);
        return view('admins.account',compact('listAcc'));
    }

    public function getDetailInforCus(Request $request){
        $acc=$this->acc->getAccountByID($request->idAcc);
        // dd($acc[0]->nameUser);
        return view('admins.details-inforCus',compact('acc'));
    }
}
    