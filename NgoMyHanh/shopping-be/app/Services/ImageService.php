<?php

namespace App\Services;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Repositories\ImageRepository;
use App\Http\Requests\ImagePostRequest;
class ImageService
{
    public function __construct( ImageRepository $image_repository)
    {
        $this->image_repository = $image_repository;
    }

    
    public function upload(ImagePostRequest $request)
    {
        $app_url    ="http://localhost:8000/";
        $request->validated();
        if ($request->hasFile('file')) {
            $file           = $request->file;
            $date           = Carbon::now();
            $milliseconds   = (int)round(microtime(true) * 1000);
            $image_name     = $date->toDateString().$milliseconds.$file->getClientOriginalName();

            $storedPath     = $file->move('images', $image_name);

            $image          = [];
            $image['name']  = $image_name;
            $image['type']  = $file->getClientOriginalExtension();
            $image['path']  = $app_url."images/".$image_name;

            $image          = $this->image_repository->create($image);
            return response()->jsonOk($image, 200);
        }

        return false;
    }
    
}