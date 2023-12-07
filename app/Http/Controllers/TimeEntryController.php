<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeEntry;


class TimeEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $entry = new TimeEntry();

        error_log($request->all());

        $entry->fill($request->all());

        if($entry->save()){
            return response()->json($entry);
        }

        abort(500, "Erro ao salvar");

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $entry = TimeEntry::findOrFail($id);

        // $start = $entry->start;
        // $end = $entry->end;

        // $elapsedTime = $start->diffInHours($end);

        // return response()->json(["data" => $entry, "elapsed" => $elapsedTime]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
