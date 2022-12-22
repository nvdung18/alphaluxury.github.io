<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class product extends Model
{
    use HasFactory;
    protected $table = 'product';
    public function getAllProduct()
    {
        $product = DB::table($this->table)->get();
        // $product=DB::table($this->table)->paginate(8); => Phan trang
        return $product;
    }

    public function getProductById($idProduct)
    {
        $product = DB::table($this->table)->where('idProduct', '=', $idProduct)->get();
        // $product=DB::table($this->table)->paginate(8); => Phan trang
        return $product;
    }

    public function getAllProductPaginate()
    {
        $product = DB::table($this->table)->paginate(9);
        // $product=DB::table($this->table)->paginate(8); => Phan trang
        return $product;
    }
    public function getProductMalePaginate()
    {
        $product = DB::table($this->table)->where('type', '=', 'male')->paginate(9);
        return $product;
    }
    public function getProductFemalePaginate()
    {
        $product = DB::table($this->table)->where('type', '=', 'female')->paginate(9);
        return $product;
    }
    public function getFilterProduct($branch, $price, $type)
    {
        // list price corresponding with the receive value price (if price not null)
        $listPrice = ['<7', '7-20', '20-50', '50-200', '200-500', '>500'];
        if ($price == null) {
            //price=null => branch!=null
            $product = DB::table($this->table)->where([
                ['idTrademark', '=', $branch],
                ['type', '=', $type],
            ])->paginate(9);
        } elseif ($branch == null) {
            //branch=null => price!=null
            // check value of the price 
            $realPrice = $listPrice[$price - 1];
            if ($price == 1 || $price == 6) {
                $sign = (string)Str::of($realPrice)->match('/[^0-9]/');
                $money = Str::of($realPrice)->match('/[0-9]+/');
                # code...
                $product = DB::table($this->table)->where([
                    ['price', $sign, $money . '000000'],
                    ['type', '=', $type],
                ])->paginate(9);
            } else {
                $money = Str::of($realPrice)->matchAll('/[0-9]+/');
                # code...
                $product = DB::table($this->table)->where([
                    ['price', ">", $money[0] . '000000'],
                    ['price', "<", $money[1] . '000000'],
                    ['type', '=', $type],
                ])->paginate(9);
            }
        } else {
            $realPrice = $listPrice[$price - 1];
            if ($price == 1 || $price == 6) {
                $sign = (string)Str::of($realPrice)->match('/[^0-9]/');
                $money = Str::of($realPrice)->match('/[0-9]+/');
                # code...
                $product = DB::table($this->table)->where([
                    ['idTrademark', '=', $branch],
                    ['price', $sign, $money . '000000'],
                    ['type', '=', $type],
                ])->paginate(9);
            } else {
                $money = Str::of($realPrice)->matchAll('/[0-9]+/');
                # code...
                $product = DB::table($this->table)->where([
                    ['idTrademark', '=', $branch],
                    ['price', ">", $money[0] . '000000'],
                    ['price', "<", $money[1] . '000000'],
                    ['type', '=', $type],
                ])->paginate(9);
            }
        }
        return $product;
    }

    public function getLastRowProduct()
    {
        $product = DB::table($this->table)->orderBy('idPRoduct', 'desc')->limit(1)->get();
        return $product;
    }

    // add new product
    public function addNewProduct($productArr)
    {
        DB::table($this->table)->insert([
            'idProduct' => $productArr['idProduct'],
            'nameProduct' => $productArr['nameProduct'],
            'image' => $productArr['image'],
            'detailsImg'=>$productArr['detailsImg'],
            'price' => $productArr['price'],
            'description' => $productArr['description'],
            'quantity' => $productArr['quantity'],
            'type' => $productArr['type'],
            'sale' => $productArr['sale'],
            'idTrademark' => $productArr['idTrademark']
        ]);
    }

    // update product
    public function updateProduct($productArr)
    {
        $affected = DB::table($this->table)
            ->where('idProduct', $productArr['idProduct'])
            ->update([
                'nameProduct' => $productArr['nameProduct'],
                'image' => $productArr['image'],
                'detailsImg'=>$productArr['detailsImg'],
                'price' => $productArr['price'],
                'description' => $productArr['description'],
                'quantity' => $productArr['quantity'],
                'type' => $productArr['type'],
                'sale' => $productArr['sale'],
                'idTrademark' => $productArr['idTrademark']
            ]);
    }

    // delete product
    public function deleteProduct($idProduct){
        $deleted = DB::table($this->table)->where('idProduct', '=', $idProduct)->delete();
    }

    public function searchProductByName($key){
        $listProduct= DB::table($this->table)->where('nameProduct', 'like', '%'.$key.'%')->orWhere('idProduct', 'like', '%'.$key.'%')->paginate(9);
        return $listProduct;
    }


}
