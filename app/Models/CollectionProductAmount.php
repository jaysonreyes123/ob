<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionProductAmount extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','price'];

    public function product_(){
        return $this->hasOne(CollectionProduct::class,'id','product_id');
    }
}
