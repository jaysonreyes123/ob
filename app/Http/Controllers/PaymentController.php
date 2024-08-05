<?php

namespace App\Http\Controllers;

use App\Helper\PaymentHelper;
use App\Models\Leads;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    //
    public function process(Request $request){
        $module = $request->module;
        if($request->payment == "magpie"){
            $response = PaymentHelper::magpie($request,$module);
            if($response->status == 201){
                $amount = $request->unit_price * $request->quantity;
                Transaction::create(array_merge($request->all(),["transaction_id" => $response->content->id,"user_id" => 1,"amount" => $amount]));
                Leads::where('phone',$request->phone)->update(['status' => 'processed']);
                return $response->content->action->url;
            }
            else{
                $error = "";
                if($response->status == 422){
                    foreach($response->content->detail as $errors){
                        $error.= "<span style='text-align:left'>$errors->msg</span><br>";
                    }
                }
                elseif($response->status == 500){
                    $error = "Request timeout please try again";
                } 
                return response()->json(["error" => $error],412);
            }
        }
        else if($request->payment == "paypal"){
            $response = PaymentHelper::paypal($request,$module);
            $error = "Request timeout please try again";
            if($response->status == 200 || $response->status == 201){
                Transaction::create(array_merge($request->all(),["transaction_id" => $response->content->id,"user_id" => Auth::id()]));
                return $response->content->links[1]->href;
            }
            else{
                return response()->json(["error" => $error],412);
            }
        }
    }
}
