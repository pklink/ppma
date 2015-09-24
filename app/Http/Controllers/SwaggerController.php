<?php


namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class SwaggerController extends BaseController {

    public function latest() {
        $path = realpath(__DIR__ . '/../../../storage/app/swagger/v1.yaml');
        return response()->download($path, null, ['Access-Control-Allow-Origin' => '*']);
    }

}