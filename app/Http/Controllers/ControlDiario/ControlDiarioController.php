<?php

namespace App\Http\Controllers\ControlDiario;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ControlDiarioController extends Controller
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
        $decos = DB::table('m_decos')->where('estado_deco','1')->get();
        $trabajadores = DB::table('m_trabajador')->where('estado_trabajador','1')->get();
        $materiales = DB::table('m_materiales')->where('estado_material','1')->get();
        $detalle = DB::select('select dia.*,trab.* from log_asignacion_diaria dia
                                join m_trabajador trab on trab.id_trabajador = dia.id_trabajador where dia.estado = \'1\'');
        $materiales = DB::select('select m.*, s.total_material from m_materiales m
                                    join t_stock_materiales s on m.id_material = s.id_material 
                                    where m.estado_material = \'1\' 
                                    Order By m.id_material asc');

        return view('ControlDiario.flistControl',compact('trabajadores','decos','materiales','detalle','materiales'));
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

    public function form_guardar_asignacion(Request $request){

        //dd($request->get('txt_cantidad_1'));
        $decos= explode(',', $request->ids_dcos);
        $materiales= explode(',', $request->ids_mate);


        DB::table('log_asignacion_diaria')->insert([
            'id_trabajador' => $request->select_trabajador,
            'tipo_servicio' => $request->select_tipo,
            'ibs' => $request->ibs,
            'orden_trabajo' =>$request->orden_trabajo,
            'detalle_servicio' => $request->select_tipo_serv,
            'fecha_asignacion' => DB::raw('now()'),
            'estado' => '1'

        ]);

        $id = DB::getPdo()->lastInsertId();


        if( $decos[0] != ''){
            for($i = 0 ; $i < count($decos); $i++){
                DB::table('detalle_decos_asig')->insert([
                    [
                        'id_asignacion' => $id,
                        'id_deco' => $decos[$i],
                        'estado_asig_deco' => '1'

                    ]
                ]);
            }
        }

        if( $materiales[0] != '') {
            for ($i = 0; $i < count($materiales); $i++) {
                DB::table('detalle_materiales_asig')->insert([
                    [
                        'id_asignacion' => $id,
                        'id_material' => $materiales[$i],
                        'cantidad' => $request->get('txt_cantidad_' . $materiales[$i])
                    ]
                ]);
            }
        }

        return redirect()->back();

    }

    public function get_modal_decos(Request $request){
        $decosAsig = DB::select('select detde.*, dec.* from detalle_decos_asig detde
                      join m_decos dec on dec.id_deco = detde.id_deco where detde.estado_asig_deco = \'1\' and id_asignacion = '. $request->id_asignacion);

        return view('ControlDiario.modal_decos',compact('decosAsig'));
    }

    public function get_modal_materiales(Request $request){

        $matAsig = DB::select('select detmat.*, mat.* from detalle_materiales_asig detmat
                    join m_materiales mat on mat.id_material = detmat.id_material where id_asignacion = '. $request->id_asignacion);
        return view('ControlDiario.modal_materiales',compact('matAsig'));
    }

    public function get_modal_validar(Request $request){

        $arrayDecos = [];
        $arrayMateriales = [];

        $decosAsig = DB::select('select detde.*, dec.* from detalle_decos_asig detde
                      join m_decos dec on dec.id_deco = detde.id_deco where detde.estado_asig_deco = \'1\' and id_asignacion = '. $request->id_asignacion);

        $matAsig = DB::select('select detmat.*, mat.* from detalle_materiales_asig detmat
                    join m_materiales mat on mat.id_material = detmat.id_material where id_asignacion = '. $request->id_asignacion);

        foreach ($decosAsig as $dec){
            array_push($arrayDecos,$dec->id_det_dec);
        }

        foreach ($matAsig as $mat){
            array_push($arrayMateriales,$mat->id_mat_asig);
        }

        $id_decos = implode(",", $arrayDecos);
        $id_materiales = implode(",",$arrayMateriales);
        return view('ControlDiario.modal_validar',compact('decosAsig','matAsig','id_decos','id_materiales'));
    }

    public function form_validar_asignacion(Request $request){

        //dd($request->all());
        $decos= explode(',', $request->ids_decos);
        $materiales= explode(',', $request->ids_materiales);


        for($i = 0 ; $i < count($decos); $i++){
            $tmp_deco = $request->get('deco_'.$decos[$i]);
            if($tmp_deco == '0'){
                DB::table('detalle_decos_asig')->where('id_det_dec',$decos[$i])->update([
                    'estado_asig_deco'=> '0'
                ]);
            }
        }

        for($i = 0 ; $i < count($materiales); $i++){

            DB::table('detalle_materiales_asig')->where('id_mat_asig',$materiales[$i])->update([
                'cantidad'=> $request->get('cantidad_despues_'.$materiales[$i])
            ]);
        }

        DB::table('log_asignacion_diaria')->where('id_asignacion',$request->id_asignacion)->update([
            'estado'=> '2'
        ]);

        return redirect()->back();

   /*     DB::table('m_decos')->select(..)->whereNotIn('book_price', [100,200])->get();
        DB::table('m_decos')->whereNotIn('id_deco',$request->id_deco_eliminar)->update([
            'estado_deco'=> '0'
        ]);*/

    }

    public function get_deco_x_serie(Request $request){

        $deco = DB::table('m_decos')->where('serie',$request->serie)->get();

        return response()->json($deco);

    }

    public function get_stock_materiales(){
        $materiales = DB::select('select m.*, s.total_material from m_materiales m
                                    join t_stock_materiales s on m.id_material = s.id_material 
                                    where m.estado_material = \'1\' 
                                    Order By m.id_material asc');
        return response()->json($materiales);
    }

}
