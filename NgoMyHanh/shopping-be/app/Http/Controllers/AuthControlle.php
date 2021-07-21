<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthControlle extends Controller
{
    function delete(Request $request){
        $payload = $request->all();
        $product = Product::find($payload['id']);
        if ($product)
        {
            $product->delete();
            return "deleted";
        }else{
            return "false";
        }
    
    }
}
