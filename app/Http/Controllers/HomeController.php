<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->premium) {
            $premium_date = new Carbon($user->premium);
            $today = Carbon::today();
            $diffInDays = $today->diffInDays($premium_date);
            if ($diffInDays > 183) {
                $user->premium = null;
                $user->save();
                $purchasable = true;
            } else {
                $purchasable = false;
            }
        } else {
            $diffInDays = 0;
            $purchasable = true;
        }

        return view('home')->with(compact('user', 'purchasable'));
    }
}
