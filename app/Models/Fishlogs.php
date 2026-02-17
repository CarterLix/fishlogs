<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fishlogs extends Model
{
    /** @use HasFactory<\Database\Factories\FishlogsFactory> */
    use HasFactory;
    protected $fillable = ['date', 'name', 'location', 'species', 'method', 'rating'];

}
