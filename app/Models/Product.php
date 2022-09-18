<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class product extends Model
{
    use HasFactory;
    protected $table='product';
    public function getAllProduct(){
        $product=DB::table($this->table)->get();

        // $product=DB::table($this->table)->paginate(8); => Phan trang
        return $product;
    }
}
