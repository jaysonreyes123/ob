<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Failed extends Model
{
    use HasFactory;
    protected $fillable = ['transaction_id','status'];
    public function transaction(){
        return $this->hasOne(Transaction::class,'id','transaction_id');
    }
}
