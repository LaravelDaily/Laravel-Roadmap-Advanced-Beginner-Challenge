<?php

namespace App\Services\SpatieMediaLibrary;

class AddMediaToModel
{

    public function __invoke(array $mediaInput, $model)
    {
        foreach ($mediaInput as $media) {
            $model->addMedia(storage_path('tmp/uploads/').$media)->toMediaCollection();
        }
    }
}
