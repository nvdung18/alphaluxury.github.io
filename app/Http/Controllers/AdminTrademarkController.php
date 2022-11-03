<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Trademark;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminTrademarkController extends Controller
{

    public function __construct()
    {
        $this->product = new Product();
        $this->trademark = new Trademark();
    }

    public function getAllTrademark(Request $request)
    {

        $listTrademark = $this->trademark->getAllTrademarkPaginate();

        // get number of products available in trademark
        $numOfProducts = $this->trademark->getNumOfProductsInTrademark();

        // dd($numOfProducts);
        return view('admins.trademark', compact('listTrademark', 'numOfProducts'));
    }

    // Edit trademark
    public function editTrademark(Request $request)
    {

        $trademark = $this->trademark->getTrademarkByID($request->idTrademark);

        return view('admins.edit-trademark', compact('trademark'));
    }

    public function confirmEdit(Request $request)
    {
        $trademarkArr = array(
            'idTrademark' => $request->idTrademark,
            'nameTrademark' => $request->nameTrademark
        );
        $this->trademark->updateTrademark($trademarkArr);
        return redirect()->route('ad.trademark');
    }

    // Delete trademark
    public function deleteTrademark(Request $request)
    {
        // get nameTrademark to delete main and details folder of trademark
        // $nameTrademark = $this->trademark->getTrademarkByID($request->idTrademark);
        // $slugNameTrademark = "";
        // foreach ($nameTrademark as $value) {
        //     $slugNameTrademark = $value->nameTrademark;
        // }
        // $slugNameTrademark = Str::slug($slugNameTrademark, '_');

        //check if folder exits, we delete it 
        // $this->rrmdir(public_path('frontend/img/product/'.$slugNameTrademark));
        
        // delete
        $this->trademark->deleteTrademark($request->idTrademark);
        // rmdir('frontend/img/product/'.$slugNameTrademark);
        return redirect()->route('ad.trademark');
    }

    public function rrmdir($src) {
        $dir = opendir($src);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                $full = $src . '/' . $file;
                echo'<pre>';var_dump($full);echo'</pre>';
                if ( is_dir($full) ) {
                   return $this->rrmdir($full);
                }
                else {
                    unlink($full);
                }
            }
        }
        closedir($dir);
        rmdir($src);
    }

    // Add new trademark
    public function addTrademark(Request $request)
    {
        // Get all information of trademark
        $nameTrademark = $request->nameTrademark;

        // get max id, then auto create new id for new trademark
        $maxIdTrademark = $this->trademark->getMaxIdTrademark();
        $num = $maxIdTrademark + 1;
        $newIdTrademark = 'tm' . (string)$num;

        // create arr contains information of trademark to insert into database
        $trademarkArr = array(
            'idTrademark' => $newIdTrademark,
            'nameTrademark' => $nameTrademark
        );

        // create main folder and details folder for trademark
        $slugNameTrademark = Str::slug($trademarkArr['nameTrademark'], '_');
        if (!is_dir(public_path('frontend/img/product/' . $slugNameTrademark))) {
            mkdir(public_path('frontend/img/product/' . $slugNameTrademark));
            mkdir(public_path('frontend/img/product/' . $slugNameTrademark . '/details'));
        }

        // add trademark
        $this->trademark->addNewTrademark($trademarkArr);
        return redirect()->route('ad.trademark');
    }
}
