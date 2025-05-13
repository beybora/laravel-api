<?php

namespace App\Traits;

use App\Exceptions\ApiFilteringInvalidAttributeException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait ApiFiltering
{
    public function filter(Request $request, Builder $query, $allowedFilterColumns = []): Builder
    {
        $filterArray = $request->query('filter', []);

        foreach ($filterArray as $filterKey => $filterValue) {
            if (!in_array($filterKey, $allowedFilterColumns)) {
                $exception = new ApiFilteringInvalidAttributeException("This column " . $filterKey . " is not alloweder to be filtered!", 1);
                $exception->setColumnName($filterKey);
                throw $exception;
            }

            return $query->where($filterKey, 'LIKE', '%' . $filterValue . '%');
        }

        return $query;
    }
}
