<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
    //

    protected $fillable = ['page_id', 'content'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function words()
    {
        return $this->hasMany(Word::class);
    }
}
