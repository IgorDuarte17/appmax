<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagesController extends Controller
{
    public function image(Request $request)
    {
        $link = $request->get('link');

        $image = \Storage::exists($link) ? \Storage::get($link) : false;

        if(!$image) {
          return null;
        }

        return response($image, 200)->header('Content-Type', 'image/png');
    }
}
