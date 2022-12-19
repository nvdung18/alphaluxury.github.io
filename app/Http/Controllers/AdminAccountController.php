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
        // dd($acc);
        return view('admins.account',compact('listAcc'));
    }
}
    