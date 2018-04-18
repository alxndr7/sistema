<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //consulta a base de datos, para traer la lista de trabajadores


        return view('home');
    }

    public function funcion_home()
    {
        //consulta a base de datos, para traer la lista de trabajadores
        $usuarios = DB::table('users')->get();
        $nombre = "HOLA JEREMY como estas";
        return view('Trabajadores.flistTrabajadores',compact('nombre','usuarios'));
    }
}
