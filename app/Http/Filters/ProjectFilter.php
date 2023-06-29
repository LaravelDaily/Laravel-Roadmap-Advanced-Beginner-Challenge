<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProjectFilter extends AbstractFilter
{
    public const TITLE = 'title';

    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
        ];
    }

    public function title(Builder $builder, $value)
    {
        $builder->where('title', 'like', "%{$value}%");
    }

//    public function status(Builder $builder, $value)
//    {
//        $builder->where('status', 'like', "%{$value}%");
//    }
//
//    public function deadline(Builder $builder, $value)
//    {
//        $builder->where('deadline', 'like', "%{$value}%");
//    }
}
