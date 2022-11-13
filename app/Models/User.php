<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    use HasFactory;
    protected $table='user';
    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array<int, string>
    //  */
    // protected $fillable = [
    //     // 'nameUser',
    //     // 'password',
    //     // 'gender',
    //     // 'address',
    //     // 'phoneNumber',
    //     // 'email',
    //     // 'role'
    // ];

    // /**
    //  * The attributes that should be hidden for serialization.
    //  *
    //  * @var array<int, string>
    //  */
    // protected $hidden = [
    //     'password',
    //     'remember_token'
    // ];

    // /**
    //  * The attributes that should be cast.
    //  *
    //  * @var array<string, string>
    //  */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    // public function setPasswordAttributes($password) {
    //     $this->attributes['password'] = Hash::make($password);
    // }

    public function getUserInformation($idUser){
        $infor=DB::table($this->table)->where('idUser','=',$idUser)->get();
        return $infor;
    }

    // update infor user
    public function updateInforUser($idUser,$arrInforUser){
        // dd($arrInforUser);
        $a=DB::table($this->table)
        ->where('idUser','=',$idUser)
        ->update([
            'fullname'=>$arrInforUser['fullname'],
            'gender'=>$arrInforUser['gender'],
            'address'=>$arrInforUser['address'],
            'phoneNumber'=>$arrInforUser['phoneNumber'],
            'email'=>$arrInforUser['email']
        ]);
    }
}
