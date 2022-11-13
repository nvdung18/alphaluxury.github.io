<?php

        namespace App\Http\Controllers;
        
        use App\Models\Checkout;
        use App\Models\Order;
        use Illuminate\Http\Request;
        use App\Models\Product;
        use App\Models\Promocode;
        use App\Models\Payment;
        use App\Models\Trademark;
        use Illuminate\Contracts\Session\Session;
        use Illuminate\Support\Facades\Auth;
        use Illuminate\Support\Facades\DB;
        use Illuminate\Support\Facades\Redirect;
        use Illuminate\Support\Facades\URL;
        use Illuminate\Support\Facades\Validator;
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
                $this->promocode = new Promocode();
                $this->checkout = new Checkout();
                $this->order = new Order();
                $this->payment = new Payment();
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

        public function test(Request $request){
            $tag=$request->tag;
            return view('users.product-details', compact('tag'),['listTrademark' => $this->listTrademark, 'countTrademark' => $this->countTrademark]);
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
                $currLoc = $request->currLoc;
                session(['currUrl' => $currLoc]);
                // return response()->json($taskurl);
                // die();
                $product = DB::table('product')->where('idProduct', '=', $idProduct)->get()->first();
                // return response()->json($product);
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
                        // return response()->json(['Success']);
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

            public function previouspage(Request $request) {
                $tag = $request->tag;
                $listTrademark=$this->trademark->getAllTrademark();
                $countTrademark=$this->trademark->countTrademark();
                $url = session('currUrl');
                return redirect($url);
            }

            public function discount(Request $request) {
                    $discount = $request->discount;
                    if($discount != '' || $discount != null) {
                        $discountpercent = $this->promocode->getIdpromocode($discount);
                        if($discountpercent != null && isset($discountpercent)) {
                            return response()->json($discountpercent);
                        } else {
                            return response()->json('null');
                        }
                    } else {
                        return response()->json('You have not entered the code');
                    }
                    // return response()->json('Empty');
            }

            public function showcheckout(Request $request) {
                $tag = $request->tag;
                $listTrademark=$this->trademark->getAllTrademark();
                $countTrademark=$this->trademark->countTrademark();
                $discount = 'prcode_01';
                $total = 0;  
                if(isset($request->discount) && $request->discount != '') {
                    $discount = $request->discount;
                }
                if(isset($request->total) && $request->total != '') {
                    $total = $request->total;
                }  

                $idUser = Auth::user()->idUser;
            
                $prcode = DB::table('promocode')->where('idPromoCode','=',$discount)->get()->first();

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

                $product_of_us = json_encode($product_in_cart);

                return view('users.checkout', compact('tag', 'listTrademark', 'countTrademark', 'discount', 'total', 'product_in_cart', 'all_us_ac', 'prcode', 'product_of_us'));
            }

            public function addcheckout(Request $request) {
                $fullname = '';
                $streetaddress = '';
                $addressoptional = '';
                $city_or_towm = '';
                $country_or_state = ''; 
                $phone = '';
                $email = '';
                $ordernotes = '';
                $payment = '';
                $address = '';
                if($request->isMethod('POST')) {
                    $validator = Validator::make($request->all(),
                    [
                        'fullname'=>'required|min:1|max:30',
                        'streetaddress'=>'required|min:1',
                        'addressoptional' => 'nullable',
                        'city_or_towm' => 'required|min:1',
                        'country_or_state' => 'required|min:1',
                        'phone' => 'required|min:1',
                        'email'=>'required|email',
                        'ordernotes'=>'nullable',
                        'payment'=>'required|min:1'
                    ]);
                    // $validator = $this->user_registration_rules($request->all());
                    if($validator->fails()) {
                        return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
                    }
                    $fullname = $request->fullname;
                    $streetaddress = $request->streetaddress;
                    if($request->addressoptional != null || $request->addressoptional != '') {
                        $addressoptional = $request->addressoptional;
                    }
                    $city_or_towm = $request->city_or_towm;
                    $country_or_state = $request->country_or_state;
                    $phone = $request->phone;
                    $email = $request->email;
                    $ordernotes = $request->ordernotes;
                    $payment = $request->payment;
                    if($addressoptional != '') {
                        $address = $streetaddress.','.$addressoptional.','.$city_or_towm.','.$country_or_state;
                    } else {
                        $address = $streetaddress.','.$city_or_towm.','.$country_or_state;
                    }

                    $idUser = Auth::user()->idUser;

                    $account = DB::table('user')
                    ->join('account','user.idUser','=','account.idUser')
                    ->where('user.idUser', '=', $idUser)
                    ->select('user.*', 'account.*')
                    ->get()
                    ->first();

                    
                    $listcheckout = $this->checkout->getallcheckout();
                    $date = date("Y/m/d");
                    $time = date("h:i:sa");
                    // dd(count($listcheckout));
                    $datetime = date("Y-m-d h:i:sa");

                    if(count($listcheckout) == 0) {
                    $checkout = Checkout::create([
                            'idCheckout' => 'Cko_01',
                            'recipientName' => trim($fullname),
                            'recipientPhoneNumber' => trim($phone),
                            'recipientEmail' => trim($email),
                            'recipientAddress' => trim($address),
                            'idAccount' => $account->idAccount,
                    ]);
                    $newarr = array(
                        '1' => [$date, $time,'Wait for confirmation']
                    );
                    $listorder = $this->order->getlistorder();
                    if(count($listorder) == 0) {
                        $order = Order::create([
                            'idOrder' => 'ord_01',
                            'status'  => json_encode($newarr),
                            'deliveryTime' => $datetime,
                            'orderNotes' => trim($ordernotes),
                            'deliveryCharges' => 0,
                            'productMoney' => trim($request->subtotal),
                            'totalMoney' => trim($request->totalnew),
                            'idAccount' => $account->idAccount,
                            'idPayment' => trim($payment),
                            'idPromoCode' => trim($request->promoCode)
                        ]);
                    } else {
                            $lastorder = $this->order->getlastorder();
                            $count = explode('_',$lastorder->idOrder);
                            $value = intval($count[1])+1;
                            if ((intval($count[1])+1) < 10) {
                                $value = str_pad(intval($count[1])+1, 2, "0", STR_PAD_LEFT);
                            }
                            $order = Order::create([
                                'idOrder' => 'ord_'.$value,
                                'status'  => json_encode($newarr),
                                'deliveryTime' => $datetime,
                                'orderNotes' => trim($ordernotes),
                                'deliveryCharges' => 0,
                                'productMoney' => trim($request->subtotal),
                                'totalMoney' => trim($request->totalnew),
                                'idAccount' => $account->idAccount,
                                'idPayment' => trim($payment),
                                'idPromoCode' => trim($request->promoCode)
                            ]);
                        }

                        // $this->payment->addTotalpayment(trim($payment));
                        $paymentnew = DB::table('payment')->where('idPayment', '=',$payment)->get()->first();
                        $num = intval($paymentnew->totalPayment) + intval($request->totalnew);
                        DB::table('payment')->where('idPayment', '=', $paymentnew->idPayment)
                                            ->update([
                                                    'totalPayment' => $num
                                                ]);
                        
                        $idOrderLastest = $this->order->getidOrderLastest();
                        $idOrdernew = $idOrderLastest->idOrder;
                        $product_in_cart = json_decode($request->product_in_cart);
                        for($i = 0; $i < count($product_in_cart); $i++) {
                            $orderdetail = DB::table('orderdetail')->insert([
                                "idOrder" => $idOrdernew,
                                "idProduct" => $product_in_cart[$i]->idProduct,
                                "quantity" => $product_in_cart[$i]->quantity,
                                "total" => $product_in_cart[$i]->price*$product_in_cart[$i]->quantity
                             ]);
                        }     
                    } else {
                        $lastcheckout = $this->checkout->getlastcheckout();
                        $data = explode('_', $lastcheckout->idCheckout);
                        $value = intval($data[1])+1;
                        if ((intval($data[1])+1) < 10) {
                            $value = str_pad(intval($data[1])+1, 2, "0", STR_PAD_LEFT);
                        }
                        $checkout = Checkout::create([
                            'idCheckout' => 'Cko_'.$value,
                            'recipientName' => trim($fullname),
                            'recipientPhoneNumber' => trim($phone),
                            'recipientEmail' => trim($email),
                            'recipientAddress' => trim($address),
                            'idAccount' => $account->idAccount,
                        ]);
                        $newarr = array(
                            '1' => [$date, $time,'Wait for confirmation']
                        );

                        $listorder = $this->order->getlistorder();
                        if(count($listorder) == 0) {
                            $order = Order::create([
                                'idOrder' => 'ord_01',
                                'status'  => json_encode($newarr),
                                'deliveryTime' => $datetime,
                                'orderNotes' => trim($ordernotes),
                                'deliveryCharges' => 0,
                                'productMoney' => trim($request->subtotal),
                                'totalMoney' => trim($request->totalnew),
                                'idAccount' => $account->idAccount,
                                'idPayment' => trim($payment),
                                'idPromoCode' => trim($request->promoCode)
                            ]);
                        } else {
                                $lastorder = $this->order->getlastorder();
                                $count = explode('_',$lastorder->idOrder);
                                $value = intval($count[1])+1;
                                if ((intval($count[1])+1) < 10) {
                                    $value = str_pad(intval($count[1])+1, 2, "0", STR_PAD_LEFT);
                                }
                                $order = Order::create([
                                    'idOrder' => 'ord_'.$value,
                                    'status'  => json_encode($newarr),
                                    'deliveryTime' => $datetime,
                                    'orderNotes' => trim($ordernotes),
                                    'deliveryCharges' => 0,
                                    'productMoney' => trim($request->subtotal),
                                    'totalMoney' => trim($request->totalnew),
                                    'idAccount' => $account->idAccount,
                                    'idPayment' => trim($payment),
                                    'idPromoCode' => trim($request->promoCode)
                                ]);
                            }

                            // $this->payment->addTotalpayment(trim($payment));
                            $paymentnew = DB::table('payment')->where('idPayment', '=',$payment)->get()->first();
                            $num = intval($paymentnew->totalPayment) + intval(trim($request->totalnew));
                            DB::table('payment')->where('idPayment', '=', $paymentnew->idPayment)
                                                ->update([
                                                        'totalPayment' => $num
                                                    ]);
                            $idOrderLastest = $this->order->getidOrderLastest();
                            $idOrdernew = $idOrderLastest->idOrder;
                            $product_in_cart = json_decode($request->product_in_cart);
                            for($i = 0; $i < count($product_in_cart); $i++) {
                                $orderdetail = DB::table('orderdetail')->insert([
                                    "idOrder" => $idOrdernew,
                                    "idProduct" => $product_in_cart[$i]->idProduct,
                                    "quantity" => $product_in_cart[$i]->quantity,
                                    "total" => $product_in_cart[$i]->price*$product_in_cart[$i]->quantity
                                ]);
                            }  
                    }
                    
                    $idcart = $product_in_cart[0]->idCart; 
                    // print($idcart);
                    // die();
                    $deleted = DB::table('cartdetail')->where('idCart','=',$idcart)->delete();
                    

                    return redirect()->back()->withErrors([
                        'success' => 'Order has been placed'
                    ]);
                }
            }
            
        }
