<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Promocode extends Model
{
   use HasFactory;
   protected $table = 'promocode';
   public $timestamps = false;
   protected $primaryKey = 'idPromoCode';
   public $incrementing = false;

   protected $fillable = [
      'idPromoCode',
      'description',
      'discountPercent'
   ];

   public function getIdpromocode($discount)
   {
      $discountpercent = DB::table('promocode')->where('idPromoCode', '=', $discount)->get()->first();
      if (isset($discount) || $discount != null) {
         return $discountpercent;
      } else {
         return null;
      }
   }

   public function getAllPromocode()
   {
      $listPromocode = DB::table('promocode')->paginate(6);
      return $listPromocode;
   }

   public function addPromocode($promocode){
      DB::table($this->table)->insert([
         'idPromoCode' => $promocode['idPromoCode'],
         'description' => $promocode['description'],
         'discountPercent'=>$promocode['discountPercent']
     ]);
   }

   // delete promocode
   public function deletePromocode($idPromocode){
      $deleted = DB::table($this->table)->where('idPromocode', '=', $idPromocode)->delete();
  }
}
