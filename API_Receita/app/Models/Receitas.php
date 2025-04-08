<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receitas extends Model
{
    protected $fillable = ['titulo', 'tempo_preparo', 'dificuldade'];

}
