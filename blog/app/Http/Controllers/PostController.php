<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Auth;
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

    public function change($id)
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
            $user = Auth()->user()->email;
            $message->to($user);
        } );

        return Response('Success', 200);




        // return view('index', ['is_approved'=>$is_approved, "posts"=>$info]);
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
            'author'=>$request->input('author')
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
