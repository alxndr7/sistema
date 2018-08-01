<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReportesController extends Controller
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
        return view('Reportes.flistReportes');
    }


    public function get_comision_por_fecha(Request $request){

        //dd($request->fecha_inicio);->where('edad', '<', 20)
        $comisiones = DB::table('vw_comisiones_all')
                    ->where('fecha_asignacion','>=',$request->fecha_inicio)
                    ->where('fecha_asignacion','<=',$request->fecha_fin)->get();
        return view('Reportes.fpartReportes.ajax_tabla_comisiones',compact('comisiones'));
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

    public function index_reporte_decos(){
        return view('Reportes.flistRepDecodificadores');
    }

    public function generar_reporte_decos(Request $request){
        $decos = DB::table('m_decos')->where('estado_deco',$request->estado_deco)->get();
        //return response()->json($decos);
        return view('Reportes.fpartReportes.ajax_tabla_decos',compact('decos'));
    }

    public function index_det_asig_trab(){
        return view('Reportes.flistReporteDetalleAsig');
    }

    public function get_det_asig_trabajdor(Request $request){

        //dd($request->fecha_inicio);->where('edad', '<', 20)
        $detalle = DB::table('vw_det_asig_trabajador')
            ->where('fecha_asignacion','>=',$request->fecha_inicio)
            ->where('fecha_asignacion','<=',$request->fecha_fin)->get();
        return view('Reportes.fpartReportes.ajax_tabla_det_asig_trab',compact('detalle'));
    }

}
