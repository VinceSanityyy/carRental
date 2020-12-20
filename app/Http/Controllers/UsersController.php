<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\UserType;
class UsersController extends Controller
{
    public function getUsers(){
        // if(\Auth::user()->id === UserType::SUPER_ADMIN){
            $users = User::all()->except(\Auth::id());
            return response()->json($users);
        // }else{
        //     return response()->json('gtfo');
        // }

    }

    public function approveUser(Request $request){
        // dd($request->all());
        $user = User::find($request->id);
        $user->status = 1;
        $user->save();

        return response()->json('updated!');
    }
}
