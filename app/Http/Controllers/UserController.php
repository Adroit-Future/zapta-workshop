<?php

namespace App\Http\Controllers;

use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function contact(User $user){
        // $user=User::find($id);
        // return $user;
        return view('demo',compact('user'));
    }

    public function posts($id){
        // $user=User::find($id)->posts()->where('title','like','%Et%')->get();
        // $user=User::with('posts')->find($id);
        $user=User::with('latestPost')->find($id);
        return $user;
        return view('demo',compact('user'));
    }


    public function roles(){
        $user=User::find(1);
        // RoleUser::truncate();
        $user->roles()->detach([9,11,12,13]);
        return $user->roles()->attach([9,11,12]);
        // return $user->roles()->sync([9,11,12,13]);
        // $user=User::with('roles')->get();
        // return $user;
        return view('demo',compact('user'));
    }
}
