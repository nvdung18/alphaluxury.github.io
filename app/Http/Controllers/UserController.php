<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Trademark;
use App\Models\UserOrder;

use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Account;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View as FacadesView;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View as ViewView;
use Spatie\FlareClient\View as FlareClientView;
use Termwind\Components\Dd;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

use function PHPUnit\Framework\returnSelf;
use function PHPUnit\Framework\returnValueMap;

class UserController extends Controller
{

    public function __construct()
    {
        $this->product = new Product();
        $this->trademark = new Trademark();
        $this->listTrademark = $this->trademark->getAllTrademark();
        $this->countTrademark = $this->trademark->countTrademark();
        $this->user = new User();
        $this->order = new UserOrder();
        $this->customer = new Customer();
    }

    public function check(Request $request)
    {
    }

    public function user_registration_rules(array $data)
    {
        $messages = [
            'name.required' => 'Please enter Name',
            'address.required' => 'Please enter Address',
            'address.min' => 'Minimum six letters',
            'phone.required' => 'Please enter Phone Number',
            'phone.size' => 'Maximun ten numbers',
            'password.required' => 'Please enter Password',
            'password.confirmed' => 'Two passwords incorrect',
            'password.min' => 'Minimum six numbers',
            'gender.required' => 'Please press gender'
        ];

        $validator = Validator::make($data, [
            'name' => 'required|min:1|max:30|alpha',
            'email' => 'required|email',
            'address' => 'required|min:6|alpha_num',
            'phone' => 'required|min:10|numeric',
            'password' => 'required|confirmed|min:3|max:16',
            'gender' => 'required|integer',
        ], $messages);

        return $validator;
    }

    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|min:1|max:30',
                    'email' => 'required|email',
                    'password' => 'required|confirmed|min:3|max:16',
                ]
            );
            // $validator = $this->user_registration_rules($request->all());
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        $user = DB::table('user')->where('email', '=', $request->email)->first();
        $timestamp = date('Y-m-d H:i:s');
        if (!$user) {
            // $lastuser = DB::table('user')->get()->last()->idUser;
            $allus = DB::table('user')->get();
            $countallus = $allus->count();
            if ($countallus == 0) {
                $newUser = new Customer();
                $us = 1;
                $newUser->idUser = 'Us_' . $us;
                $newUser->nameUser = $request->name;
                $newUser->fullname = uniqid();
                $newUser->email = $request->email;
                $newUser->password = bcrypt($request->password);
                $newUser->role = $request->role;
                $newUser->status = $request->status;
                // $newUser->email_verified_at = $timestamp;
                $newUser->save();

                $newAccount = Account::create([
                    'idAccount' => 'Ac_' . $us,
                    'method' => 'Default',
                    'userName' => $newUser->nameUser,
                    'password' => $newUser->password,
                    'idUser' => $newUser->idUser
                ]);
                
                

                $all_us_ac = DB::table('user')
                ->join('account', 'user.idUser', '=', 'account.idUser')
                ->where('user.idUser', '=', $newUser->idUser)
                ->select('user.*', 'account.*')
                ->get()
                ->first();

                $firstcart = DB::table('cart')->get();
                $i = 1;
                if(count($firstcart) == 0) {
                    $firstcart = DB::table('cart')->insert([
                        'idCart' => 'Cart_' . $i,
                        'idAccount' => $all_us_ac->idAccount
                    ]);
                }
                return redirect()->route('register')->with([
                    'message' => 'You did create a account successfully.',
                ]);
            } else {
                $lastuser = DB::table('user')->get()->last()->idUser;
                if ($lastuser != '' || $lastuser != null) {
                    $data = explode('_', $lastuser);
                    $newUser = new Customer();
                    $newUser->idUser = 'Us_' . ++$data[1];
                    $newUser->nameUser = $request->name;
                    $newUser->fullname = uniqid();
                    $newUser->email = $request->email;
                    $newUser->password = bcrypt($request->password);
                    $newUser->role = $request->role;
                    $newUser->status = $request->status;
                    // $newUser->email_verified_at = $timestamp;
                    $newUser->save();
                    $lastaccount = DB::table('account')->get()->last()->idAccount;
                    if ($lastaccount != '' || $lastaccount != null) {
                        $data = explode('_', $lastaccount);
                        $newAccount = Account::create([
                            'idAccount' => 'Ac_' . ++$data[1],
                            'method' => 'Default',
                            'userName' => $newUser->nameUser,
                            'password' => $newUser->password,
                            'idUser' => $newUser->idUser
                        ]);
                    }

                    $all_us_ac = DB::table('user')
                    ->join('account', 'user.idUser', '=', 'account.idUser')
                    ->where('user.idUser', '=', $newUser->idUser)
                    ->select('user.*', 'account.*')
                    ->get()
                    ->first();

                    $cartlast = DB::table('cart')->get()->last();
                    $data = explode('_', $cartlast->idCart);
                    $datapl = ++$data[1];
                    
                    $firstcart = DB::table('cart')->get();
                    if(count($firstcart) != 0) {
                        $addpd = DB::table('cart')->insert([
                            'idCart' => 'Cart_' . $datapl,
                            'idAccount' => $all_us_ac->idAccount
                        ]);
                    }

                    return redirect()->route('register')->with([
                        'message' => 'You did create a account successfully.',
                    ]);
                }
            }
        } else {
            return redirect()->route('register')->with([
                'message' => 'Email is exist ',
            ]);
        }
    }

    public function showlogin()
    {
        if (Auth::check()) {
            return redirect()->route('home')->with([
                'user' => Auth::user(),
            ]);
        }
        return view('users.login');
    }

    public function forgotpw()
    {
        return view('users.fotgotpw');
    }

    public function checklogin(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'nameUser' => 'required',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            // Auth ma hoa bang bcrypt
            if (Auth::attempt($request->only('nameUser', 'password'), true)) {
                if (Auth::user()->status != 1) {
                    Auth::user()->tokens->each(function ($token, $key) {
                        $token->delete();
                    });
                    Auth::logout();
                    return redirect()->route('user.login')->with([
                        'message' => 'Account has been locked'
                    ]);
                }
                $user = Customer::where('nameUser', '=', $request->nameUser)->first();
                if (Auth::user()->role == 1) {
                    Auth::user()->setRememberToken($user->remember_token);
                    Auth::loginUsingId($user->idUser, true);;
                    return redirect()->route('home');
                }
                // else if (Auth::user()->role != 1) {
                //     Auth::user()->tokens->each(function ($token, $key) {
                //         $token->delete();
                //     });
                //     Auth::logout();
                //     return redirect()->route('user.login')->with([
                //         'message' => "You cant access to use website"
                //     ]);
                // }
            } else {
                return redirect()->route('user.login')->with([
                    'message' => 'Account is not exist'
                ]);
            }
        }
    }

    public function resetpasswordCallback(Request $request)
    {
        $data = $request->email;
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_mail = 'Recieve Password from Shopbanhangwatch.com' . '' . $now;
        $user = Customer::where('email', $data)->get()->first();
        // dd($user->idUser);
        $user_id = $user->idUser;
        if ($user) {
            $count_user = $user->count();
            if ($count_user == 0) {
                return redirect()->back()->with('error', 'Email is not registered');
            } else {
                $token_random = Str::random();
                $user = Customer::where('idUser', $user_id)->get()->first();
                $user->remember_token = $token_random;
                $user->save();
                //send email
                $to_email = $request->email;
                $link_reset_email = url('/resetpassword?email=' . $to_email . '&token=' . $token_random);
                $data = array(
                    'name' => $title_mail,
                    'body' => $link_reset_email,
                    'email' => $request->email
                );
                Mail::send('users.forgotpw_notify', ['data' => $data], function ($message) use ($title_mail, $data) {
                    $message->to($data['email'])->subject($title_mail);
                    $message->from($data['email'], $title_mail);
                });
                return redirect()->back()->with('message', 'Send gmail successfully, Please check email to reset password');
            }
        } else {
            return redirect()->back()->with('error', 'Email is not registered');
        }
    }

    public function formresetpw(Request $request)
    {
        $email = $request->input('email');
        $token = $request->input('token');
        return view('users.resetpw')->with([
            'email' => $email,
            'token' => $token
        ]);
    }

    public function newpassword(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'password' => 'required|confirmed|min:3|max:16',
                ]
            );
            // $validator = $this->user_registration_rules($request->all());
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $user = Customer::where('remember_token', '=', $request->token)->get()->first();
            if ($user) {
                $user->password = bcrypt($request->password);
                $token = Str::random();
                $user->remember_token = $token;
                $user->save();
                return redirect()->back()->with('message', 'Reset Password Successful. Please try login again');
            }
        }
    }


    public function logout(Request $request)
    {
        Auth::user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        Auth::logout();
        return redirect()->route('user.login');
    }

    // load infor user
    public function show_form_user_page(Request $request)
    {
        // load user profile
        $infor = $this->user->getUserInformation(Auth::id());

        // load order of user 
        $listOrder = $this->order->getOrderAndDetailByID(Auth::id()); // get list order of user
        // $a=(json_decode($listOrder[0]->status));
        // foreach($a as $key=>$value){
        //     echo $key." ";
        // }
        // dd($a);
        // load header
        $listProduct = $this->product->getAllProduct();
        $listTrademark = $this->trademark->getAllTrademark();
        $countTrademark = $this->trademark->countTrademark();
        $tag = "home";
        return view('users.personel', compact('listProduct', 'listTrademark', 'countTrademark', 'tag', 'infor', 'listOrder'));
    }

    // update infor user
    public function updateUserInfor(Request $request)
    {
        $arrInforUser = array(
            "fullname" => $request->fullname,
            "email" => $request->email,
            "address" => $request->address,
            "phoneNumber" => $request->phoneNumber,
            "gender" => $request->gender
        );
        // dd($arrInforUser);
        $this->user->updateInforUser(Auth::id(), $arrInforUser);

        return redirect()->route('user.page');
    }

    // get detail order
    public function getDetailOrder(Request $request)
    {
        $order = $request->listDetailProduct;

        // get checkout of order
        $checkout = $this->order->getAddressOrder($request->listDetailProduct[0]["idAccount"], $request->listDetailProduct[0]["idOrder"]);

        // get payment
        $payment = $this->order->getPaymentOrder($request->listDetailProduct[0]["idOrder"]);
        // dd($payment[0]);

        // load header
        $listProduct = $this->product->getAllProduct();
        $listTrademark = $this->trademark->getAllTrademark();
        $countTrademark = $this->trademark->countTrademark();
        $tag = "home";

        return view('users.detail-order', compact('listProduct', 'listTrademark', 'countTrademark', 'tag', 'order', 'checkout', 'payment'));
    }

    public function loginadmin(Request $request)
    {
        $token = Cookie::get('token');
        // $cookienew = Cookie::make('tokennot', '', time() + 1000);
        // response()->redirectToRoute('loginadmin')->withCookie($cookienew);
        if (isset($token) && $token != null) {
            return redirect()->route('admin')->with([
                'admin' => json_decode($token)
            ]);
        }
        // return response()->redirectToRoute('loginadmin')->withCookie($cookienew);
        return view('parts_admin.login');
    }

    public function checkloginadmin(Request $request)
    {
        if ($request->isMethod('POST')) {

            $validator = Validator::make($request->all(), [
                'nameUser' => 'required|min:1',
                'password' => 'required:|min:1',
                'remember' => 'nullable'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $remember = $request->remember;
            $tk = $request->nameUser;
            $mk = Hash('md5', $request->password);
            $adminlogin = Customer::where('nameUser', '=', $tk)->where('password', '=', $mk)->where('role', '=', 2)->first();
            if ($adminlogin) {
                if ($remember == 'on') {
                    // $response = new Response();
                    // $response->withCookie(cookie('token', json_encode($adminlogin), time() + 86400), '/');
                    $cookie = Cookie::make('token', json_encode($adminlogin), time() + 86400);
                    // dd(Cookie::get('token'));
                    return response()->redirectToRoute('admin')
                        ->withCookie($cookie);
                } else {
                    // return redirect()->route('admin', ['status' => 'notsave'])->with([
                    //     'admin' => json_encode($adminlogin)
                    // ]);
                    $cookienew = Cookie::make('tokennot', json_encode($adminlogin), time() + 86400);
                    // dd($cookienew);
                    return response()->redirectToRoute('admin',['status' => 'notsave'])
                    ->withCookie($cookienew);
                }
            } else {
                return redirect()->route('loginadmin')->with([
                    'message' => 'Failed Username or Password'
                ]);
            }
        }
    }


    public function logoutadmin(Request $request)
    {
        $cookie = Cookie::make('token', null, time() + 1000);
        return response()->redirectToRoute('admin')
            ->withCookie($cookie);
    }

    public function updatePassword(Request $request) {
        if ($request->isMethod('POST')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'password' => 'required|confirmed|min:3|max:16',
                ]
            );
            // $validator = $this->user_registration_rules($request->all());
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $idUser = Auth::user()->idUser;
            $user = Customer::where('idUser', '=', $idUser)->get()->first();
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->back()->with([
                'messagepassword' => 'Updated Password Successful'
            ]);
        }
    }
}
