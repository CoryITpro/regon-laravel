<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Rating;
use App\Models\Opinion;

class ViewUserController extends Controller
{


    public function __invoke(){

    	$users = User::get();

        return view('users.viewusers')
            ->with('users', $users);
    }

    public function edituser(Request $r1){

    	$user = User::find($r1->id);

    	if (isset($r1->password)){
    		$validated = $r1->validate([
        		'email' => 'required|email|min:4|max:255',
        		'name' => 'required|min:1|max:50',
        		'password' => 'min:3|max:15',
    		    // 'verified' => 'required',
	    	]);
    	}else {
    		$validated = $r1->validate([
        		'email' => 'required|email|min:4|max:255',
        		'name' => 'required|min:1|max:50',
    		    // 'verified' => 'required',
    		    // 'premium' => 'required',

	    	]);
    	}

    	if ($validated){

    		$user->email = $r1->email;
    		$user->verified = $r1->verified ? true: false;
    		$user->name = $r1->name;
    		$user->premium = $r1->premium;
    		if (isset($r1->password)){
    			$user->password = Hash::make($r1->password);
       		}
    		$user->save();

    		session()->flash('success_message','Edited Successfully');
    		return back();
    	}

    }

    public function premiumuser(Request $r1){

    	$user = User::find($r1->id);

    	$ratings = Rating::where([['id_user', '=', $r1->id ],])->get();
    	$opinions = Opinion::where([['user_id', '=', $r1->id ],])->get();

        return view('users.viewpremiumusers', [
            'premium' => $user->premium,
            'ratings' => $ratings,
            'opinions' => $opinions,
        ]);

    }

}
