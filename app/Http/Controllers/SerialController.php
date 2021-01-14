<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\SerialGenre;
use App\ActorInSerial;
use App\Genre;
use App\Serial;
use App\Coment;

class SerialController extends Controller
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
        return view('admin.addserial');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function genre_to_serial(Request $request)
    {
        if(isset($_POST['genre'])) {
            $genres = $_POST['genre'];

            $serial_id = Serial::where('title_geo', $request->input('serial'))->firstOrFail()->id;

            foreach ($genres as $genre) {
                $genre_id = Genre::where('genre', $genre)->firstOrFail()->id;

                SerialGenre::create([
                    "serial_id"=>$serial_id,
                    "genre_id"=>$genre_id
                ]);
            }

            return "
        <div style='text-align: center;'>
        <h1>ჟანრები წარმატებით დაუკავშირდა სერიალს</h1> <a href='/admin/main'>საწყისზე დაბრუნება</a>
        </div>";
        }

        return "
        <div style='text-align: center;'>
        <h1>დაფიქსირდა შეცდომა! თავიდან სცადეთ</h1> <a href='/admin/main'>საწყისზე დაბრუნება</a>
        </div>";
    }

    public function store(Request $request)
    {
        $this->validate( $request, [
            "title_geo" => "required",
            "title_eng" => "required",
            "imdb" => "required",
            "release_date" => "required",
            "serial_img" => "required",
            "directed_by" => "required",
            "duration" => "required",
            "country" => "required",
            "description" => "required"
        ]);

        if(Input::file("serial_img")) {
            $destination = public_path('images');
            $filename = uniqid().".jpg";
            $img = Input::file("serial_img")->move($destination, $filename);
        
        

        Serial::create([
            "title_geo"=>$request->input("title_geo"),
            "title_eng"=>$request->input("title_eng"),
            "imdb"=>$request->input("imdb"),
            "release_date"=>$request->input("release_date"),
            "serial_img"=>$filename,
            "directed_by"=>$request->input("directed_by"),
            "duration"=>$request->input("duration"),
            "country"=>$request->input("country"),
            "description"=>$request->input("description")
        ]);
    
        return "
        <div style='text-align: center;'>
        <h1>სერიალი წარმატებით დაემატა</h1> <a href='/admin/main'>საწყისზე დაბრუნება</a>
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
        $movie = Serial::where("id", $id)->firstOrFail();
        $genres_id = SerialGenre::where("serial_id", $id)->get();

        // foreach ($genres_id as $genre) {
        //     echo Genre::where('id', $genre->genre_id)->firstOrFail()->genre;
        // }
        $actor_movie = ActorInSerial::where("serial_id", $id)->get();
        // echo $actor_movie;
        // foreach ($actor_movie as $actor) {
        //     echo Actor::where("id", $actor->actor_id)->firstOrFail()->name_geo;
        // }

        $comments = Coment::where("serial_id", $id)->get();

        return view('user.singleserial', [
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

    public function deleteserial(Request $request)
    {
        Serial::where('title_geo', $request->input('serial'))->delete();

        Mail::send('mail.serialmail', ["serial"=>$request->input('serial')],
        function($message){
            $message->to('138a2e1b85-d25214@inbox.mailtrap.io',
        'Delete Serial')->subject('Serial Deleted');
        });

        return "
        <div style='text-align: center;'>
        <h1>სერიალი წარმატებით წაიშალა</h1> <a href='/admin/main'>საწყისზე დაბრუნება</a>
        </div>";
    }
}
