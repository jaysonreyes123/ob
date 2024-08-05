<?php

namespace App\Http\Controllers;

use App\Models\ObProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function show(string $id){
        $product = ObProduct::find($id);
        return view('content.checkout',compact('product','id'));
    }
}
