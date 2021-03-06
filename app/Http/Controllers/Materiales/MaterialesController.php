<?php

namespace App\Http\Controllers\Materiales;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MaterialesController extends Controller
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
        //$materiales = DB::table('m_materiales')->where('estado_material','1')->orderby('id_material','asc')->get();
        $materiales = DB::select('select m.*, s.total_material from m_materiales m
                                    join t_stock_materiales s on m.id_material = s.id_material 
                                    where m.estado_material = \'1\' 
                                    Order By m.id_material asc');
        return view('Materiales.flistMateriales',compact('materiales'));
    }

    public function guarda_material(Request $request){

        $id = DB::table('m_materiales')->insertGetId([
            'desc_material'=> $request->desc_material,
            'unidad_medida_material'=>$request->unidad_medida_material,
            'estado_material' => '1'

        ], 'id_material');

   /*     DB::table('m_materiales')->insert([
            [
                'desc_material'=> $request->desc_material,
                'unidad_medida_material'=>$request->unidad_medida_material,
                'estado_material' => '1'
            ]
        ]);*/

        DB::table('t_stock_materiales')->insert([
            [
                'id_material'=> $id,
                'total_material'=> 0,
                'id_stock'=> $id,
            ]
        ]);

        return redirect()->back();

    }

    public function material_por_id(Request $request){

        $material = DB::table('m_materiales')->where('id_material',$request->id_material)->get();
        return $material;
    }

    public function actualizar_material(Request $request){

        //dd($request->all());
        DB::table('m_materiales')->where('id_material',$request->id_material)->update([
                'desc_material'=> $request->desc_material_editar,
                'unidad_medida_material'=>$request->unidad_medida_material_editar
        ]);

        return redirect()->back();
    }

    public function eliminar_material(Request $request){
        //dd($request->all());
        DB::table('m_materiales')->where('id_material',$request->id_material_eliminar)->update([
            'estado_material'=> '0'
        ]);

        return redirect()->back();
    }

}
