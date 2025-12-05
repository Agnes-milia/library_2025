<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'author',
        'title'
    ];

    public function toCopies()
    {    
        return $this->hasMany(Copy::class);   
    }

    public function toReservations()
    {    
        return $this->hasMany(Reservation::class, "book_id", "id");   
    }

}
