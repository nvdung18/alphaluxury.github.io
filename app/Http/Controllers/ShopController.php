<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->product=new Product();
    }
    public function getNewProduct(Request $request)
    {
        $listProduct=$this->product->getAllProduct();
        
        // echo "<pre>";
        // print_r ($listProduct);
        // echo "</pre>";
        return view('users.shop',compact('listProduct'));
    }
}
