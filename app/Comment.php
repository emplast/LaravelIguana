<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'name', 'autor', 'opis','id_uzytkownika','id_albumu','id_zdjecia','wlasciciel'
    ];
}
