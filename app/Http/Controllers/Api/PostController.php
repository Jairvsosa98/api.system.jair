<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except(['index','show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::included()
                     ->filter()
                     ->sort()
                     ->getOrPaginate();
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return auth()->user();
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts',
            'extract' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $user = auth()->user(); 
        $data['user_id'] = $user->id;
    

        $post = Post::create($data);

        return PostResource::make($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $post = Post::included()->findOrFail($id);
        return PostResource::make($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug,' . $post->id,
            'extract' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id'
        ]);
        $post->update($request->all());

        return PostResource::make($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        $post->delete();
        return PostResource::make($post);
    }
}
