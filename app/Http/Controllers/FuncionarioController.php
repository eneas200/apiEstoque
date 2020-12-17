<?php

namespace App\Http\Controllers;

use App\Models\Funcionarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funcionario = DB::table('funcionarios')->pluck('nome_funcionario');
        print_r($funcionario);
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
        //
        $us = $request->all();
        $funcionario = new Funcionarios();
        $funcionario->nome_funcionario = $us["nome_funcionario"];
        $funcionario->email_funcionario = $us["email_funcionario"];
        $funcionario->senha_funcionario = $us["senha_funcionario"];

        $confirmarSenha = $us['confirmarSenha_funcionario'];
        if( $funcionario->senha_funcionario != $confirmarSenha ) {
            return response("as senha não coincidem.", 400);
        }

        $funcionario->senha_funcionario = Hash::make($funcionario->senha_funcionario);

        // inserindo dados no banco
        $funcionario->save();
        return $funcionario;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Funcionarios  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function show(Funcionarios $funcionario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Funcionarios  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function edit(Funcionarios $funcionario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Funcionarios  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Funcionarios $funcionario)
    {
        //

        if (!$funcionario) return response('Dados Inválido', 400);
        
        $nomeFuncionario = $request->input('nome_funcionario');
        $emailFuncionario = $request->input('email_funcionario');
        $senhaFuncionario = $request->input('senha_funcionario');
        $confirmarSenha = $request->input('confirmarSenha_funcionario');

        if (!$nomeFuncionario) return response('Campo nome é obrigatório.', 422);
        if (!$emailFuncionario) return response('Campo email é obrigatório.', 422);

        if ($emailFuncionario != $funcionario->email_funcionario) {
            $checkEmail = Funcionarios::where('email_funcionario', '=', $emailFuncionario)->first();
            if ($checkEmail) return response('Já existe um usuário com esse email', 422);
        }

        if($senhaFuncionario && $senhaFuncionario != $confirmarSenha) {
            return response('As senhas não coincidem.', 422);
        } else {
            $funcionario->senha_funcionario = Hash::make($senhaFuncionario);
        }

        $funcionario->nome_funcionario = $nomeFuncionario;
        $funcionario->email_funcionario = $emailFuncionario;

        $retorno = $funcionario->save();

        if ($retorno) return response($funcionario, 200);
        
        return response($funcionario, 200);
        return response('Erro ao atualizar o usuário.', 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Funcionarios  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funcionarios $funcionarios)
    {
        //
    }

    public function login(Request $request) {
        $dados = $request->all();
        $email = $dados['email_funcionario'];
        $senha = $dados['senha_funcionario'];
        
        if( !$email || !$senha ) {
            return response("Credenciais invalidas.", 400);
        }
        
        $funcionario = Funcionarios::where('email_funcionario', $email)->first();
        
        if(!$funcionario){
            return response("Credenciais invalidas.", 400);
        }       

        if(!Hash::check($senha, $funcionario->senha_funcionario)) {
            return response("Credenciais invalidas.", 400);
        }
    
        return $funcionario;


    }
}
