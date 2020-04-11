<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'Products';

    protected $fillable = ['sku', 'name', 'description', 'price', 'amount', 'active', 'insert_in'];

    protected $dates = ['deleted_at'];

    // Relation with Image
    public function image()
    {
        return $this->hasOne('App\Models\Product\Imagem', 'product_id');
    }
}
