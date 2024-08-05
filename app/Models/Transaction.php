<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'firstname',
        'lastname',
        'address',
        'zip_code',
        'city',
        'state',
        'phone',
        'email',
        'card_number',
        'mm',
        'yy',
        'cvc',
        'quantity',
        'unit_price',
        'amount',
        'payment',
        'product',
        'user_id'
    ];

    public function ob_product(){
        return $this->hasOne(ObProduct::class,'id','product');
    }
    public function collection_product(){
        return $this->hasOne(CollectionProduct::class,'id','product');
    }

    public function success_(){
        return $this->hasOne(Success::class,'id','transaction_id');
    }
    public function failed_(){
        return $this->hasOne(Failed::class,'transaction_id','id');
    }

    public function success(){
        return $this->belongsTo(Success::class,'id','transaction_id');
    }
    public function failed(){
        return $this->belongsTo(Failed::class,'id','transaction_id');
    }

    public function user_(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
