<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status)
    {

        if ($status == 'all') {
            return Post::orderBy('id', 'desc')->with(array('user' => function ($query) {
                $query->select('id', 'username', 'job', 'email', 'profile_img');
            }))->get();
        } else if ($status == 'job') {
            return Post::where('status', 'job')->orderBy('id', 'desc')->with(array("user" => function ($query) {
                $query->select('id', 'username', 'profile_img');
            }))->get();
        } else if ($status == 'tweet') {
            return Post::where('status', 'tweet')->orderBy('id', 'desc')->with(array("user" => function ($query) {
                $query->select('id', 'username', 'profile_img');
            }))->get();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //


        $post = new Post;

        $path = public_path() . "/post";

        $picture = $request->file('picture');

        $pict = $picture;

        if ($request->picture) {
            $picture->move($path, $picture->getClientOriginalName());
            $pict = $picture->getClientOriginalName();
        }

        $post->user_id = $request->user_id;
        $post->desc = $request->desc;
        $post->picture = $pict;
        $post->status = $request->status;

        $post->save();

        return response()->json([
            'status' => 'post uploaded',
        ]);

        // return $request->picture;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Post::findOrFail($id)->delete();
        return response()->json([
            'status' => 'Post deleted'
        ]);
    }
}
