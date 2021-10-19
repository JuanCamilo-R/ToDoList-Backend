<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::where('id', $id)->get();
        return response()->json($user);
    }

    public function store(UserRequest $request)
    {
        $toConcat = strtolower($request->name);
        $searchDuplicateUser = User::where('name', $request->name)->first();
        if ($searchDuplicateUser) {
            return response('hola', 401);
        }
        $hashedPassword = Hash::make($request->password);
        $newUser = User::make([
            'name' => $request->name,
            'password' => $hashedPassword,
            'email' => "{$toConcat}@" . "gmail.com",
        ]);
        $newUser->save();
        return response()->json($hashedPassword);
    }

    public function auth(UserRequest $request)
    {
        $user = User::where('name', $request->name)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                return response($user->password, 202);
            } else {
                return response('NOT OK', 400);
            }
        } else {
            return response('NOT OK', 400);
        }
    }
}
