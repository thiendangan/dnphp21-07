<?php

namespace App\Repositories;
use App\Models\Image;

class ImageRepository
{

    protected $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function create(array $image)
    {
        return $this->image->create($image);
    }

    
}