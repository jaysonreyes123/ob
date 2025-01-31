<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionProduct extends Model
{
    use HasFactory;
    protected $fillable = ['product'];

    public function price_(){
        return $this->hasMany(CollectionProductAmount::class,'product_id','id');
    }
}
