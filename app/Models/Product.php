<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'Product';

    protected $fillable = ['Sku', 'name', 'description', 'price', 'amount', 'active', 'insert_in'];

    protected $dates = ['deleted_at'];
}
