<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fishlogs extends Model
{
    /** @use HasFactory<\Database\Factories\FishlogsFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'date', 'name', 'location', 'species', 'method', 'rating'];

        public function user()
    {
        return $this->belongsTo(User::class);
    }

    // One fishlog → many photos
    public function photos()
    {
        return $this->hasMany(Photo::class, 'fishlog_id');
    }

    // One fishlog ↔ many tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'log_tag', 'fishlog_id', 'tag_id');
    }

}
