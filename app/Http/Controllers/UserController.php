<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'users'=>User::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user=new User;
        $user->name = $request->name;
        $user->email=$request->email;
        $user->password=$request->password;
        $user->save();
        return response()->json([
            'message'=>'saved succesfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user=DB::table('users')->where('id',$id)->get();
        return response()->json([
            'user'=>$user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        // Check if user exists
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        $user->name=$request->Name;
        $user->email=$request->email;
        $user->password=$request->password;
        $user->save();
        return response()->json([
            'message'=>'update succesfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'message'=>'succesfully deleted'
        ]);
    }
}
