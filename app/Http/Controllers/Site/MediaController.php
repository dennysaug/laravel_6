<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;


class MediaController extends Controller
{
    public function image($path, $area, $size, $image)
    {
        $path = storage_path("app/public/{$path}/{$area}/{$size}/{$image}");

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);

        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        $response->header("Content-Type", $type);

        return $response;
    }
}
