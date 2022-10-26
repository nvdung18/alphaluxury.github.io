<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Trademark;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class AdminShopController extends Controller
{
    //
    public function __construct()
    {
        $this->product = new Product();
        $this->trademark = new Trademark();
        // $this->adShop=new AdminShopController();
    }

    public function getAllProductPaginate()
    {
        $listProduct = $this->product->getAllProductPaginate();
        $listTrademark = $this->trademark->getAllTrademark();
        return view('admins.product', compact('listProduct', 'listTrademark'));
    }

    public function addProduct(Request $request)
    {
        // Get all information of product 
        $nameProduct = $request->nameProduct;
        $quantity = $request->quantity;
        $price = $request->price;
        $type = $request->type;
        $sale = $request->sale;
        $description = $request->description;
        // get name branch and id branch
        $idTrademark = $request->trademark;
        $trademark = $this->trademark->getTrademarkByID($idTrademark);
        $nameTrademark = "";
        foreach ($trademark as $value) {
            $nameTrademark = $value->nameTrademark;
        }
        // get name image and upload image
        $nameImg = $this->uploadFileImg($nameTrademark);

        // get last row to get last id, then auto create new id for new product
        $lastRowProduct = $this->product->getLastRowProduct();
        $lastIdProduct = "";
        foreach ($lastRowProduct as $value) {
            $lastIdProduct = $value->idProduct;
        }
        $lastIdProduct = explode("SP", $lastIdProduct);
        $num = (int)$lastIdProduct[1] + 1;
        $newIdProduct = 'SP' . (string)$num;

        // create arr contains information of product to insert into database
        $productArr = array(
            'idProduct' => $newIdProduct,
            'image' => $nameImg,
            'nameProduct' => $nameProduct,
            'idTrademark' => $idTrademark,
            'quantity' => $quantity,
            'price' => $price,
            'type' => $type,
            'sale' => $sale,
            'description' => $description
        );

        // dd($nameImg);
        $this->product->addNewProduct($productArr);
        return redirect()->route('ad.product');
    }

    public function uploadFileImg($nameTrademark)
    {
        $trademark = $nameTrademark;
        $trademark = Str::slug($trademark, '_');
        $target_dir = public_path('frontend/img/product/' . $trademark . '/');
        $target_file = $target_dir . basename($_FILES["imageProduct"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_GET["submit"])) {
            $check = getimagesize($_FILES["imageProduct"]["tmp_name"]);
            if ($check !== false) {
                // echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                // echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry,your file was not upload";
        } else {
            if (move_uploaded_file($_FILES["imageProduct"]["tmp_name"], $target_file)) {
                echo "The File" . basename($_FILES["imageProduct"]["name"]) . " has been uploaded";
            } else {
                echo "Sorry,there was an error uploading your file";
            }
        }

        $nameImg = $trademark . '/' . basename($_FILES["imageProduct"]["name"]);
        $nameImg = Str::replace('.jpg', '', $nameImg);
        // dd($nameImg);
        return $nameImg;
    }

    // Details product
    public function detailsProduct(Request $request)
    {
        $product = $this->product->getProductById($request->idProduct);

        $idTrademark = "";
        foreach ($product as $value) {
            $idTrademark = $value->idTrademark;
        }

        $nameTrademark = $this->getNameTrademark($idTrademark);
        // dd($product[0]);
        return view('admins.details-product', compact('product', 'nameTrademark'));
    }

    public function getNameTrademark($idTrademark)
    {
        $trademark = $this->trademark->getTrademarkByID($idTrademark);
        $nameTrademark = "";
        foreach ($trademark as $value) {
            $nameTrademark = $value->nameTrademark;
        }
        return $nameTrademark;
    }

    // delete product
    public function editProduct(Request $request)
    {
        $product = $this->product->getProductById($request->idProduct);
        $listTrademark = $this->trademark->getAllTrademark();
        $idTrademark = "";
        foreach ($product as $value) {
            $idTrademark = $value->idTrademark;
        }

        // $nameTrademark = $this->getNameTrademark($idTrademark);
        // dd($product);
        return view('admins.edit-product', compact('product', 'listTrademark','idTrademark'));
    }

    public function confirmEdit(Request $request)
    {
        // Get all information of product 
        $idProduct=$request->idProduct;
        $nameProduct = $request->nameProduct;
        $quantity = $request->quantity;
        // remove the sign ','
        $price = $request->price;
        $type = $request->type;
        $sale = $request->sale;
        $description = $request->description;

        // get name branch and id branch
        $idTrademark = $request->trademark;
        $nameTrademark = $this->getNameTrademark($idTrademark);
        $nameImg="";
        if (isset($request->imageProduct)) {
            // get name image and upload image
            $nameImg = $this->uploadFileImg($nameTrademark);
        } else {
            $nameImg=$request->img_p_old;
        }
        // dd($request->all());
        // create arr contains information of product to insert into database
        $productArr = array(
            'idProduct'=>$idProduct,
            'image' => $nameImg,
            'nameProduct' => $nameProduct,
            'idTrademark' => $idTrademark,
            'quantity' => $quantity,
            'price' => $price,
            'type' => $type,
            'sale' => $sale,
            'description' => $description
        );
        // dd($productArr);
        // update product
        $this->product->updateProduct($productArr);
        return redirect()->route('ad.product');
    }

    // Delete product
    public function deleteProduct(Request $request){
        // dd($request->all());
        $this->product->deleteProduct($request->idProduct);
        return redirect()->route('ad.product');
    }
}
