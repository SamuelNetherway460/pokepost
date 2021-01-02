<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Retrieves a general application image from storage.
     *
     * @param   string $filename
     * @return  \Illuminate\Http\Response
     */
    public function getAssetImage($filename)
    {
        $exists = Storage::disk('public')->exists('/assets/'.$filename);

        if($exists) {
            //get content of image
            $content = Storage::get('public/assets/'.$filename);

            //get mime type of image
            $mime = Storage::mimeType('public/assets/'.$filename);
            //prepare response with image content and response code
            $response = Response::make($content, 200);
            //set header
            $response->header("Content-Type", $mime);
            // return response
            return $response;
         } else {
            abort(404);
         }
    }
}
