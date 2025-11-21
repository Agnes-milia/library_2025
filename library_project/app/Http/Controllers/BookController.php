<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function booksWithCopies(){
        return Book::with("toCopies")->get();
    }

    public function specialAuthors($speciality){
        return Book::where('author','LIKE', $speciality."%")->get();
    }

    //egy könyvhöz hány foglalás tartozik?
    public function bookReservedCount($id){
        $pieces = DB::table("reservations as r")
        ->where("r.book_id", $id)
        ->count();

        return $pieces;
    }
}
