<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Promocode extends Model
{
    use HasFactory;
    protected $table='promocode';
    public $timestamps = false;
    protected $primaryKey = 'idPromoCode';
    public $incrementing = false;

    protected $fillable = [
        'idPromoCode',
        'description',
        'discountPercent'
    ];

    public function getIdpromocode($discount) {
       $discountpercent = DB::table('promocode')->where('idPromoCode', '=', $discount)->get()->first();
       if(isset($discount) || $discount != null) {
          return $discountpercent;
       } else {
          return null;
       }
    }

}