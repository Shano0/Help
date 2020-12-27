<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = Post::get();
        return view('index', ["posts"=>$info]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    public function approve($id)
    {
        $is_approved = Post::where('id', $id)->firstOrFail()->is_approved;
        $message='';
        if ($is_approved == 1) {
            $message=' Disaproved';
            Post::where('id', $id)->update([
            'is_approved'=>0
        ]);

        } else {
            $message=' Approved';
            Post::where('id', $id)->update([
            'is_approved'=>1
        ]);

        }

        
        $post = Post::where('id', $id)->firstOrFail()->title;

        Mail::raw('Post '.$post.$message, function($message) {
        $admin = DB::table('users')->where('id', 1)->value('email');
            $message->to($admin);
        });

        return Response('Success', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Post::create([
            'title'=>$request->input('title'),
            'text'=>$request->input('text'),
            'likes'=>$request->input('likes'),
            'author'=>$request->input('author'),
            'is_approved'=>0
        ]);

        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $single_post = Post::where('id', $id)->firstOrFail();
        return view('single', ["info"=>$single_post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $single_post = Post::where('id', $id)->firstOrFail();
        return view('edit', ["info"=>$single_post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Post::where('id', $id)->update([
            'title'=>$request->input('title'),
            'text'=>$request->input('text'),
            'likes'=>$request->input('likes'),
        ]);

        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::where('id', $id)->delete();

        return redirect()->back();
    }
}
