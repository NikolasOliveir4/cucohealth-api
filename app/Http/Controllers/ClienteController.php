<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
 
    public function listAll()
    {
        $clientes = Cliente::all();

        return response()->json([
            'message' => 'Listado com sucesso',
            'clientes' => $clientes
        ],200);
    }

    // public function inserir(){
    //     try {
    //         $cliente = Cliente::create([
    //             'nome' => 'Nikolas Oliveira'
    //             ,'data_nascimento'=> '2000-09-06 00:00:00'
    //             ,'cpf_cnpj' => '01810777283'
    //             ,'tipo' => 0
    //             ,'email' => 'nikolas_081@hotmail.com'
    //             ,'telefone'=>'+5598982573662'
    //         ]);
    
    //         return response()->json([
    //             'message' => 'Cliente inserido com sucesso',
    //             'clientes' => $cliente
    //         ],200);
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'message' => 'Erro interno no servidor',
    //             'error' => $th
    //         ],401);
    //     }
    // }

    public function create(Request $comand){

        try {
            $cliente = Cliente::create($comand->all());
        return response()->json([
            'message' => 'Cliente inserido com sucesso',
            'clientes' => $cliente
        ],200);
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
        return response()->json([
            'message' => 'Cliente atualizado com sucesso',
            'clientes' => $id
        ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao atualizar cliente',
                'error' => $th
            ],401);
        }
    }

    public function delete(Request $comand, Cliente $id){

        try {
            $id->delete();
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

    public function search(Request $comand, Cliente $cliente){

        
        try {
            $query = $comand->q;
            $queryIsNumeric = is_numeric($query);

            if($queryIsNumeric){
                $clientes = Cliente::where('cpf_cnpj', 'like', "%{$query}%")->get();
            }else{
                $clientes = Cliente::where('nome', 'like', "%{$query}%")->get();
            }
            // $query = Cliente::whereRaw('nome LIKE "ni%"')->get();
            // $binds = $clientes->getBindings();
           
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


}
