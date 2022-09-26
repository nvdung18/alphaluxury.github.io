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
    public function getRevenue(Request $request)
    {
        $listRev=$this->revenue->getAllRev();
        
        // echo "<pre>";
        // print_r ($listProduct);
        // echo "</pre>";
        return view('admins.revenue',compact('listRev'));
    }
}
