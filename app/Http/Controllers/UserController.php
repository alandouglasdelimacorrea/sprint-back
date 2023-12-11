<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\System;
use App\Models\Notation;




class UserController extends Controller
{
    public function store(Request $request){
        $model = new User();

        $model->fill($request->all());

        error_log($request);

        if ($model->save()) {
            return response()->json($model);
        }
        abort(500, "Erro ao salvar");
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);

        if ($latest = request()->get('latest')) {

            $user->load(['systems' => function ($query) {
                $query->orderBy('created_at', 'desc'); // Substitua 'nome_do_campo' pelo campo que deseja ordenar
            }]);

            $system = $user->systems;

            return response()->json($system);
        }
        $user->load('systems', 'time_entries');

        if ($name = request()->get('name')) {
            $user->systems()->where('name', 'like', "$name%")->get();
        }

        return response()->json($user);
    }

    public function teste(){
        // $notation = Notation::query();

        // $query = $notation->where('user_id', '1');

        // $models = $query->paginate(2);

        // return response()->json($models);
    }

}
