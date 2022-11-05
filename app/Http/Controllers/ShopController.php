<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Product;
    use App\Models\Trademark;
    use Illuminate\Contracts\Session\Session;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
use PhpParser\NodeVisitor\FirstFindingVisitor;

    use function PHPUnit\Framework\returnValueMap;

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

        public function productDetails($nameproduct, $gender) {
            $listProduct=$this->product->getAllProduct();
            $listTrademark=$this->trademark->getAllTrademark();
            $countTrademark=$this->trademark->countTrademark();
            $tag = $gender;
            $nameproduct = explode('%',$nameproduct);
            $Nproduct = '';
            for($i = 0; $i < count($nameproduct); $i++) {
                $Nproduct .= $nameproduct[$i]."  ";
            }
            $Nproduct = trim($Nproduct);
            $type = '';
            if($gender == 'women') {
                $type = 'female';
            } else if($gender == 'men') {
            $type = 'male';
            }
            // DB::enableQueryLog();
            // $productdetails = DB::table('product')
            //                     ->where('nameProduct', 'LIKE', '%'.(string)$Nproduct.'%')
            //                     ->where('type','LIKE', '%'.(string)$type.'%')
            //                     ->get()
            //                     ->first();
            // dd(DB::getQueryLog());
            $productdetails = DB::table('product')
                    ->join('trademark', 'product.idTrademark', '=', 'trademark.idTrademark')
                    ->where('product.nameProduct', 'LIKE', '%'.(string)$Nproduct.'%')
                    ->where('product.type','LIKE', '%'.(string)$type.'%')
                    ->select('product.*','trademark.*')
                    ->get()
                    ->first();
            $product = json_decode($productdetails->detailsImg, true);
            return view('users.product-details',compact('listProduct','listTrademark','countTrademark','tag','productdetails','product'));
        }

        public function show_shop_cart(Request $request) {
            $tag = $request->tag;
            $listTrademark=$this->trademark->getAllTrademark();
            $countTrademark=$this->trademark->countTrademark();
            // // $listproductincart = [];
            // if(Auth::check()) {
            //     $idUser = Auth::user()->idUser;
            //     // $all_us_ac = DB::table('user')
            //     // ->join('account','user.idUser','=','account.idUser')
            //     // ->where('user.idUser', '=', $idUser)
            //     // ->select('user.*', 'account.*')
            //     // ->get()
            //     // ->first();

            //     // $cart = DB::table('cart')
            //     // ->where('idAccount', '=', $all_us_ac->idAccount)
            //     // ->get()
            //     // ->first();

            //     // $product_in_cart = DB::table('cartdetail')
            //     // ->join('product', 'cartdetail.idProduct','=','product.idProduct')
            //     // ->join('trademark', 'product.idTrademark','=','trademark.idTrademark')
            //     // ->where('cartdetail.idCart','=', $cart->idCart)
            //     // ->select('cartdetail.*', 'product.idProduct', 'product.nameProduct', 'product.image','product.price','product.description', 'trademark.nameTrademark')
            //     // ->get();
            //     return view('users.shop-cart', compact('tag', 'listTrademark', 'countTrademark', 'product_in_cart'));
            // }
            return view('users.shop-cart', compact('tag', 'listTrademark', 'countTrademark'));
        }

        public function addproducttocart(Request $request) {
            $quantity = $request->quantity;
            $idProduct = $request->idProduct;
            $product = DB::table('product')->where('idProduct', '=', $idProduct)->get()->first();
            if(Auth::check()) {
                $idUser = Auth::user()->idUser;
                // return response()->json($idUser);
                $cart = DB::table('cart')->get();
                $all_us_ac = DB::table('user')
                            ->join('account','user.idUser','=','account.idUser')
                            ->where('user.idUser', '=', $idUser)
                            ->select('user.*', 'account.*')
                            ->get()
                            ->first();
                // return response()->json($all_us_ac);
                $i = 1;
                if(count($cart) == 0) {
                    $firstcart = DB::table('cart')->insert([
                        'idCart' => 'Cart_'.$i,
                        'idAccount' => $all_us_ac->idAccount
                    ]);
                    $acCart = DB::table('cart')
                                ->where('idAccount', '=', $all_us_ac->idAccount)
                                ->get()
                                ->first();
                    $firstcartdetail = DB::table('cartdetail')->insert([
                            'idCart' => $acCart->idCart,
                            'idProduct' => $idProduct,
                            'quantity' => $quantity
                    ]);
                    return response()->json([
                        'icon' => 'success',
                        'text' => 'Success Please Check Your Cart'
                    ]);
                } else {
                    $cartlast = DB::table('cart')->get()->last();
                    $data = explode('_', $cartlast->idCart);
                    $datapl = ++$data[1];
                    $account = DB::table('user')
                    ->join('account', 'user.idUser', '=', 'account.idUser')
                    ->where('user.idUser', '=', $idUser)
                    ->select('user.*', 'account.*')
                    ->get()
                    ->first();
                    $checkcart = DB::table('cart')
                                ->where('idAccount', '=', $account->idAccount)
                                ->get()
                                ->first();
                    if(!isset($checkcart) || $checkcart == null) {
                        $addpd = DB::table('cart')->insert([
                            'idCart' => 'Cart_'.$datapl,
                            'idAccount' => $account->idAccount
                        ]);
                        $cartAc = DB::table('cart')
                        ->where('idAccount', '=', $account->idAccount)
                        ->get()
                        ->first();
                        $firstcartdetail = DB::table('cartdetail')->insert([
                             'idCart' => $cartAc->idCart,
                             'idProduct' => $idProduct,
                              'quantity' => $quantity
                            ]);
                            return response()->json([
                                'icon' => 'success',
                                'text' => 'Success Please Check Your Cart'
                            ]);
                    } else {
                        $productincart = DB::table('cartdetail')
                                           ->where('idCart', '=', $checkcart->idCart)
                                           ->where('idProduct', '=', $idProduct)
                                           ->get()
                                           ->first();
                        if(!isset($productincart) || $productincart == null) {
                            $cartdetail = DB::table('cartdetail')->insert([
                                'idCart' => $checkcart->idCart,
                                'idProduct' => $idProduct,
                                 'quantity' => $quantity    
                               ]);
                            return response()->json([
                                'icon' => 'success',
                                'text' => 'Success Please Check Your Cart'
                            ]);
                        } else {

                            $getproduct =  DB::table('cart')
                                                    ->join('cartdetail', 'cart.idCart','=','cartdetail.idCart')
                                                    ->where('cartdetail.idProduct', '=', $idProduct)
                                                    ->where('cartdetail.idCart', '=', $checkcart->idCart)
                                                    ->select('cartdetail.*', 'cart.*')
                                                    ->get()
                                                    ->first();
                            if($quantity == null || $quantity == 1) {
                                $newquantity = $getproduct->quantity + 1;              
                            } else {
                                $newquantity = $getproduct->quantity + $quantity;
                            }

                            // return response()->json($newquantity, 'success');

                            $cartdetail = DB::table('cartdetail')
                                         ->where('idCart', '=', $checkcart->idCart)
                                         ->where('idProduct', '=', $idProduct)
                                         ->update([
                                            'quantity' => $newquantity
                                         ]);    
                            return response()->json([
                                'icon' => 'success',
                                'text' => 'Success Please Check Your Cart'
                            ]);
                            // return response()->json([
                            //    'icon' => 'error',
                            //    'text' => 'Product has added in your cart. Please choose other products'
                            // ]); 
                        }
                        return response()->json([
                            'icon' => 'success',
                            'text' => 'Success Please Check Your Cart'
                        ]);
                    }
                }
            }
            return response()->json([
                'icon' => 'error',
                'text' => 'Add Product Failed!'
            ]);
        }

        public function checkcart() {
            $listproductincart = [];
            if(Auth::check()) {
                $idUser = Auth::user()->idUser;
                $all_us_ac = DB::table('user')
                ->join('account','user.idUser','=','account.idUser')
                ->where('user.idUser', '=', $idUser)
                ->select('user.*', 'account.*')
                ->get()
                ->first();

                $cart = DB::table('cart')
                ->where('idAccount', '=', $all_us_ac->idAccount)
                ->get()
                ->first();

                $product_in_cart = DB::table('cartdetail')
                ->join('product', 'cartdetail.idProduct','=','product.idProduct')
                ->join('trademark', 'product.idTrademark','=','trademark.idTrademark')
                ->where('cartdetail.idCart','=', $cart->idCart)
                ->select('cartdetail.*', 'product.idProduct', 'product.nameProduct', 'product.image','product.price','product.description', 'trademark.nameTrademark')
                ->get();
                return response()->json($product_in_cart);
            }
            return response()->json($listproductincart);
        }

        public function update_cart(Request $request) {
            $quantity = $request->quantity;
            $idProduct = $request->idProduct;
            $idCart = $request->idCart;
            if($quantity == 0) {
                $cartdetail = DB::table('cartdetail')
                ->where('idCart', '=', $idCart)
                ->where('idProduct', '=', $idProduct)
                ->delete();
            } else {
                $cartdetail = DB::table('cartdetail')
                               ->where('idCart', '=', $idCart)
                               ->where('idProduct', '=', $idProduct)
                               ->update([
                                 'quantity' => $quantity
                                ]); 
            }
            return response()->json('success');
        }

        public function delete_cart(Request $request) {
            $idProduct = $request->idProduct;
            $idCart = $request->idCart;
            $cartdetail = DB::table('cartdetail')
            ->where('idCart', '=', $idCart)
            ->where('idProduct', '=', $idProduct)
            ->delete();
            return response()->json('success');
        }
    }
