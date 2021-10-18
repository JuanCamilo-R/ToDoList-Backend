<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
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
            return response('', 400);
        }
        $newUser = User::make([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => "{$toConcat}@" . "gmail.com"
        ]);
        $newUser->save();
        return response()->json($newUser);
    }

    public function auth(UserRequest $request)
    {
        $user = User::where('name', $request->name)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                return response('OK', 202);
            }
        } else {
            return response('NOT OK', 400);
        }
    }
}
