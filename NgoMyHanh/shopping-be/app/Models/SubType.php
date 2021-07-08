<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubType extends Model
{
    use HasFactory;

    public $table = "sub_type";
    protected $fillable = [
        'name',
        'type_id',
    ];

    public function product()
        {
            return $this->hasOne(Product::class);
        }
}
