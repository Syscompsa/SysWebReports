<?php

namespace App\Http\Controllers;
use PDO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        return view('reporte');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $json = json_decode($request->getContent());
        DB::transaction(function () use($request,$json){
            $numerorep='';
            $response = DB::select("EXEC GuardarReporte :tipo,:empresa_rs,:numeror,:cod_asesor,:fechaIngreso,:solucion,:facturar,:ordenTrabajo,:solucionado,:contrato,:dpto,:solicitadoPor,:hora_ini,:hora_fin,:observaciones,:fecha_rs",array(
                'tipo'=>$request->user()->tipoCod,
                'empresa_rs'=>$json->cliente->codigo,
                'numeror'=>$numerorep,
                'cod_asesor'=>$request->user()->codigo,
                'fechaIngreso'=>$request->fecha,
                'solucion'=>$request->solucion,
                'facturar'=>$request->facturar,
                'ordenTrabajo'=>$request->ordenTrabajo,
                'solucionado'=>$request->solucionado,
                'contrato'=>$request->contrato,
                'dpto'=>$request->departamento,
                'solicitadoPor'=>$request->solicitadoPor,
                'hora_ini'=>$request->horaInicial,
                'hora_fin'=>$request->horaFinal,
                'observaciones'=>$request->observaciones,
                'fecha_rs'=>$request->fechaReporte)
            );
            $numero =  $response[0]->numero;
            $linea = 1;
            foreach($json->listaDetalles as $detalle){
                    DB::statement("EXEC GuardarReporteDetail ?,?,?,?,?,?",[
                        $linea,
                        $numero,
                        $detalle->rubro->codigo,
                        $detalle->tiempo,
                        $request->user()->tipoCod,
                        $detalle->descripcion
                    ]);
                $linea++;
            }
        });
        echo "termine store";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
