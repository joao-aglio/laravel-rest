<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReserveBookRequest;
use App\Http\Requests\UpdateReserveBookRequest;
use App\Models\ReserveBook;

use Exception;

class ReserveBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $obj = new ReserveBook();
            $reservesBooks = $obj->all();

            return [
                'status' => 1,
                'data' => $reservesBooks
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
     * @param  \App\Http\Requests\StoreReserveBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReserveBookRequest $request)
    {
        try {
            
            $obj = new ReserveBook();
            $reserveBook = $obj->create($request->all());

            return [
                'status' => 1,
                'data' => $reserveBook
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
     * @param  \App\Models\ReserveBook  $reserveBook
     * @return \Illuminate\Http\Response
     */
    public function show(ReserveBook $reserveBook)
    {
        try {

            return [
                'status' => 1,
                'data' => $reserveBook
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
     * @param  \App\Models\ReserveBook  $reserveBook
     * @return \Illuminate\Http\Response
     */
    public function edit(ReserveBook $reserveBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReserveBookRequest  $request
     * @param  \App\Models\ReserveBook  $reserveBook
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReserveBookRequest $request, ReserveBook $reserveBook)
    {
        try {
            $reserveBook->update($request->all());

            return [
                "status" => 1,
                "data" => $reserveBook
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
     * @param  \App\Models\ReserveBook  $reserveBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReserveBook $reserveBook)
    {
        try {

            $reserveBook->delete();

            return [
                "status" => 1,
                "data" => $reserveBook
            ];

        } catch (Exception $e){

            return [
                "status" => 1,
                "error" => $e->getMessage()
            ];

        }
    }
}
