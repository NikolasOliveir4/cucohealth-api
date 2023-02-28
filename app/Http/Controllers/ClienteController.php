<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
 
    public function listAll()
    {
        $clientes = Cliente::where('inativo',null)->orWhere('inativo',0)->get();

        return response()->json([
            'message' => 'Listado com sucesso',
            'clientes' => $clientes
        ],200);
    }

    public function create(Request $comand){

        try {
            $cliente = Cliente::create($comand->all());
        return $this->listAll();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao inserir cliente',
                'error' => $th
            ],401);
        }
    }
    
    public function update(Request $comand, Cliente $id){

        try {
            $id->update($comand->all());
            return $this->listAll();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao atualizar cliente',
                'error' => $th
            ],401);
        }
    }

    public function delete(Request $comand, Cliente $id){

        try {
            $id->update(['inativo'=> 1]);
        return response()->json([
            'message' => 'Cliente deletado com sucesso',
            'clientes' => $id
        ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao deletar cliente',
                'error' => $th
            ],401);
        }
    }

    public function search(Request $comand){

        
        try {
            $query = $comand->q;
            $queryIsNumeric = is_numeric($query);

            if($queryIsNumeric){
                $clientes = Cliente::where('cpf_cnpj', 'like', "%{$query}%")->where('inativo',null)->orWhere('inativo',0)->get();
            }else{
                $clientes = Cliente::where('nome', 'like', "%{$query}%")->where('inativo',null)->orWhere('inativo',0)->get();
            }
           
        return response()->json([
            'message' => 'Sucesso!',
            'clientes' => $clientes
        ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao procurar cliente',
                'error' => $th
            ],401);
        }
    }

    public function searchCpfCnpj(Request $comand){

        
        try {
            $query = $comand->q;
            $queryIsNumeric = is_numeric($query);

            if($queryIsNumeric){
                $clientes = Cliente::where('cpf_cnpj', '=', "{$query}")->get();
            }
        if(count($clientes) > 0){
            $message = ' Já cadastrado!';
        }else{
            $message = ' Válido!';
        }
        return response()->json([
            'message' => $message,
            'clientes' => $clientes
        ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro na consulta',
                'error' => $th
            ],401);
        }
    }


}
