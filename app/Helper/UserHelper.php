<?php
namespace App\Helper;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserHelper{
    public static function user_id(){
        $id = 0;
        if(Auth::check()){
            $id = Auth::id();
        }
        else{
            $customer_model = User::where('role',4)->where('email','customer')->first();
            $id = $customer_model->id;
        }

        return $id;
    }
}