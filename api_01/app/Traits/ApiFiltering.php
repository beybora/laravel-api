<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait ApiFiltering
{
    public function filter(Request $request, Builder $query, $allowedFilterColumns = []): Builder
    {
        $filterArray = $request->query('filter', []);

        foreach ($filterArray as $filterKey => $filterValue) {
            // where email LIKE 'abcdef'
            if (!in_array($filterKey, $allowedFilterColumns)) {
                continue;
            }

            return $query->where($filterKey, 'LIKE', '%' . $filterValue . '%');
        }

        return $query;
    }
}
