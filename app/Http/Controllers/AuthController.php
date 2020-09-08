<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request) {
        try{
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->company = $request->input('company');

            if($user->save()){
                return response()->json($user, 201);
            }
        }catch (QueryException $e){
            return response()->json(['message' => $e->errorInfo], 400);
        }
    }

    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where("email", $email)->first();
        if ($user){
            if (Hash::check($password, $user->password)){
                $request->session()->put($user->id, ['name' => $user->name]);
                return response()->json(['message' => 'Login Success'], 200);
            }else{
                return response()->json(['message' => 'Invalid password'], 403);
            }
        }else{
            return response()->json(['message' => 'Invalid user'], 403);
        }
    }
}
