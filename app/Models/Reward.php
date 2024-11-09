<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reward extends Model
{
    use HasFactory;

       /**
        * fillable
        *
        * @var array
        */
       protected $fillable = [
           'name',
           'point',
           'haidah',
           'invidu',
           'amir'
       ];
}
