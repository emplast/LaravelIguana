<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Album;
use App\Photo;
use App\Comment;
class PhotoUser extends Controller
{
	/*
	widok wyświetlania pojedynczego albumu ze zdjęciami

	*/
    public  function index()
    {
    	$album=  DB::table('albums as a')
                   ->select('a.*','b.adres')
                   ->leftJoin('photos  as b', 'a.id_zdjecia', '=', 'b.id')
                   ->get();
    	return view('welcome',['albums'=>$album]);
    }
}
