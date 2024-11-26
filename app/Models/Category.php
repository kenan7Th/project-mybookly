<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    // app/Models/Category.php

public function books()
{
    return $this->belongsToMany(Book::class, 'book_category');
}

}
