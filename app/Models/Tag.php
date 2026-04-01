<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

     protected $fillable = [
        'name',
    ];

    // One tag ↔ many fishlogs
    public function fishlogs()
    {
        return $this->belongsToMany(Fishlogs::class, 'log_tag', 'tag_id', 'fishlog_id');
    }
}
