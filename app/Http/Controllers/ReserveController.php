<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReserveRequest;
use App\Http\Requests\UpdateReserveRequest;
use App\Models\Reserve;
use App\Models\ReserveBook;
use Exception;

class ReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return [
            'status' => true,
            'mybooks' => ReserveBook::getMyBooks()
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReserveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReserveRequest $request)
    {
        try {
            $new_reserve = [];
            $reserve = new Reserve(["user_id" => auth()->user()->id]);
            $reserve->save();

            foreach ($request->__get("books") as $book){
                $reserve_book = new ReserveBook(['reserve_id' => $reserve->id, 'book_id' => $book, 'reserve_until' => $request->input("reserve_until")]);
                $reserve_book->save();
                array_push($new_reserve, $reserve_book);
            };

            return [
                'status' => 1,
                'data' => $reserve
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
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function show(Reserve $reserve)
    {
        try {

            return [
                'status' => 1,
                'data' => $reserve
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
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserve $reserve)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReserveRequest  $request
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReserveRequest $request, Reserve $reserve)
    {
        try {
            $reserve->update($request->all());

            return [
                "status" => 1,
                "data" => $reserve
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
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserve $reserve)
    {
        try {

            $reserve->delete();

            return [
                "status" => 1,
                "data" => $reserve
            ];

        } catch (Exception $e){

            return [
                "status" => 1,
                "error" => $e->getMessage()
            ];

        }
    }
}
