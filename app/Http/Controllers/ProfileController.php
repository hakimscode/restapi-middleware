<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request){
        $userId = $request->header('Authorization');
        $user_session = $request->session()->get($userId);
        return response()->json(['name' => $user_session['name']]);
    }

    public function update(Request $request, $id){
        try{
            $user = User::findOrFail($id);

            $user->name = $request->input('name');
            $user->company = $request->input('company');

            if($user->save()){
                return response()->json($user, 202);
            }
        }catch (QueryException $e){
            return response()->json(['message' => $e->errorInfo], 400);
        }
    }
}
