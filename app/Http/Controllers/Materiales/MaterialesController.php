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
        $materiales = DB::table('m_materiales')->where('estado_material','1')->orderby('id_material','asc')->get();

        return view('Materiales.flistMateriales',compact('materiales'));
    }

    public function guarda_material(Request $request){

        DB::table('m_materiales')->insert([
            [
                'desc_material'=> $request->desc_material,
                'unidad_medida_material'=>$request->unidad_medida_material,
                'estado_material' => '1'
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
