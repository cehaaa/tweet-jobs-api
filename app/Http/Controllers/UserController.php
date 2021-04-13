<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return User::all();
    }

    public function userInformation($id)
    {
        return User::where('id', $id)->first();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $password = Hash::make($request->password);

        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $password;
        $user->entry_year = $request->entry_year;
        $user->graduation_year = $request->graduation_year;
        $user->major = $request->major;
        $user->date_of_birth = $request->date_of_birth;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->job = $request->job;
        $user->save();

        return response()->json(
            [
                'status' => '1 Data recorded'
            ]
        );
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $hashedPassword = $user->password;

        if ($user) {
            if (Hash::check($request->password, $hashedPassword)) {
                return response()->json([
                    'status' => 'Login success',
                    'user_id' => $user->id
                ]);
            } else {
                return response()->json(
                    [
                        'status' => 'Your password or email is invalid!'
                    ]
                );
            }
        } else {
            return 'Register your account first!';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //s

        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->entry_year = $request->entry_year;
        $user->graduation_year = $request->graduation_year;
        $user->major = $request->major;
        $user->date_of_birth = $request->date_of_birth;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->job = $request->job;
        $user->save();

        return "1 Data udated";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        User::findOrFail($id)->delete();
        return "1 Data deleted";
    }
}
