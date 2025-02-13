<?php

namespace App\Traits;

trait Search
{
    public function scopeSearchStatus($query, $status)
    {
        if (in_array($status, self::STATUS)) {
            return $query->where('status', $status);
        }

        return $query;
    }
}
