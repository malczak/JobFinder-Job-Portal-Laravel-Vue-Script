<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application|\Illuminate\View\View|RedirectResponse
     */
    public function index()
    {
        if (Auth::user()->isAdmin()) {
            return redirect()->to('/dashboard')->with('success', 'Admin Logged in Successfully.');


        }

        $jobs = Auth::user()->favorites;
        return view('home', compact('jobs'));
    }
}
