<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddNewPhoto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Album;
use App\Photo;
use App\Comment;
use App\Visit;
use App\Rating;
class AlbumUser extends Controller
{
  /*
    wywołanie widoku  albumów

  */
   public  function index()
   {
   	 $data=Album::get();
   	return view('album',['data'=>$data]);
   }

   /*
    widok pojedynczego albumu z mozliwością:
     dodawania komentarzy ,
     dodania oceny zdjęcia
    
   */
   public function show($id)
   {
   	$result= Album::find($id);
    $data=Photo::get()->where('id_albumu',$id);
    $data_1=Photo::get()->where('id',$result->id_zdjecia)->first();
   	$comments=Comment::get()->where('id_albumu',$id);
    if(Visit::get()->where('pageName',$id)->first()==null)
    {
      Visit::create(['pageName'=>$id,'counts'=>0]);
      $counts=0;
    }else
    {
       $counts=Visit::get()->where('pageName',$id)->first();
       Visit::where('pageName',$id)->update(['counts'=>$counts->counts+1]);
       $counts=$counts->counts;
    }
    
   	return  view('album',['album'=>$result ,
                 'zdjecia'=>$data,
                 'front'=>$data_1,
                 'komantarze'=>$comments,
                 'id'=>$id ,
                 'visits'=>$counts,
                 'comments'=>count($comments)]);
   }
   /*

    widok dodawania zdjęcia do albumu
   */
   public function user($id)
   {
      $result= Album::find($id);
      $data=Photo::get()->where('id_albumu',$id);
      $data_1=Photo::get()->where('id',$result->id_zdjecia)->first();

      return view('userAlbum',['album'=>$result,'photos'=>$data,'front'=>$data_1]);
   }
   public function addPhoto(AddNewPhoto $request,$id)
   {
      $request->file('adres')->store('upload');
      $photo=['name'=>$request->input('name'),
              'autor'=>$request->input('autor'),
              'opis'=>$request->input('opis'),
              'adres'=>'storage/'.$request->file('adres')->store('upload').'',
              'id_uzytkownika'=>Auth::user()->id,
              'id_albumu'=>$id];
      Photo::create($photo);
      $album=Album::find($id);
      $photos=Photo::get()->where('id_albumu',$id);
      return redirect('/userAlbum/'.$id.'')->with('album',$album)->with('photos',$photos);

   }
   /*
    widok edycjii zdjęcia w albumie
   */
   public function editPhoto($id,$id_photo)
   {
      $photo=Photo::get()->where('id',$id_photo)->first();
      return view('editPhoto',['photo'=>$photo,'id'=>$id,'id_photo'=>$id_photo]);
   }
   /*
    akcja edycjii zdjęcia
   */
   public function edit(Request $request,$id,$id_photo)
   {
      
      Photo::where('id',$id_photo)->update(['name'=>$request->input('name'),
                  'opis'=>$request->input('opis'),
                  'autor'=>$request->input('autor')]);
      return redirect('userAlbum/'.$id);
   }
   /*
    akcja usunięcia zdjęcia
   */
   public function delete($id,$id_photo)
   {
       Photo::where('id','=', $id_photo)->delete();
      return  redirect('userAlbum/'.$id);
   }
   /*

    akcja usunięcia albumu
   */
   public function deleteAlbum($id)
   {
      $wlasciciel=Album::find($id);
      Album::where('id',$id)->delete();
      Photo::where('id_albumu',$id)->delete();
      Comment::where('wlasciciel',$wlasciciel->id_uzytkownika)->delete();
      Rating::where('wlasciciel',$wlasciciel->id_uzytkownika)->delete();
      return redirect('/panel');
   }
   /*

  akcja dodania oceny do zdjęcia
   */
   public function rating(Request $request ,$id)
   {
    $statement = DB::select("show table status like 'photos'");
    $count=($statement[0]->Auto_increment);
    $result= Album::find($id);
    $data=Photo::get()->where('id_albumu',$id);
    $data_1=Photo::get()->where('id',$result->id_zdjecia)->first();
     $wlasciciel=$result->id_uzytkownika;
    for($i=0;$i<$count;$i++)
    {
      if($request->input('ocena_'.$i))
      {
        $dane=['id_uzytkownika'=>$request->input('id_uzytkownika'),
                          'id_albumu'=>$request->input('id_albumu'),
                          'id_zdjecia'=>$request->input('id_zdjecia_'.$i),
                          'ocena'=>$request->input('ocena_'.$i),
                          'wlasciciel'=>$result->id_uzytkownika];
          
         
          Rating::create($dane);
      }
    }
      

     return redirect('/album/'.$id)->with('album',$result)->with('photos',$data)->with('front',$data_1);
   }
}
