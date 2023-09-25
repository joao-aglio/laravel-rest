<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;

use Exception;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {

            $obj = new Book();
            $books = $obj->all();

            return [
                'status' => 1,
                'data' => $books
            ];

        } catch (Exception $e) {

            return [
                "status" => 0,
                "error" => $e->getMessage(),
            ];
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        try {
            $file = $request->file('cover');
            $imageName = time().'.'.$file->extension();
            $imagePath = public_path(). '/images';
            $file->move($imagePath, $imageName);

            $data = $request->all();

            $book = new Book(["name" => $data["name"],  "author" => $data["author"], 
            "publisher_id" => $data["publisher_id"], "publish_date" => $data["publish_date"], 
            "category_id" => $data['category_id'], "cover" => $imageName]);

            $book->save();

            return [
                'status' => 1,
                'data' => $book
            ];

        } catch (Exception $e){

            return [
                "status" => 0,
                "error" => $e->getMessage(),
            ];

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        try {

            return [
                "status" => 1,
                "data" => $book
            ];

        } catch (Exception $e){

            return [
                "status" => 0,
                "error" => $e->getMessage(),
            ];

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
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
        try {
            $book->update($request->all());

            return [
                "status" => 1,
                "data" => $book
            ];

        } catch (Exception $e){

            return [
                "status" => 0,
                "error" => $e->getMessage()
            ];
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        try {

            $book->delete();

            return [
                "status" => 1,
                "data" => $book
            ];

        } catch (Exception $e){

            return [
                "status" => 1,
                "error" => $e->getMessage()
            ];

        }

    }
}
