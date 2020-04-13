<?php

namespace App\Queries;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

final class ProductQuery
{
    /**
     * Busca todos produtos ativos
     */
    public function gettAllWithActive()
    {
        return Product::query()
        ->where('active', 1)
        ->get();
    }

    /**
     * Busca os últimos cinco produtos cadastrados
     */
    public function getLastFiveProducts()
    {
        return Product::query()
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
    }

    /**
     * Busca todos produtos com quantidade abaixo de 100
     */
    public function getAllWithLowStock()
    {
        return Product::query()
        ->where('active', 1)
        ->where('amount', '<', 100)
        ->get();
    }

    /**
     * Busca produtos cadastrados por data
     */
    public function getRegisteredByDateAndDay($column, $dateStart, $dateEnd)
    {
        return Product::query()
        ->whereBetween($column, [$dateStart, $dateEnd])
        ->orderBy($column, 'desc')
        ->withTrashed()
        ->get();
    }

    /**
     * Busca produtos por tipo de entrada
     */
    public function getRegisterByInsertInAndDate($entry, $dateStart, $dateEnd)
    {
        return Product::query()
        ->where('insert_in', $entry)
        ->whereBetween('created_at', [$dateStart, $dateEnd])
        ->withTrashed()
        ->get();
    }
}
