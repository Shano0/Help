<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\MovieGenre;
use App\ActorInMovie;
use App\Serial;
use App\Coment;
use App\Actor;
use App\Movie;
use App\Genre;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addmovie');
    }

    public function store_genre(Request $request)
    {
        Genre::create([
            "genre"=>$request->input("genre")
        ]);

        return "
        <div style='text-align: center;'>
        <h1>ჟანრი წარმატებით დაემატა</h1> <a href='/admin/main'>საწყისზე დაბრუნება</a>
        </div>";
    }

    public function genre_to_movie(Request $request)
    {
            $movie_id = Movie::where('title_geo', $request->input('movie'))->firstOrFail()->id;
            $genres = $request->input('genre');

            foreach ($genres as $genre) {
                $genre_id = Genre::where('genre', $genre)->firstOrFail()->id;

            MovieGenre::create([
                    "movie_id"=>$movie_id,
                    "genre_id"=>$genre_id
                ]);
        
        }

            return "
        <div style='text-align: center;'>
        <h1>ჟანრები წარმატებით დაუკავშირდა ფილმს</h1> <a href='/admin/main'>საწყისზე დაბრუნება</a>
        </div>";

        return "
        <div style='text-align: center;'>
        <h1>დაფიქსირდა შეცდომა! თავიდან სცადეთ</h1> <a href='/admin/main'>საწყისზე დაბრუნება</a>
        </div>";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate( $request, [
            "title_geo" => "required",
            "title_eng" => "required",
            "imdb" => "required",
            "release_date" => "required",
            "movie_img" => "required",
            "directed_by" => "required",
            "duration" => "required",
            "country" => "required",
            "description" => "required"
        ]);

        if(Input::file("movie_img")){
            $destination = public_path('images');
            $filename = uniqid().".jpg";
            $img = Input::file("movie_img")->move($destination, $filename);
        
        

        Movie::create([
            "title_geo"=>$request->input("title_geo"),
            "title_eng"=>$request->input("title_eng"),
            "imdb"=>$request->input("imdb"),
            "release_date"=>$request->input("release_date"),
            "movie_img"=>$filename,
            "directed_by"=>$request->input("directed_by"),
            "duration"=>$request->input("duration"),
            "country"=>$request->input("country"),
            "description"=>$request->input("description")
        ]);
    
        return "
        <div style='text-align: center;'>
        <h1>ფილმი წარმატებით დაემატა</h1> <a href='/admin/main'>საწყისზე დაბრუნება</a>
        </div>";
        }

        return "
        <div style='text-align: center;'>
        <h1>დაფიქსირდა შეცდომა! თავიდან სცადეთ</h1> <a href='/admin/main'>საწყისზე დაბრუნება</a>
        </div>";

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::where("id", $id)->firstOrFail();
        $genres_id = MovieGenre::where("movie_id", $id)->get();

        // foreach ($genres_id as $genre) {
        //     echo Genre::where('id', $genre->genre_id)->firstOrFail()->genre;
        // }
        $actor_movie = ActorInMovie::where("movie_id", $id)->get();
        // echo $actor_movie;
        // foreach ($actor_movie as $actor) {
        //     echo Actor::where("id", $actor->actor_id)->firstOrFail()->name_geo;
        // }

        $comments = Coment::where("movie_id", $id)->get();

        return view('user.singlemovie', [
            "movie"=>$movie,
            "genres_id"=>$genres_id,
            "actor_movie"=>$actor_movie,
            "comments"=>$comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request)
    {
        // $input = $request->input('search');
        // $movies_geo = Movie::where('title_geo', $input)->get();
        // $movies_eng = Movie::where('title_eng', $input)->get();
        // $serial_geo = Serial::where('title_geo', $input)->get();
        // $serial_eng = Serial::where('title_eng', $input)->get();
        // return view('user.search',[
        //     "movies_geo"=>$movies_geo,
        //     "movies_eng"=>$movies_eng,
        //     "serial_geo"=>$serial_geo,
        //     "serial_eng"=>$serial_eng
        // ]);
        return "Search will be added soon";
    }

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function deletemovie(Request $request)
    {
        Movie::where('title_geo', $request->input('movie'))->delete();

        Mail::send('mail.mail', ["movie"=>$request->input('movie')],
        function($message){
            $message->to('138a2e1b85-d25214@inbox.mailtrap.io',
        'Delete Movie')->subject('Movie deleted');
        });


        return "
        <div style='text-align: center;'>
        <h1>ფილმი წარმატებით წაიშალა</h1> <a href='/admin/main'>საწყისზე დაბრუნება</a>
        </div>";
    }

}
