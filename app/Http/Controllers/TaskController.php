<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Backlog;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Task::query();

        $query->with('time_entries');

        $models = $query->paginate(10);

        return response()->json($models);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Backlog $backlog)
    {

        error_log($request);

        $task = new Task([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'progress' => $request->input('progress'),
            'points' => $request->input('points'),
            'status' => $request->input('status'),
            'open' => $request->input('open'),
        ]);

        $backlog->tasks()->save($task);

        return response()->json(['message' => 'Tarefa salva com sucesso', 'data' => $task], 201);


        // if ($model->save()) {
        //     return response()->json($model);
        // }
        // abort(500, "Erro ao salvar");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);

        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model = Task::findOrFail($id);

        $model->fill($request->all());

        if ($model->save()) {
            return response()->json($model);
        }
        abort(500, "Erro ao salvar");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Task::findOrFail($id);

        if ($model->delete()) {
            return response()->json($model);
        }
        abort(500, "Erro ao deletar");
    }


}
