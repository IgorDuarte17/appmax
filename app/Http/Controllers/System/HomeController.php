<?php

namespace App\Http\Controllers\System;

use App\Queries\ProductQuery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $productQuery;

    public function __construct(ProductQuery $productQuery)
    {
        $this->productQuery = $productQuery;
    }

    public function index()
    {
        $gettAllWithActive = $this->productQuery->gettAllWithActive();
        $getAllWithLowStock = $this->productQuery->getAllWithLowStock();
        $getLastFiveProducts = $this->productQuery->getLastFiveProducts();

        return view('admin.home.dashboard', compact('gettAllWithActive', 'getAllWithLowStock', 'getLastFiveProducts'))->with('title', 'Home');
    }
}
