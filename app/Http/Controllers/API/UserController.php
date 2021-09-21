<?php

namespace App\Http\Controllers\API;
use App\Models\Gender;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user (Request $request){

        $user = User::findorfail($request->user_id);

        return response()->json($user);
    }

 public function  Grades(Request $request){
        $Grades = Gender::latest()->get(); //من الحدث للئقدم latest
     return response()->json($Grades);

 }
}
