<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Success extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_id'];
    public function transaction(){
        return $this->hasOne(Transaction::class,'id','transaction_id');
    }
}
