<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::paginate(10);
        
        
        return Inertia::render('Clientes/Index',['clientes' => $clientes]);
    }
    public function create()
    {
        return Inertia::render('Clientes/Create');
    }
    public function store(Request $request)
    {
        $request->validate([ 'pais' => 'required|max:100',
        'ciudad' => 'required|max:100',
        'institucion' => 'required|max:100',
        'email' => 'required|max:35',
        'telefono' => ['required', 'regex:/^[0-9()+\-.\s]*$/', 'max:25'],
        'direccion' => 'required|max:100',
    ]);
        $cliente = new Cliente($request->input());
        $cliente->save();
        return redirect('clientes');
    }
    public function show(Cliente $cliente)
    {
        //
    }
    public function edit(Cliente $cliente)
    {
        return Inertia::render('Clientes/Edit',['cliente' => $cliente]);
    }
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([ 'pais' => 'required|max:100',
        'ciudad' => 'required|max:100',
        'institucion' => 'required|max:100',
        'email' => 'required|max:35',
        'telefono' => ['required', 'regex:/^[0-9()+\-.\s]*$/', 'max:25'],
        'direccion' => 'required|max:100',
        ]);
        $cliente->update($request->all());
        return redirect('clientes');
    }
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect('clientes');
    }
    
}
