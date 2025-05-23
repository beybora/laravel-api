<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStore;
use App\Http\Requests\UserUpdate;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiFiltering;
use App\Traits\ApiPagination;
use App\Traits\ApiSorting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller implements HasMiddleware
{
    use ApiSorting;
    use ApiFiltering;
    use ApiPagination;

    public static function middleware(): array
    {
        return [
            'auth:sanctum',
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        $allowedFilterColumns = ['name', 'email'];

        $query = $this->sort($request, $query);
        $query = $this->filter($request, $query, $allowedFilterColumns);

        return new UserCollection(
            $query->paginate($this->getPerPage($request))
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStore $request)
    {
        return new UserResource(User::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdate $request, User $user)
    {
        $user->update(($request->all()));
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return $user->delete();
    }
}
