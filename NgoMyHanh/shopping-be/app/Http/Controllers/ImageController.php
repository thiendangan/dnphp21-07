<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\ImagePostRequest;
use App\Services\ImageService;


class ImageController extends Controller
{
    private $image_service;

    public function __construct(
        ImageService $ImageService

    ){
        $this->image_service = $ImageService;
    }
    function upload(ImagePostRequest $request){
        return $this->image_service->upload($request);   
    }
}
