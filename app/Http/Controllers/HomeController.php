<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Trademark;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->product=new Product();
        $this->trademark=new Trademark();
    }
    public function getProductSlider(Request $request)
    {
        $listProduct=$this->product->getAllProduct();
        $listTrademark=$this->trademark->getAllTrademark();
        $countTrademark=$this->trademark->countTrademark();
        $tag="home";
        return view('users.home',compact('listProduct','listTrademark','countTrademark','tag'));
    }
}
