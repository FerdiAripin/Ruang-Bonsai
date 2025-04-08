<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Mockery\Generator\StringManipulation\Pass\RemoveUnserializeForInternalSerializableClassesPass;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'categories_id',
        'name',
        'image',
        'description',
        'price',
        'discount',
        'stock'

    ];

    public function categories()
    {

        return $this->belongsTo(Categories::class);

    }
}
