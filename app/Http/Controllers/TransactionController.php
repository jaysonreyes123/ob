<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant\Api;
use App\Models\Failed;
use App\Models\Success;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Curl;

class TransactionController extends Controller
{

    public function failed($payment,Request $request){
        $date = Carbon::now()->format('Y-m-d');
        $error_message = "";
        $id = "";
        if($payment == "magpie"){
            $charge_id = $request->get('charge_id');
            $id = $charge_id;
            $response = $this->check_status($payment,$charge_id);
            if($response->status == 200){
                $error_message = $response->content->failure_data->reason;
            }  
        }
        else if($payment == "paypal"){
            $token_charge = $request->get('token');
            $id = $token_charge;
            $error_message = "Cancel/Return";
        }
        $transaction_model = Transaction::where('transaction_id',$id)->first();
        Failed::create([
            "transaction_id" => $transaction_model->id,
            "status"        => $error_message
        ]);
        $transaction_model->status = "failed";
        $transaction_model->save();
        return redirect()->route('product.show',["id"=>$transaction_model->product,"access_token"=>User::ACCESS_TOKEN])->with(["error-message" => $error_message]);

    }

    public function success($payment,Request $request){
        $status_message = "Transaction successfully";
        $success = 1;
        $date = Carbon::now()->format('Y-m-d');
        if($payment == "magpie"){
            $charge_id = $request->get('charge_id');
            $response = $this->check_status($payment,$charge_id);
            if($response->status == 200){
                    $status = $response->content->status;
                    $transaction_model = Transaction::where('transaction_id',$charge_id)->first();
                    if($status == "succeeded"){
                        Success::create([
                            "transaction_id" => $transaction_model->id,
                        ]);
                    }
                    else if($status == "failed"){
                        $status = $response->content->failure_data->reason;
                        Failed::create([
                            "transaction_id" => $transaction_model->id,
                            "status"        => $response->content->failure_data->reason
                        ]);
                        $success = 0;
                    }  
                $transaction_model->status = $status;
                $transaction_model->save();
                $status_message =  ucfirst($status);
            }
        }
        else if($payment == "paypal"){
            $token_charge = $request->get('token');
            $transaction_model = Transaction::where('transaction_id',$token_charge)->first();
            Success::create([
                "transaction_id" => $transaction_model->id,
            ]);
        }
        if($success == 1){
            return redirect()->route('product.show',["id"=>$transaction_model->product,"access_token"=>User::ACCESS_TOKEN])->with(["success-message" => $status_message ]);
        }
        else{
            return redirect()->route('product.show',["id"=>$transaction_model->product,"access_token"=>User::ACCESS_TOKEN])->with(["error-message" => $status_message ]);
        }
        
    }

    public function check_status($payment,$charge_id){
        if($payment == "magpie"){
            $response = Curl::to(Api::MAGPIE_API."charges/".$charge_id)
            ->withOption('USERPWD',Api::MAGPIE_SECRET_KEY)
            ->asJson()
            ->returnResponseObject()
            ->get();
        }
        return $response;
    }
}
