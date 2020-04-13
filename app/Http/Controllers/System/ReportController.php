<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Queries\ProductQuery;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    protected $productQuery;

    public function __construct(ProductQuery $productQuery)
    {
        $this->productQuery = $productQuery;
    }

    public function byDay()
    {
        $now = Carbon::now();
        $dateNow = date('d/m/Y', strtotime($now->toDateString()));
        $dateStart = $now->toDateString()." 00:00:00";
        $dateEnd = $now->toDateString()." 23:59:59";

        $getRegisterByCreatedAt = $this->productQuery->getRegisteredByDateAndDay('created_at', $dateStart, $dateEnd);
        $getRegisterByDeleteAt = $this->productQuery->getRegisteredByDateAndDay('deleted_at', $dateStart, $dateEnd);
        $countRegisterByInsertInSystem = $this->productQuery->getRegisterByInsertInAndDate(1, $dateStart, $dateEnd);
        $countRegisterByInsertInApi = $this->productQuery->getRegisterByInsertInAndDate(2, $dateStart, $dateEnd);

        return view('admin.reports.by-day', compact('dateNow', 'getRegisterByCreatedAt', 'getRegisterByDeleteAt', 'countRegisterByInsertInSystem', 'countRegisterByInsertInApi' ))->with('title', 'Relatório Diário');
    }

    public function stock()
    {
        $getAllWithLowStock = $this->productQuery->getAllWithLowStock();

        return view('admin.reports.stock', compact('getAllWithLowStock'))->with('title', 'Relatório de Estoque');
    }
}
