<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flux_rss extends Model
{
    use HasFactory;
    protected $fillable = [

        'titre', 
        'description'
      ];
}
