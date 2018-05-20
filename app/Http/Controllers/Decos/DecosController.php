<?php

namespace App\Http\Controllers\Decos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DecosController extends Controller
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

        return view('Decos.flistDecos',compact('decos'));
    }

    public function guardar_deco(Request $request){

        DB::table('m_decos')->insert([
            [
                'smart_card'=> $request->smart_card,
                'serie'=>$request->serial,
                'estado_deco' => '1'
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
