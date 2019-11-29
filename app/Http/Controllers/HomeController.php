<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\UserCommentRequest;
use App\Album;
use App\Photo;
use App\Comment;
use App\Visit;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
       $album=  DB::table('albums as a')
                   ->select('a.*','b.adres')
                   ->leftJoin('photos  as b', 'a.id_zdjecia', '=', 'b.id')
                   ->get();
         return view('home',['data'=>$album]); 
        
        
    }
/*
akcja dodawania komentarza
*/
    public function addComment(UserCommentRequest $request,$id)
    {
        $wlasciciel=Album::find($id);
        $input=['name'=>'Komentarz',
                'autor'=>Auth::user()->name,
                'opis'=>$request->input('opis'),
                'id_uzytkownika'=>Auth::user()->id,
                'id_albumu'=>$id,
                'id_zdjecia'=>0,
                'wlasciciel'=>$wlasciciel->id_uzytkownika];
        Comment::create($input);

        return redirect('/album/'.$id);
    }
    
}
