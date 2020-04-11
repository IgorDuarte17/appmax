<?php

namespace App\Helpers;
use Carbon\Carbon;

class SkuHelper
{
    /**
     * Funçâo para gerar SKU
     *
     * @return string
     */
    public function generate()
    {
        $faker = \Faker\Factory::create();

        $alpha = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'X', 'Y', 'Z', 'W');
        $prefix = $faker->randomElements($alpha, 3, true);
        $sku = implode($prefix, "") . '-' . $faker->randomNumber(7);

        return $sku;
    }
}
