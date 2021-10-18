<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::where('id', $id)->get();
        return response()->json($user);
    }

    public function store(UserRequest $request)
    {
    }
}
