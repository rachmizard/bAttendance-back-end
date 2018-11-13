<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class ProfileController extends Controller
{
    public function index($value='')
    {
    	return view('profile.profile');
    }

    public function profile(Request $request)
    {
    	$user = User::find(Auth::user()->id);
    	$user->update($request->except('password'));
    	return redirect()->back();

    }
}
