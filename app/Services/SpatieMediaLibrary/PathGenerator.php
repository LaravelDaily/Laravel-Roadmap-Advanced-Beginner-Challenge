<?php


namespace App\Services\SpatieMediaLibrary;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator as PathGeneratorInterface;

class PathGenerator implements PathGeneratorInterface
{

    public function getPath(Media $media): string
    {
        return class_basename($media->model_type).'/'.$media->model_id.'/'.$this->getBasePath($media).'/';
    }

    public function getPathForConversions(Media $media): string
    {
        return class_basename($media->model_type).'/'.$media->model_id.'/'.$this->getBasePath($media).'/conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return class_basename($media->model_type).'/'.$media->model_id.'/'.$this->getBasePath($media).'/responsive-images/';
    }

    protected function getBasePath(Media $media): string
    {
        return $media->getKey();
    }
}
