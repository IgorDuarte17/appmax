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
        $countAllWithActive = $this->productQuery->countAllWithActive();
        $countAllWithLowStock = $this->productQuery->countAllWithLowStock();
        $getLastFiveProducts = $this->productQuery->getLastFiveProducts();

        return view('admin.home.home', compact('countAllWithActive', 'countAllWithLowStock', 'getLastFiveProducts'))->with('title', 'Home');
    }
}
