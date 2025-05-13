<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ApiPagination
{
    public function getPerPage(Request $request, $defaultPerPage = 10, $maxPerPage = 100)
    {
        $perPage = $request->query('per_page', $defaultPerPage);
        return $perPage > 0 ? min($perPage, $maxPerPage) : $defaultPerPage;
    }
}
