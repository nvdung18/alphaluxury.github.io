<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View as FacadesView;

class UserController extends Controller
{
    
    public function check(Request $request) {
        
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
                'name'=>'required|min:1|max:30|alpha',
                'email'=>'required|email',
                'address'=>'required|min:6|alpha_num',
                'phone'=>'required|min:10|numeric',
                'password'=>'required|confirmed|min:3|max:16',
                'gender'=>'required|integer',     
            ], $messages);

            return $validator;
            }

    public function add(Request $request) {
        if($request->isMethod('POST')) {
            $validator = Validator::make($request->all(),
            [
                'name'=>'required|min:1|max:30',
                'email'=>'required|email',
                'address'=>'required|min:3|alpha_num',
                'phone'=>'required|min:9|numeric',
                'password'=>'required|confirmed|min:3|max:16',
                'gender'=>'required|integer',
            ]);
            // $validator = $this->user_registration_rules($request->all());
            if($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        $user = DB::table('users')->where('email', '=', $request->email)->first();
        $timestamp=date('Y-m-d H:i:s');
        if(!$user) {
            $newUser = new User();
            $newUser->name = $request->name;
            $newUser->email = $request->email;
            $newUser->phone = $request->phone;
            $newUser->address = $request->address;
            $newUser->password = bcrypt($request->password);
            $newUser->role = $request->role;
            $newUser->status = $request->status;
            $newUser->created_at = $timestamp;
            $newUser->updated_at = $timestamp;
            $newUser->save();
            return redirect()->route('register')->with([
                'message' => 'You did create a account successfully.',
            ]);
        } else {
            return redirect()->route('register')->with([
                'message' => 'Email is exist ',
            ]);
        }
    }

    public function showlogin() {
        return view('users.login');
    }

    public function checklogin(Request $request) {
        if($request->isMethod('POST')) {
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'password' => 'required',
            ]);
            if($validator->fails()) {
              return redirect()->back()
              ->withErrors($validator)
              ->withInput();
            }
        // Auth ma hoa bang bcrypt
        if(Auth::attempt($request->only('name', 'password'), true)) {
           if(Auth::user()->status != 1) {
                return redirect()->route('user.login')->with([
                    'message' => 'Account has been locked'
                ]);
           }
           if(Auth::user()->role == 1) {
               return view('users.home');
           } 
        } else {
            return redirect()->route('user.login')->with([
                'message' => 'Account is not exist'
            ]);
        } 
      }
     }
    
}
