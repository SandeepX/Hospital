<?php

namespace App\Http\Controllers;


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
        $role = (auth()->user()->role  == 'accountant') ? 'admin' : auth()->user()->role;
        return redirect()->route($role);
    }

    public function user()
    {
        return  view('frontend.welcome');
    }
}
