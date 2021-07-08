<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Image;
use Illuminate\Http\Request;


class ImageController extends Controller
{
    function upload(Request $request){
        $app_url="http://localhost:8000/";
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        
        if ($request->hasFile('file')) {
            $file = $request->file;
           

            $date = Carbon::now();
            $milliseconds = (int)round(microtime(true) * 1000);
            $image_name=$date->toDateString().$milliseconds.$file->getClientOriginalName();

            $storedPath = $file->move('images', $image_name);

            $image =[];
            $image['name']=$image_name;
            $image['type']=$file->getClientOriginalExtension();
            $image['path']=$app_url."images/".$image_name;

            $image = Image::create($image);
            return response()->json([
                'status' => true,
                'data'   => $image
            ]);
        }

        return false;
        
    }
}
