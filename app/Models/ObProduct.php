<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product',
        'price',
        'shipping',
        'image'
    ];

    public function product_details_(){
        return $this->hasMany(ObProductDetail::class,'product_id','id');
    }
}
