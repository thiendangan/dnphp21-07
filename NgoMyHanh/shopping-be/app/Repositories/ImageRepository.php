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
    public function delete($image){
        return $image->delete();
    }
    public function findById($id)
    {
        return $this->image->find($id);
    }

    
}