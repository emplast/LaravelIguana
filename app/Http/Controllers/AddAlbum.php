<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddNewAlbum;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Album;
use App\Photo;
use App\Visit;
class AddAlbum extends Controller
{
  /*
  wywołanie widoków albumów po zalogowaniu

  */
    public function index()
    {
    	return view('addAlbum');
    }
/*

wywołannie akcjii dodawania albumu
*/

    public function add(AddNewAlbum $request)
    {	

          $request->file('adres')->store('upload');
          $statement = DB::select("show table status like 'albums'");

           $photo=['name'=>$request->input('name'),
              'autor'=>$request->input('autor'),
              'opis'=>$request->input('opis'),
              'adres'=>'storage/'.$request->file('adres')->store('upload').'',
              'id_uzytkownika'=>Auth::user()->id,
              'id_albumu'=>$statement[0]->Auto_increment];
          
          Photo::create($photo);

          $photos= Photo::get()->last();
          $statement = DB::select("show table status like 'photos'");
          $album=['name'=>$request->input('name'),
                  'opis'=>$request->input('opis'),
                  'autor'=>$request->input('autor'),
                  'id_zdjecia'=>($statement[0]->Auto_increment)-1,
                  'id_uzytkownika'=>Auth::user()->id];
           Album::create($album);
          
           $pageName=Album::get()->last();		
          Visit::create(['pageName'=>$pageName->id,'counts'=>1]);

  		  return  redirect('/panel');  

    }
}
