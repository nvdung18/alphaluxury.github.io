<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Checkout extends Model
{
    use HasFactory;
    protected $table='checkout';
    public $timestamps = false;
    protected $primaryKey = 'idCheckout';
    public $incrementing = false;

    protected $fillable = [
        'idCheckout',
        'recipientName',
        'recipientPhoneNumber',
        'recipientEmail',
        'recipientAddress',
        'idAccount'	
    ];

    public function getallcheckout() {
        $listcheckout = DB::table('checkout')->get();
        if(count($listcheckout) != 0) {
           return $listcheckout;
        } else {
           return [];
        }
      }
    public function getlastcheckout() {
       $lastcheckout = DB::table('checkout')->get()->last();
       if(isset($lastcheckout) || $lastcheckout != null) {
          return $lastcheckout;
       }
    }
}
