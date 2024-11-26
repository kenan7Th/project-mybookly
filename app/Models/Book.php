<?php
// app/Models/Book.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // protected $fillable = [
    //     'title', // Example field, adjust as needed
    //     'author', // Example field, adjust as needed
    // ];
      //your are allowed to fill all the fields with and exception for the id 
      

      protected $guarded = ['id'];

    /**
     * Get the reviews for this book.
     */
  
    // Define the relationship with User (Writer, Reader, Poster - One User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with Chapter (One-to-Many)
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    // Define the relationship with Review (One-to-Many)
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Define the relationship with Proverb (One-to-Many)
    public function proverbs()
    {
        return $this->hasMany(Proverb::class);
    }

    // Define the relationship with Quote (One-to-Many)
    public function quotes()
    {
        return $this->hasMany(Proverb::class);
    }

    // Define the relationship with Library (Many-to-Many)
    public function libraries()
    {
        return $this->belongsToMany(Library::class);
    }

    // Define the relationship with Category (Many-to-Many)
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // Define the relationship with Achievement (One-to-Many)
    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    // Define the relationship with Note (One-to-Many)
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    // Define the relationship with Discount (One-to-Many)
    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

 
    // Other relationships...
}
