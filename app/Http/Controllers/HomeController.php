<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        // Recuperar el usuario autenticado
        $user = auth()->user();
        //$fav_products = $user->favorites();
        if (!$user) {
            return response()->json(['message' => 'Usuario no autenticado'], 401);
        }

        return view('home', compact('user'));
    }
}
