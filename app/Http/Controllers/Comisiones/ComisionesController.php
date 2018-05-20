<?php

namespace App\Http\Controllers\Comisiones;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ComisionesController extends Controller
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
        $comisiones = DB::table('m_comisiones')->get();

        return view('comisiones.flistComisiones',compact('comisiones'));
    }


    public function get_comision_por_id(Request $request){

        $comision = DB::table('m_comisiones')->where('id_comision',$request->id_comision)->get();
        return $comision;
    }

    public function form_actualizar_comision(Request $request){

        //dd($request->all());
        DB::table('m_comisiones')->where('id_comision',$request->id_comision)->update([
                'i_deco_basico'=> $request->i_deco_basico,
                'i_deco_adi'=>$request->i_deco_adi,
                's_mudanza'=>$request->s_mudanza,
                's_otros'=>$request->s_otros,
                's_deco_adi'=>$request->s_deco_adi,
        ]);

        return redirect()->back();
    }

}
