<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Album;
use App\Photo;
use App\Comment;
class CommentAlbum extends Controller
{
/*
widok dodawania komentarza
*/
public function index($id)
{
	$result= Album::find($id);
	$data=Photo::get()->where('id_albumu',$id);
    $data_1=Photo::get()->where('id',$result->id_zdjecia)->first();
    $commets=Comment::get()->where('id_albumu',$id);
	return view('commentAlbum',['album'=>$result,'photo'=>$data_1,'komentarze'=>$commets]);
}
}