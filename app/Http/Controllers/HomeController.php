<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->product=new Product();
    }
    public function getNewProduct(Request $request)
    {
        $listProduct=$this->product->getAllProduct();
        return view('home',compact('listProduct'));
    }
}
