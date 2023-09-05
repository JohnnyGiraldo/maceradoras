<?php

namespace App\Http\Controllers;

use App\Models\Maceradora;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MaceradoraController extends Controller
{
    public function index()
    {
        $maceradoras = Maceradora::select('maceradoras.serial','maceradoras.modelo',
        'estado','fechaFabricacion','tipoAsistencia','fechaInstalacion',
        'tipoMantenimiento','fechaMantenimiento','tipoPieza','fechaCambioPieza',
        'numeroCiclos','fechaIncidente','observaciones','img',
        'cliente_id as cliente')
        ->join('clientes','cliente_id','=','maceradoras.cliente_id')
        ->paginate(10);

        $clientesArray = Cliente::all();

        $clientes = $clientesArray->map(function ($cliente) {
            return [
                'id' => $cliente->id,
                'name' => $cliente->institucion,
            ];
        })->all();

        return Inertia::render('Maceradoras/Index',['maceradoras' => $maceradoras,
        'clientes' => $clientes]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'serial' => 'required|max:150',
            'modelo' => 'required|max:150',
            'estado' => 'required|max:150',
            'fechaFabricacion' => 'required|max:150',
            'tipoAsistencia' => 'required|max:150',
            'fechaInstalacion' => 'required|max:150',
            'tipoMantenimiento' => 'required|max:150',
            'fechaMantenimiento' => 'required|max:150',
            'tipoPieza' => 'required|max:150',
            'fechaCambioPieza' => 'required|max:150',
            'numeroCiclos' => 'required|max:150',
            'fechaIncidente' => 'required|max:150',
            'observaciones' => 'required|max:150',
            'img' => 'required|max:150',
            'cliente_id' => 'required|max:150'
        ]);
        $maceradora = new Maceradora($request->input());
        $maceradora->save();
        return redirect('maceradoras');
    }
    public function update(Request $request, $maceradora)
    {
       
        $maceradora = Maceradora::findOrFail($maceradora);

    
        $maceradora->update($request->input());
    
        return redirect('maceradoras');
    }
    public function destroy(Maceradora $maceradora)
    {
        $maceradora->delete();
        return redirect('maceradoras');
    }
    public function MaceradoraByCliente(){
        $data = Maceradora::select(DB::raw('count(maceradoras.serial) as count, clientes.institucion'))
        ->join('clientes','clientes.id','=','maceradoras.cliente_id')
        ->groupBy('clientes.institucion')->get();
        return Inertia::render('Maceradoras/Graphic',['data' => $data]);
    }
    public function reports(){
        $maceradoras = Maceradora::select('maceradoras.serial', 'maceradoras.modelo', 'estado',
        'fechaFabricacion', 'tipoAsistencia', 'fechaInstalacion', 'tipoMantenimiento', 'fechaMantenimiento',
        'tipoPieza', 'fechaCambioPieza', 'numeroCiclos', 'fechaIncidente', 'observaciones', 'img',
        'clientes.institucion as institucion') // Alias 'institucion' para la columna 'institucion' en clientes
        ->join('clientes', 'clientes.id', '=', 'maceradoras.cliente_id')
        ->get();

        $clientes = Cliente::all();

        return Inertia::render('Maceradoras/Reports',['maceradoras' => $maceradoras,
        'clientes' => $clientes]);
    }

}



