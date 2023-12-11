<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\System;
use Carbon\Carbon;



class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = System::query();

        // if ($name = request()->get('name')) {
        //     $query->where('name', 'like', "$name%");
        // }

        $models = $query->paginate(10);

        return response()->json($models);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $model = new System();


        error_log($request);

        if ($this->save($model, $request)) {
            return response()->json($model);
        }
        abort(500, "Erro ao salvar");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $system = System::with('backlogs.tasks')->findOrFail($id);



        // if ($name = request()->get('name')) {
        //     $system->where('name', 'like', "$name%");
        // }

        if($prevision = request()->get('sprint')){

            error_log('prevision');

            $start = Carbon::now('America/Sao_Paulo')->startOfWeek();

            $end = Carbon::now('America/Sao_Paulo')->endOfWeek();

            $response = $system->backlogs()
                ->whereBetween('prevision', [$start, $end])
                ->get()->groupBy( function($date){
                    return Carbon::parse($date->prevision)->format('Y-m-d');
                });


            return response()->json($response);
        }

        $system->load('backlogs.tasks.time_entries');

        return response()->json($system);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model = System::findOrFail($id);

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
        $model = System::findOrFail($id);

        if ($model->delete()) {
            return response()->json($model);
        }
        abort(500, "Erro ao deletar");
    }

    private function save(System $system, Request $request)
    {
        $system->fill($request->all());

        error_log($system);

        if ($system->save()) {
            if ($request->has('users') && is_array($request->get('users'))) {

                error_log('entrou aqui');
                $ids = collect($request->get("users"))->map(function ($user) {
                    return $user['id'];

                });
                $system->user()->sync($ids);
            }
        }
        $system->load('user');

        return $system;
    }
}
