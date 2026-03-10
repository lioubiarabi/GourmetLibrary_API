<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'users' => User::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:30',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|regex:/^\+212[67][0-9]{8}$/',
            'password' => 'required|string|min:8|max:220'
        ]);

        $user = User::create($validated);

        return response()->json([
            'message' => 'User created with success!',
            'user' => $user
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|min:3|max:30',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'phone' => 'sometimes|required|string|regex:/^\+212[67][0-9]{8}$/',
            'password' => 'sometimes|required|string|min:8|max:220'
        ]);

        $user->update($validated);

        return response()->json([
            'message' => "User ID {$user->id} ({$user->name}) updated successfully!",
            'user' => $user
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
