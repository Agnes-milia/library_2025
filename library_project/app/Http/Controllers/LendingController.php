<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLendingRequest;
use App\Http\Requests\UpdateLendingRequest;
use App\Models\Lending;
use Illuminate\Support\Facades\Auth;

class LendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Lending::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLendingRequest $request)
    {
        $lending = new Lending();
        $lending->fill($request->all());
        $lending->save();
        return response()->json($lending, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show ($user_id, $copy_id, $start)
    {
        $lending = Lending::where('user_id', $user_id)
        ->where('copy_id', $copy_id)
        ->where('start', $start)
        ->get();
        return $lending[0];
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLendingRequest $request, $user_id, $copy_id, $start)
    {
        $lending = $this->show($user_id, $copy_id, $start);
        $lending->fill($request->all());
        $lending->save();
        return response()->json($lending, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_id, $copy_id, $start)
    {
        $lending = $this->show($user_id, $copy_id, $start);
        $lending->delete();
        return response()->json(NULL, 200);
    }

    public function myLendingsWithCopies(){
        $user = Auth::user();
        return Lending::with("toCopies")
        ->where('user_id', $user->id)
        ->get();
    }
}
