<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //

    protected $fillable = ['chapter_id', 'page_number'];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function sentences()
    {
        return $this->hasMany(Sentence::class);
    }
}
