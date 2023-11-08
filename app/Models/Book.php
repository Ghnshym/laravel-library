<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'isbn', 'quantity', 'description'];

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'book_id');
    }

    public function lendings()
    {
        return $this->hasMany(Lending::class, 'book_id');
    }

    
}