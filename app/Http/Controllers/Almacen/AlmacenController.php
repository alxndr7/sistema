<?php

namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AlmacenController extends Controller
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
        $listIo = DB::table('log_entradas_salidas')->take(100)->get();
        $listMateriales = DB::table('m_materiales')->where('estado_material','1')->orderby('id_material','asc')->get();

        return view('Almacen.flistAlmacen',compact('listIo','listMateriales'));
    }

    public function guardar_io(Request $request){

        //dd($request->all());

        DB::table('log_entradas_salidas')->insert([
            [
                'id_material'=> $request->id_material,
                'tipo_io'=>$request->tipo_io,
                'cantidad' => $request->cantidad,
                'desc_io' => $request->desc_io
            ]
        ]);

        return redirect()->back();

    }

    public function deco_por_id(Request $request){

        $deco = DB::table('m_decos')->where('id_deco',$request->id_deco)->get();
        return $deco;
    }

    public function actualizar_deco(Request $request){

        //dd($request->all());
        DB::table('m_decos')->where('id_deco',$request->id_deco)->update([
                'smart_card'=> $request->smart_card_editar,
                'serie'=>$request->serial_editar
        ]);

        return redirect()->back();
    }

    public function eliminar_deco(Request $request){
        //dd($request->all());
        DB::table('m_decos')->where('id_deco',$request->id_deco_eliminar)->update([
            'estado_deco'=> '0'
        ]);

        return redirect()->back();
    }

}
