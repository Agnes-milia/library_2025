<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLendingRequest;
use App\Http\Requests\UpdateLendingRequest;
use App\Models\Copy;
use App\Models\Lending;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    //Azokat a kölcsönzéseket és példányokat nézzük meg, amik még aktívak (nálam van).
    public function myLendingsAtMe(){
        $user = Auth::user();
        $lendings = DB::table("lendings as l")
        ->join("copies as c", "l.copy_id", "c.id")
        ->selectRaw("*")
        ->where("user_id", $user->id)
        ->whereNull("end")
        ->get();

        return $lendings;
    }

    public function hasExample(){
        return Lending::has('toCopies', ">=", 1)->get();
    }

    public function bringBack($copy_id, $start){
        $user = Auth::user();
        DB::transaction(function () use ($user, $copy_id, $start) {
            $lending = Lending::where('user_id', $user->id)
                ->where('copy_id', $copy_id)
                ->where('start', $start)
                ->whereNull('end') //nincs visszahozva
                ->firstOrFail(); //az egyetlen adat, ha van


            $lending->update([
                'end' => now(),
            ]);


            Copy::where('id', $copy_id)->update([
                'status' => 0,
            ]);
        });

    }

        public function rawExample($copy_id){
            $results = DB::select(
            "SELECT user_id, created_at FROM lendings WHERE copy_id = $copy_id");
            return $results;
        }
}
