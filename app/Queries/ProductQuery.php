<?php

namespace App\Queries;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

final class ProductQuery
{
    public function countAllWithActive()
    {
        return Product::query()
        ->where('active', 1)
        ->count();
    }

    public function countAllWithLowStock()
    {
        return Product::query()
        ->where('active', 1)
        ->where('amount', '<', 100)
        ->count();
    }

    public function getLastFiveProducts()
    {
        return Product::query()
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
    }
}
