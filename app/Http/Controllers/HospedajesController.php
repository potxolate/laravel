<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospedaje;

class HospedajesController extends Controller
{
    public function index()
    {
        $hospedajes = Hospedaje::all();
        return view('hospedajes.index', compact('hospedajes'));
    }
}
