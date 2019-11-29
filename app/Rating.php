<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
   protected $fillable = [
        'id_uzytkownika', 'id_albumu', 'id_zdjecia','ocena','wlasciciel'
    ];
}
