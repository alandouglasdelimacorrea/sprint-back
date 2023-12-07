<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Backlog;


class BacklogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Backlog::query();

        $query->with('tasks');


        $models = $query->paginate(10);

        return response()->json($models);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $model = new Backlog();

        error_log($request);

        if ($this->save($model, $request)) {
            return response()->json($model);
        }
        abort(500, "Erro ao salvar");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $backlog = Backlog::findOrFail($id);

        $backlog->load('tasks');

        return response()->json($backlog);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $model = Backlog::findOrFail($id);

        $model->fill($request->all());

        if ($this->save($model, $request)) {
            return response()->json($model);
        }
        abort(500, "Erro ao salvar");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Backlog::findOrFail($id);

        if ($model->delete()) {
            return response()->json($model);
        }
        abort(500, "Erro ao deletar");
    }

    private function save(Backlog $backlog, Request $request)
    {
        $backlog->fill($request->all());

        error_log($backlog);

        if ($backlog->save()) {
            // if ($request->has('tasks') && is_array($request->get('tasks'))) {
            //     $ids = collect($request->get("tasks"))->map(function ($task) {
            //         return $task['id'];
            //     });
            //     $backlog->tasks()->sync($ids);
            // }
        }
        $backlog->load('tasks');

        return $backlog;
    }
}
