<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;

class CarsController extends Controller
{   
    /**
     * Cadastra um novo veiculo no banco de dados
     * @param Array $request - dados do pedido,
     * @return Array status sobre o cadastro
     */
    public function registerVeiculos(Request $request)
    {   
        try{
            Veiculo::create([
                'veiculo' => $request['veiculo'],
                'marca' => $request['marca'],
                'ano' => $request['ano'],
                'descricao' => $request['descricao'],
                'vendido' => $request['vendido'] == 'true' ? true : false
            ]);
            return response()->json(['err' => 0, 'data' => ['message' => 'Veículo Cadastrado com Sucesso.']]);
        }catch(Exception $e){
            return response()->json(['err' => 1, 'data' => ['message' => $e->getMessage(), 'code' => $e->getCode()]]);
        }
    }

    /**
     * Atualiza as informações de um veiculo
     * @param Array $request - Informações de atualização
     * @param String $id - Identificador do veiculo para atualização
     * @return Array status sobre a atualização
     */
    public function updateVeiculo($id, Request $request)
    {
        try{
            $veiculo = Veiculo::find($id);
            $veiculo->veiculo = $request['veiculo']['veiculo'];
            $veiculo->marca = $request['veiculo']['marca'];
            $veiculo->ano = $request['veiculo']['ano'];
            $veiculo->descricao = $request['veiculo']['descricao'];
            $veiculo->vendido = $request['veiculo']['vendido'] == 'true' ? true : false;
            $veiculo->save();
            return response()->json(['err' => 0, 'data' => ['message' => 'Veículo atualizado com sucesso.']]);
        }catch(Exception $e){
            return response()->json(['err' => 1, 'data' => ['message' => $e->getMessage(), 'code' => $e->getCode()]]);
        }
    }

    /**
     * Deleta um veiculo do banco de dados
     * @param String $id - Identificador do veiculo para deletar
     * @return Array status sobre o delete
     */
    public function deleteVeiculo($id)
    {
        try{
            Veiculo::find($id)->delete();
            return response()->json(['err' => 0, 'data' => ['message' => 'Veículo deletado com sucesso.']]);
        }catch(Exception $e){
            return response()->json(['err' => 1, 'data' => ['message' => $e->getMessage(), 'code' => $e->getCode()]]);
        }
    }

    /**
     * Retorna uma lista com todos os veiculos
     * @return Array $veiculos - array com todos os veiculos cadastrados
     */
    public function getVeiculos()
    {
        try{
            $veiculos = Veiculo::all();
            foreach ($veiculos as $key => $v) {
               $veiculos[$key]['criado'] = $v['created_at']->format('d/m/Y H:i:s');
            }
            return response()->json(['err' => 0, 'data' => ['veiculos' => $veiculos]]);
        }catch(Exception $e){
            return response()->json(['err' => 1, 'data' => ['message' => $e->getMessage(), 'code' => $e->getCode()]]);
        }
    }

    /**
     * Retorna informações de um veiculo
     * @param String $id - Identificador do veiculo
     * @return Array Informações do veiculo
     */
    public function getVeiculo($id)
    {
        try{
            $veiculo = Veiculo::find($id);
            return response()->json(['err' => 0, 'data' => ['veiculo' => $veiculo]]);
        }catch(Exception $e){
            return response()->json(['err' => 1, 'data' => ['message' => $e->getMessage(), 'code' => $e->getCode()]]);
        }
    }
}
