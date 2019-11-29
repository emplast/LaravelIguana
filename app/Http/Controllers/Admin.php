<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Album;
use App\Photo;
use App\Comment;
use App\User;
Use App\Rating;
class Admin extends Controller
{
    /*
    Pobieranie danych do widoku panelu
    Jezeli zmienna rola w tabeli Users jest równa "0" uruchamai się widok panelu administratora
    Natomiast jeżeli jest inna od "0" uruchamia się panel użytkownika

    */
    public function index()
    {
    	$id=Auth::user()->id;
        $rola=Auth::user()->rola;

    	if($rola==0)
    	{  
           $album=DB::table('albums as a')
                 ->select('a.*','b.name as nazwisko','c.adres')
                 ->leftJoin('users as b','a.id_uzytkownika','=','b.id')
                 ->leftJoin('photos as c','a.id_zdjecia','=','c.id')->get();
           $photos=DB::table('photos as a')
                 ->select('a.*','b.name as nazwisko','c.id_zdjecia as id_zdjecia_c')
                 ->leftJoin('users as b','a.id_uzytkownika','=','b.id')
                 ->leftJoin('albums as c','c.id','=','a.id_albumu')
                 ->get();
           $comments=DB::table('comments as a')
                 ->select('a.*','b.id_zdjecia','c.adres','d.name as nazwisko')
                 ->leftJoin('albums as b','a.id_albumu','=','b.id')
                 ->leftJoin('photos as c','a.id_albumu','=','c.id_albumu')
                 ->leftJoin('users as d','a.id_uzytkownika','=','d.id')
                 ->get();
            $users=User::get()->where('rola','!=','0');

        return view('admin',['albums'=>$album,
                             'photos'=>$photos,
                             'comments'=>$comments,
                             'users'=>$users]);
    	}
        
        $album= DB::table('albums as a')
                   ->select('a.*','b.adres')
                   ->leftJoin('photos  as b', 'a.id_zdjecia', '=', 'b.id')
                   ->where(['a.id_uzytkownika' => $id])->get();
        
            
            return view('user',['albums'=>$album]);
    }
    /*
    Usuwanie albumów/u użytkownika z poziomu panelu administratora
    */
    public function delete(Request $request)
    {
        $statement = DB::select("show table status like 'albums'");
        for($i=0;$i<$statement[0]->Auto_increment;$i++)
        {
            if($request->input('checkbox_'.$i.''))
            {
                Album::where('id',$i)->delete();
                Photo::where('id_albumu',$i)->delete();
                Comment::where('id_albumu',$i)->delete();
            }
        }
        return redirect('/panel');

    }
    /*

    Usuwanie zdjęć urzytkownika z poziomu administratora
    */
    public function deletePhoto(Request $request)
    {
        $statement = DB::select("show table status like 'photos'");
        for($i=0;$i<$statement[0]->Auto_increment;$i++)
        {
            if($request->input('checkbox_a_'.$i.''))
            {
                
                Photo::where('id',$i)->delete();
            }
        }
        return redirect('/panel');
    }
    /*
    Usuwanie komantarzy urzytkownika z poziomu administratora
    */
    public function deleteComment(Request $request)
    {
        $statement = DB::select("show table status like 'comments'");
        for($i=0;$i<$statement[0]->Auto_increment;$i++)
        {
            if($request->input('checkbox_b_'.$i.''))
            {
                
                Comment::where('id',$i)->delete();
            }
        }
        return redirect('/panel');
    }
    /*
    Usuwanie konta użytkownika z poziomu administratora

    */
    public function deleteUsers(Request $request)
    {

        $statement = DB::select("show table status like 'users'");
        for($i=0;$i<$statement[0]->Auto_increment;$i++)
        {
            if($request->input('checkbox_c_'.$i.''))
            {
                
                User::where('id',$i)->delete();
                Album::where('id_uzytkownika',$i)->delete();
                Photo::where('id_uzytkownika',$i)->delete();
                Comment::where('id_uzytkownika' ,$i)->delete();
                Comment::where('wlasciciel',$i)->delete();
                Rating::where('id_uzytkownika',$i)->delete();
                Rating::where('wlasciciel',$i)->delete();

                

            }
        }

        return redirect('/panel');
    }
/*
Usuwanie konta użytkownika z poziomu jgo panelu w raz z 
wszystkimi jego komantarzami i ocenami oraza albumami i zdjęciami

*/


    public function deleteUser()
    {           $i=Auth::user()->id;
                User::where('id',$i)->delete();
                Album::where('id_uzytkownika',$i)->delete();
                Photo::where('id_uzytkownika',$i)->delete();
                Comment::where('id_uzytkownika' ,$i)->delete();
                Comment::where('wlasciciel',$i)->delete();
                Rating::where('id_uzytkownika',$i)->delete();
                Rating::where('wlasciciel',$i)->delete();

                return redirect('/');
    }
}
