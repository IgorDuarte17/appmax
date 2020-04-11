<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Imagem extends Model
{
    protected $table = 'product_images';

    protected $fillable = ['product_id', 'name', 'link'];
}
