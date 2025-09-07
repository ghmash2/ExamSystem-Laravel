<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Hash;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $request->validated();
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'contact' => $request->contact,
            'password' => $request->password,
            'image' => $request->image

        ]);

        return redirect()->route('users.index')->with('success', 'User created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.create', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validated();
        if ($request->hasFile('image')) {
            // if ($user->image) {
            //     Storage::disk('public')->delete($user->image);
            // }
            // $request['image'] = $request->file('image')->store('user_images', 'public');
        }
        if ($request->filled('password')) {
            $user->password = Hash::make($request['password']);
        } else {
            unset($request['password']);
        }
        $user->update(
            [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'contact' => $request->contact,
                'password' => $request->password,
                'image' => $request->image
            ]
        );
        return redirect()->route('users.index')->with('success', 'User updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::delete();
        return redirect()->route('users.index')->with('success', 'User Deleted Successfully!');
    }
}
