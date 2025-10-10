<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLendingRequest;
use App\Http\Requests\UpdateLendingRequest;
use App\Models\Lending;

class LendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLendingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Lending $lending)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLendingRequest $request, Lending $lending)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lending $lending)
    {
        //
    }
}
