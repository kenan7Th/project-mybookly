<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['body','user_id','image'];

    public function user()
    {
        return $this->belongsTo(MYUser::class);

    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
        
    }
    
    public function likes()
    {
        return $this->hasMany(Like::class);
        
    }

}
