<?php


// app/Models/User.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class MYUser extends Authenticatable
{
    use Notifiable,HasApiTokens;

     // Specify the table name
     protected $table = 'my_users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image',
        'email',
        'password',
        'age',
        
        'level',
        'golden_letter_wins',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reader()
    {
        return $this->hasOne(Reader::class);
    }

    public function writer()
    {
        return $this->hasOne(Writer::class);
    }

    public function poster()
    {
        return $this->hasOne(Posterr::class);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    public function discounts()
    {
        return $this->hasManyThrough(Discount::class, Achievement::class);
    }

  

    // Users can have many friends
    public function friends()
    {
        return $this->hasMany(Friend::class, 'user_id');
    }

    // Users can receive messages
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    // Users can send messages
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    // Users can be friends with many other users
    public function friendsList()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
            ->withPivot('status')
            ->withTimestamps();
    }

        /**
     * Get the reviews written by this user.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
