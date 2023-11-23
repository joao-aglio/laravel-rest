<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\ReserveBook;
use App\Models\Reserve;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mybooks = ReserveBook::getMyBooks();

        $mybooksId = collect();

        foreach ($mybooks as $mybook) {
            $mybooksId->push($mybook->id);
        }

        $books = Book::whereNotIn("id", $mybooksId)->get()->sortByDesc('created_at')->values();

        return [
            'status' => 1,
            'data' => $books
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $imagePath = public_path() . '/images/';
        $imageName = time() . '.' . 'png';

        $file = base64_decode($request->input('cover'));

        $success = file_put_contents($imagePath . $imageName, $file);

        if ($success) {

            $data = $request->all();

            $book = new Book([
                "name" => $data["name"],  "author" => $data["author"],
                "publisher_id" => $data["publisher_id"], "publish_date" => $data["publish_date"],
                "category_id" => $data['category_id'], "cover" => $imageName, 'description' => $data['description']
            ]);

            $book->save();

            return [
                'status' => 1,
                'data' => $book
            ];
            
        } else throw new Exception("It wasn't possible to save your image.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {

        return [
            "status" => 1,
            "data" => $book
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {

        $book->update($request->all());

        return [
            "status" => 1,
            "data" => $book
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {

        $book->delete();

        return [
            "status" => 1,
            "data" => $book
        ];
    }
}
