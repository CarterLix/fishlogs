<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /** @use HasFactory<\Database\Factories\PhotoFactory> */
    use HasFactory;

    protected $fillable = [
        'fishlog_id',
        'filePath',
    ];

    // Each photo belongs to ONE fishlog
    public function fishlog()
    {
        return $this->belongsTo(Fishlogs::class, 'fishlog_id');
    }
}
