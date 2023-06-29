<?php

namespace App\Actions\Media;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StoreMediaAction
{
    public function storeMedia(Model $model, Request $request)
    {
        if($request->hasFile('file') && $request->file('file')->isValid()){
            $model->addMediaFromRequest('file')->toMediaCollection('images');
        }
    }
}
