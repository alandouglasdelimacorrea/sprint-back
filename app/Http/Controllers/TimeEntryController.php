<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeEntry;
use App\Models\Task;
use App\Models\User;




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

        $entry = new TimeEntry([
            'total_time' => $request->total_time,
            'time_milissec' => $request->time_milissec
        ]);

        $user = User::find($request->user_id);
        $task = Task::find($request->task_id);

        $entry->task()->associate($task);
        $entry->user()->associate($user);


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
        $entry = TimeEntry::findOrFail($id);

        $entry->fill($request->all());

        if($entry->save()){
            return response()->json($entry);
        }
        abort(500, 'Erro ao salvar');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
