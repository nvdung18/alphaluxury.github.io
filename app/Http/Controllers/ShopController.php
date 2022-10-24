<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Trademark;
use Illuminate\Contracts\Session\Session;

class ShopController extends Controller
{
    private $listTrademark;
    private $countTrademark;

    public function __construct()
    {
        $this->product = new Product();
        $this->trademark = new Trademark();
        $this->listTrademark = $this->trademark->getAllTrademark();
        $this->countTrademark = $this->trademark->countTrademark();
    }
    public function getProductMaleP(Request $request) //get product male paginate
    {
        $price = null;
        $branch = null;
        $listProduct = $this->product->getProductMalePaginate();
        $tag = "men";
        return view('users.shop', compact('listProduct', 'tag', 'branch', 'price'), ['listTrademark' => $this->listTrademark, 'countTrademark' => $this->countTrademark]);
    }
    public function getProductFemaleP(Request $request) //get product female paginate
    {
        $price = null;
        $branch = null;
        $listProduct = $this->product->getProductFemalePaginate();
        $tag = "women";
        return view('users.shop', compact('listProduct', 'tag', 'branch', 'price'), ['listTrademark' => $this->listTrademark, 'countTrademark' => $this->countTrademark]);
    }
    public function getFilterProduct(Request $request) //get product female paginate
    {
        $price = null;
        $branch = null;
        if (isset($request->price)) {
            # code...
            $price = $request->price;
        }

        if (isset($request->branch)) {
            # code...
            $branch = $request->branch;
        }

        // dd('branch: ' . $branch, 'price: ' . $price);
        $type = $request->type;
        $tag = $type;

        // convert to compare 'type' data in database
        if ($type == 'men') {
            # code...
            $type = 'male';
        } else {
            # code...
            $type = 'female';
        }
        // dd($type);

        // filter product
        $listProduct = $this->product->getFilterProduct($branch, $price, $type);
        // dd($listProduct);

        // get the selected branch name
        $trademark = $this->trademark->getTrademarkByID($branch);
        $nameTrademark="";
        foreach ($trademark as $value) {
            $nameTrademark = $value->nameTrademark;
        }
        return view('users.shop', compact('listProduct', 'tag', 'nameTrademark', 'branch', 'price'), ['listTrademark' => $this->listTrademark, 'countTrademark' => $this->countTrademark]);
        // return redirect('shop/watch-men');
    }
}
