<?php

namespace App\Http\Controllers;

// imports
use Illuminate\Support\Facades\DB;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // passo 1
        $questFornecedor = $request->all();
        $fornecedor = new Fornecedor();

        // passo 2
        $fornecedor->nome_empresa_fornecedor = $questFornecedor['nome_empresa_fornecedor'];
        $fornecedor->nome_intermediador = $questFornecedor['nome_intermediador'];
        $fornecedor->email_fornecedor = $questFornecedor['email_fornecedor'];
        $fornecedor->urlsite_fornecedor = $questFornecedor['urlsite_fornecedor'];

        // passo 3
        $resposta = $fornecedor->save();

        if($resposta) {

            return response($fornecedor, 200);
        } else {

            return response("falha ao salvar dados do fornecedor", 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function show(Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fornecedor $fornecedor)
    {
        //
    }


    public function getFornecedor(){

        $fornecedor = DB::select("select * from fornecedors order by nome_empresa_fornecedor asc;");

        if($fornecedor) return response($fornecedor, 200);

        return response("Falha ao buscar informações dos fornecedores!=/");
    }
}
