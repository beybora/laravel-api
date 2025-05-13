<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStore;
use App\Http\Requests\PostUpdate;
use App\Http\Resources\PostCollection;
use App\Models\Post;
use App\Traits\ApiSorting;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiSorting;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::query();
        $query = $this->sort($request, $query);

        return new PostCollection(
            $query->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStore $request)
    {
        return Post::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdate $request, Post $post)
    {
        $post->update($request->all());
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        return $post->delete();
    }
}
