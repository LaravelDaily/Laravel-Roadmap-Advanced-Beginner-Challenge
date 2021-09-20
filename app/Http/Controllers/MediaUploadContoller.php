<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaUploadContoller extends Controller
{

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0770, true);
        }

        $file = $request->file('file');

        $name = uniqid().'_'.trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}
