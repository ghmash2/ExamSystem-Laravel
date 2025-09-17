<?php

namespace App\Http\Controllers;

use App\ApiResponseClass;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserAnswer;
use Dotenv\Exception\ValidationException;
use Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Renderer\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return ApiResponseClass::sendResponse(UserResource::collection($users), 'User List', 200, []);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //return view('users.create'); //create form
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validated = $request->safe()->except(['password_confirmation']);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $imagePath;
        }
        
        $user = User::create($validated);

        return ApiResponseClass::sendResponse(new UserResource($user), 'User created', 201, []);
    }

    /**
     * Display the specified resource.
     */
    public function show($user_id)
    {
        try {
            $user = User::findOrFail($user_id);
        } catch (ModelNotFoundException $e) {
            return ApiResponseClass::sendResponse([], 'User not found', 404, ["User Not Found"]);
        }

        return ApiResponseClass::sendResponse(new UserResource($user), 'User Founded Succesfully', 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //return view('users.create', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, $user_id)
    {
        $validated = $request->validated();

        $user = User::findOrFail($user_id);


        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $imagePath;

        }

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        }
        $user->update($validated);
        $user->refresh();
        return ApiResponseClass::sendResponse(new UserResource($user), 'User Updated', 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_id)
    {
        $user = User::findOrFail($user_id);
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }
        $user->delete();
        return ApiResponseClass::sendResponse(new UserResource($user), 'User Deleted', 200);
    }

    public function history(Request $request)
    {
        $user_id = $request->query('user_id');
        $result = UserAnswer::where('user_id', $user_id)->get();
        return ApiResponseClass::sendResponse($result, 'Exams attempted by this user', 200);
    }
    public function single_exam_history(Request $request, $user_exam_id)
    {
        $user_id = $request->query('user_id');
        $exam_id = $request->query('exam_id');

        $result = UserAnswer::with('answer_options')->where('user_id', $user_id)->where('exam_id', $exam_id)->where('id', $user_exam_id)->get();
        return ApiResponseClass::sendResponse($result, 'Result of all Exam by a user', 200);
    }
}
