<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait ApiSorting
{
    public function sort(Request $request, Builder $query)
    {
        if ($request->query('sort') !== null) {
            $orderSettings = $request->input('sort');
            if (str_starts_with($orderSettings, '-')) {
                return  $query = $query->orderBy(substr($orderSettings, 1), 'desc');
            } else {
                return $query = $query->orderBy(substr($orderSettings, 1), 'asc');
            }
        }
        return $query;
    }
}
