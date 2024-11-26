<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    //

    public function achievement()
    {
        return $this->belongsTo(Achievement::class);
    }
}
