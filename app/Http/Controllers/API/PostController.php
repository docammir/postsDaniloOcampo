<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $post = new Post();
            $post->titulo = $request->titulo;
            $post->contenido = $request->contenido;
            $post->categoria_id = $request->categoria_id;
            
            $post->save();
            return response()->json($post, 201);

        } catch (Exception $e) {

            return response()->json([$e->getMessage()], 400);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return Post::findOrFail($post->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        try {
            $post = Post::findOrFail($post->id);
            $post->update($request->all());

            return response()->json($post, 200);
        } catch (\Exception $e) {
            return response()->json(["no updated"], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post = Post::findOrFail($post->id);
        $post->delete();

        return response()->json(["deleted"], 204);
    }
}
