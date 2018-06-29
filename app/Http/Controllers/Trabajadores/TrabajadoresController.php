<?php

namespace App\Http\Controllers\Trabajadores;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TrabajadoresController extends Controller
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
        $trabajadores = DB::table('m_trabajador')->where('estado_trabajador','1')->get();

        return view('Trabajadores.flistTrabajadores',compact('trabajadores'));
    }

    public function guardar_trabajador(Request $request){
        dd($request->all());

        DB::table('m_trabajador')->insert([
            [
                'nombre_trabajador'=> $request->nombre_trabajador,
                'apellido_trabajador'=>$request->apellido_trabajador,
                'dni_trabajador' => $request->dni_trabajador,
                'estado_trabajador' => '1'
            ]
        ]);

        return redirect()->back();

    }

    public function get_trabajador_por_id(Request $request){

        $trabajador = DB::table('m_trabajador')->where('id_trabajador',$request->id_trabajador)->get();
        return $trabajador;
    }

    public function actualizar_trabajador(Request $request){

        //dd($request->all());
        DB::table('m_trabajador')->where('id_trabajador',$request->id_trabajador)->update([
                'nombre_trabajador'=> $request->nombre_trabajador_edit,
                'apellido_trabajador'=>$request->apellido_trabajador_edit,
                'dni_trabajador' => $request->dni_trabajador_edit
        ]);

        return redirect()->back();
    }

    public function actualizar_estado_trabajador(Request $request){
        //dd($request->all());
        DB::table('m_trabajador')->where('id_trabajador',$request->id_trabajador_eliminar)->update([
            'estado_trabajador'=> '0'
        ]);

        return redirect()->back();
    }

}
