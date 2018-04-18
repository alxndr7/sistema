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
        $trabajadores = DB::table('M_TRABAJADOR')->where('ESTADO_TRABAJADOR','1')->get();

        return view('Trabajadores.flistTrabajadores',compact('trabajadores'));
    }

    public function guardar_trabajador(Request $request){

        DB::table('M_TRABAJADOR')->insert([
            [
                'NOMBRE_TRABAJADOR'=> $request->nombre_trabajador,
                'APELLIDO_TRABAJADOR'=>$request->apellido_trabajador,
                'DNI_TRABAJADOR' => $request->dni_trabajador
            ]
        ]);

        return redirect()->back();

    }

    public function get_trabajador_por_id(Request $request){

        $trabajador = DB::table('M_TRABAJADOR')->where('ID_TRABAJADOR',$request->id_trabajador)->get();
        return $trabajador;
    }

    public function actualizar_trabajador(Request $request){

        //dd($request->all());
        DB::table('M_TRABAJADOR')->where('ID_TRABAJADOR',$request->id_trabajador)->update([
                'NOMBRE_TRABAJADOR'=> $request->nombre_trabajador_edit,
                'APELLIDO_TRABAJADOR'=>$request->apellido_trabajador_edit,
                'DNI_TRABAJADOR' => $request->dni_trabajador_edit
        ]);

        return redirect()->back();
    }

    public function actualizar_estado_trabajador(Request $request){
        //dd($request->all());
        DB::table('M_TRABAJADOR')->where('ID_TRABAJADOR',$request->id_trabajador_eliminar)->update([
            'ESTADO_TRABAJADOR'=> '0'
        ]);

        return redirect()->back();
    }

}
