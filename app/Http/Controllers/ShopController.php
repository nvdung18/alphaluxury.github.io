<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Trademark;

class ShopController extends Controller
{
    private $listTrademark;
    private $countTrademark;
    public function __construct()
    {
        $this->product=new Product();
        $this->trademark=new Trademark();
        $this->listTrademark=$this->trademark->getAllTrademark();
        $this->countTrademark=$this->trademark->countTrademark();
    }
    public function getProductMaleP(Request $request) //get product male paginate
    {
        $listProduct=$this->product->getProductMalePaginate();
        $tag="men";
        return view('users.shop',compact('listProduct','tag'), ['listTrademark' => $this->listTrademark,'countTrademark'=>$this->countTrademark]);
    }
    public function getProductFemaleP(Request $request) //get product female paginate
    {
        $listProduct=$this->product->getProductFemalePaginate();
        $tag="women";
        return view('users.shop',compact('listProduct','tag'),['listTrademark' => $this->listTrademark,'countTrademark'=>$this->countTrademark]);
    }
}
