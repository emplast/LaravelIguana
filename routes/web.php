<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','PhotoUser@index');//widok index z sześcioma najnowszymi albumami bez logowania
   
Auth::routes();//widoki logowania i rejestracji użytkowników

Route::get('/home', 'HomeController@index');//widok home ze wszystkimi albumami po zalogowaniu
Route::post('/home/{id}', 'HomeController@addComment');//akcja pojedynczego albumu w której dodawany jest komentarz metodą POST
Route::get('/panel','Admin@index');//widok panelu
Route::get('/album/{id}','AlbumUser@show');//widok pojedynczego albumu
Route::get('/comment/{id}','CommentAlbum@index');//widok dodawania komentarza
Route::post('/addAlbum','AddAlbum@add');//akcja dodawania albumu metodą POST
Route::get('/addAlbum','AddAlbum@index');//widok dodawania albumu
Route::get('/userAlbum/{id}','AlbumUser@user');//widok pojedynczego z możliwościa dodania zdjęcia
Route::get('/userAlbum/{id}/delete','AlbumUser@deleteAlbum');//widok usuwania albumu 
Route::post('/userAlbum/{id}','AlbumUser@addPhoto');//akcja dodawania zdjęcia metodą POST
Route::get('/userAlbum/{id}/{id_photo}','AlbumUser@editPhoto');//widok edycji zdjęcia dla poszczególnych albumów użytkownika
Route::post('/userAlbum/{id}/{id_photo}','AlbumUser@edit');//akcja edycji zdjęcia metodą POST
Route::get('/deletePhoto/{id}/{id_photo}','AlbumUser@delete');//akcja usuwania zdjęcia z poziomu administratora
Route::post('/panel','Admin@delete');//akcja usuwania albumu metodą POST z poziomu administratora
Route::post('/panel/deletePhoto','Admin@deletePhoto');//akcja usuwania zdjęcia/ć metodą POST z poziomu administratora
Route::post('/panel/deleteComment','Admin@deleteComment');//akcja usuwania komentarza/y metodą POST z poziomu administratora
Route::post('/panel/deleteUsers','Admin@deleteUsers');//akcja usuwania użytkownika/ów metodą POST z poziomu administratora
Route::get('/panel/deleteUser','Admin@deleteUser');//akcja usuwania użytkownika z poziomu jego panelu
Route::post('/album/{id}','AlbumUser@rating');//akcja dodawania ocen do zdjęć

/*
grupa akcjii i widoków podlegająca walidacji
*/

Route::group(['middleware'=>['web']],function (){
	Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/home/{id}', 'HomeController@addComment');
    Route::get('/panel','Admin@index');
    Route::get('/album/{id}','AlbumUser@show')->name('album');
    Route::get('/comment/{id}','CommentAlbum@index')->name('comment_album');
    Route::post('/addAlbum','AddAlbum@add');
    Route::get('/addAlbum','AddAlbum@index');
    Route::get('/userAlbum/{id}','AlbumUser@user');
    Route::get('/userAlbum/{id}/delete','AlbumUser@deleteAlbum');
    Route::post('/userAlbum/{id}','AlbumUser@addPhoto');
    Route::get('/userAlbum/{id}/{id_photo}','AlbumUser@editPhoto');
    Route::post('/userAlbum/{id}/{id_photo}','AlbumUser@edit');
    Route::get('/deletePhoto/{id}/{id_photo}','AlbumUser@delete');

});