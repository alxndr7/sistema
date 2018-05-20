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

        $decos = DB::select('SELECT 
                  COUNT(a.id_deco) filter (where estado_deco = \'1\') as disponibles, 
                  count(a.id_deco) filter (where estado_deco != \'0\') as total
                  FROM m_decos a');

        $materiales = DB::table('vw_porcentaje_materiales')->get();

        $deco_disp_porcen = ($decos[0]->disponibles * 100)/$decos[0]->total;

        return view('home',compact('deco_disp_porcen','materiales'));
    }

    public function funcion_home()
    {
        //consulta a base de datos, para traer la lista de trabajadores
        $usuarios = DB::table('users')->get();
        $nombre = "HOLA JEREMY como estas";
        return view('Trabajadores.flistTrabajadores',compact('nombre','usuarios'));
    }
}
