<?php

namespace App\Http\Controllers;

use App\Models\Promocao;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class PromocaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Promocao::orderBy('updated_at')->paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
            'imagem' => 'required',
            'descricao' => 'required',
            'veiculo_id' => 'required|exists:veiculos,id',
        ]);
        $promocao = Promocao::create($data);
        return $promocao;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promocao = Promocao::findOrFail($id);
        return response()->json($promocao);
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
            'imagem' => 'required',
            'descricao' => 'required',
            'veiculo_id' => 'required|exists:veiculos,id',
        ]);
        $promocao = Promocao::findOrFail($id);
        $promocao->update($data);

        return response()->json($promocao);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promocao = Promocao::findOrFail($id);
        $promocao->delete();
        return response()->json($promocao);
    }
}
