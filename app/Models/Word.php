<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    //
    protected $fillable = ['sentence_id', 'word'];

    public function sentence()
    {
        return $this->belongsTo(Sentence::class);
    }
}
