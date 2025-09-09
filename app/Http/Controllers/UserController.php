<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Storage;

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
        return view('users.create'); //create form
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $request->validated();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
        } else
            $imagePath = null;
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'contact' => $request->contact,
            'password' => $request->password,
            'image' => $imagePath

        ]);

        return redirect('/login')->with('success', 'User created Successfully!');
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
    public function update(UserRequest $request, User $user)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $imagePath = $request->file('image')->store('uploads/images', 'public');
            $user->image = $imagePath;
        }
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }
        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->contact = $validated['contact'];
        $user->save();

        return redirect()->route('users.index', $user)->with('success', 'User updated Successfully!');
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
