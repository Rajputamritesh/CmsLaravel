<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){

        return view('users.index')->with('users',user::all());


    }

    public function changerole( $id){

        $user =User::find($id);
                                                    //user $user wont work here coz it works with only resource
     

        
        $user->role='admin';
        $user->save();

        return view('users.index')->with('users',user::all());


    }
    public function profile($id)
    {
        $user =User::find($id);
        
        return view('users.create')->with('user',$user);





    }

    public function update(Request $request,$id)
    {
        $user =User::find($id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->save();
        return view('users.index')->with('user',user::all());





    }
}
