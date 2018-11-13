<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;

class LupaPasswordController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
    	$user = User::find(Auth::user()->id);
    	return view('profile.reset-password', compact('user'));
    }

    public function resetpassword(Request $request)
    {
    	$user = User::find(Auth::user()->id);
    	$user->password = Hash::make($request->password);
    	$user->update();
    	return redirect()->back();
    }
}
