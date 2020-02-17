<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Venda::orderBy('updated_at')->paginate(20));
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
        $data = $this->validate($request, [
            'vendedor_id' => 'required',
            'veiculo_id' => 'required',
            'cliente_id' => 'required'
        ]);

        $venda = Venda::create($data);
        return response()->json($venda);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venda = Venda::findOrFail($id);
        return response()->json($venda);
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
        $data = $this->validate($request, [
            'vendedor_id' => 'required|exists:vendedores,id',
            'veiculo_id' => 'required|exists:veiculos,id',
            'cliente_id' => 'required|exists:clientes,id'
        ]);

        $venda = Venda::findOrFail($id);
        $venda->update($data);
        return response()->json($venda);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venda = Venda::findOrFail($id);
        $venda->delete();
        return response()->json($venda);
    }
}
