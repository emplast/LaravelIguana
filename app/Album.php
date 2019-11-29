<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Album extends Model
{
    protected $fillable = [
        'name', 'autor', 'opis','id_uzytkownika','id_zdjecia',
    ];

    

}
