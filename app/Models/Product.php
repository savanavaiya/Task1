<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','qty','price','sku','desc'];

    public function img()
    {
        return $this->hasMany(ProductsImage::class,'pro_id','id');
    }
}
