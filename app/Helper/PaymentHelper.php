<?php

namespace App\Helper;

use App\Constant\Api;
use Curl;
use Illuminate\Support\Facades\Session;

class PaymentHelper{
    public static function USDCurrency(){
        return 58.66;
    }
    public static function magpie($data,$module){
        $payload_auth = [
            'type' => 'card',
            'card' => [
                'name'      => $data->firstname." ".$data->lastname,
                'number'    => $data->card_number,
                'exp_month' => $data->mm,
                'exp_year'  => 2000 + (int) $data->yy,
                'cvc'       => $data->cvc
            ],
            'redirect' => [
                'success' => env('APP_URL')."magpie/success",
                'fail'    => env("APP_URL")."magpie/failed",
            ]
        ];
        $response_auth = Curl::to(Api::MAGPIE_API."sources/")
            ->withOption('USERPWD',Api::MAGPIE_PUBLISH_KEY)
            ->withData($payload_auth)
            ->asJson()
            ->returnResponseObject()
            ->post();
        if($response_auth->status == 200){
            $payload = [
                'amount' => (($data->unit_price * $data->quantity ) * 100) * self::USDCurrency(),
                'currency' => 'php',
                'source' => $response_auth->content->id,
                'description' => 'Pure_Leaf_CBD',
                'statement_descriptor' => 'Pure_Leaf_CBD',
                'capture' => true
            ];
            $response = Curl::to(Api::MAGPIE_API."charges/")
            ->withOption('USERPWD',Api::MAGPIE_SECRET_KEY)
            ->withData($payload)
            ->asJson()
            ->returnResponseObject()
            ->post();
            return $response;
        }
        else{
            return $response_auth;
        }
    }

    public static function paypal($data,$module){
        $payload_auth = ['grant_type' => 'client_credentials'];
        $response_auth = Curl::to(Api::PAYPAL_API . 'v1/oauth2/token')
            ->withContentType('application/x-www-form-urlencoded')
            ->withOption('USERPWD', Api::PAYPAL_CLIENT_KEY . ':' . Api::PAYPAL_SECRET_KEY)
            ->withData($payload_auth)
            ->asJsonResponse()
            ->returnResponseObject()
            ->post();
        if($response_auth->status == 200){
            $payload = [
                "intent" => "CAPTURE",
                "purchase_units" => [
                    [
                        "reference_id" => "12312312312312111",
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => ($data->unit_price * $data->quantity )
                        ]
                    ]
                ],
                "payment_source" => [
                    "paypal" => [
                        "experience_context" => [
                            "payment_method_preference" => "UNRESTRICTED",
                            "brand_name" => "EXAMPLE INC",
                            "locale" => "en-US",
                            "landing_page" => "GUEST_CHECKOUT",
                            "shipping_preference" => "SET_PROVIDED_ADDRESS",
                            "user_action" => "PAY_NOW",
                            "return_url" => env('AGENT_URL')."paypal/success",
                            "cancel_url" => env('AGENT_URL')."paypal/failed",
                        ],
                        "email_address" => $data->email,
                        "address" => [
                            "address_line_1" => $data->address,
                            "admin_area_1" => $data->state,
                            "admin_area_2" => $data->city,
                            "postal_code" => $data->zip_code,
                            "country_code" => "US"
                        ],
                        "name" => [
                            "given_name" => $data->firstname,
                            "surname"   => $data->lastname
                        ]
                    ]
                ]
            ];
            Session::put('paypal_token',$response_auth->content->access_token);
            $response = Curl::to(Api::PAYPAL_API . 'v2/checkout/orders')
            ->withContentType('application/json')
            ->withBearer($response_auth->content->access_token)
            ->withData($payload)
            ->asJson()
            ->returnResponseObject()
            ->post();
            return $response;
        }   
        else{
            return $response_auth;
        }
    }
}