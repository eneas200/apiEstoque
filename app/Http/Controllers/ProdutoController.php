<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        echo "Produtos Controller";
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
        $requestProdutos = $request->all();
        $produto = new Produto();
        
        // passo 2 
        $produto->nome_produto= $requestProdutos['nome_produto'];
        $produto->preco_produto= $requestProdutos['preco_produto'];
        $produto->quantidade_produto= $requestProdutos['quantidade_produto'];
        $produto->categoria= $requestProdutos['categoria'];
        
        // passo 3
        $produto->save();
        return $produto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        //
        echo "metodo show";
        $produto = new Produto();
        $nome = $produto->get('nome_produto');
        print_r($nome);
        // var_dump($produto->all());
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        //
    }

    public function getProdutos(){
        // $table = DB::table('produtos');
        
        $retornoProduto = DB::select('SELECT * FROM produtos');

        if($retornoProduto) return $retornoProduto;

        return response("Não há produtos cadastrado");
        
    }

}
