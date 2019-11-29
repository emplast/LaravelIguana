<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'name', 'autor', 'opis','adres','id_uzytkownika','id_albumu',
    ];
}
