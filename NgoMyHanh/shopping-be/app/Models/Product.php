<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Product extends Model
{
    use HasFactory;
    public $table = "product";
    protected $fillable = [
        'code',
        'name',
        'price',
        'type_id',
        'sub_type_id',
        'note',
        'image_id',
        'sub_image_ids'
    ];

    public function Type()
    {
        return $this->belongsTo(Type::class);
    }
    public function SubType()
    {
        return $this->belongsTo(SubType::class);
    }
    public function Image()
    {
        return $this->belongsTo(Image::class);
    }
    
    public static function boot()
    {
        parent::boot();
        self::creating(function($product) {
            // $prefix = generateRandomString(2); 
            // $code = IdGenerator::generate(['table' => 'product', 'length' => 6, 'prefix' => $prefix]);
            // dd($code);
            // $product->code = $code;
            // return $product;

            $string=generateRandomString(2);
            $number=generateRandomNumber(4);
            $product->code = $string.$number;
            return $product;
        });

    }
}
function generateRandomString($length = 10) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generateRandomNumber($length = 10) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomNumber = '';
    for ($i = 0; $i < $length; $i++) {
        $randomNumber .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomNumber;
}


