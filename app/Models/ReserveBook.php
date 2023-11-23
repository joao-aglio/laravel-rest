<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReserveBook extends Model
{
    protected $table = 'reserves_books';

    protected $with = ['book', 'reserve'];

    protected $guarded = ['id'];

    public function book(){
        return $this->hasOne(Book::class, 'id', 'book_id');
    }

    public function reserve(){
        return $this->hasOne(Reserve::class, 'id', 'reserve_id');
    }

    public static function getMyBooks(){
        $mybooks = collect();

        $reserves = Reserve::where('user_id', auth()->user()->id)
        ->get();

        if (!empty($reserves)) {

            foreach ($reserves as $reserve) {
                $book = ReserveBook::with('book')
                    ->where('reserve_id', $reserve->id)
                    ->where('active', 1)
                    ->get()
                    ->pluck('book');

                $mybooks->push($book);
            }
        }

        return $mybooks->flatten(1);
    }
}
