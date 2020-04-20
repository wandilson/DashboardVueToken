<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Bank;

class BankCtrl extends Controller
{
    /**
     * Lista de Usuários
     */
    public function list()
    {
        $tenant_id = auth()->user()->tenant->id;
        $data = Bank::where('tenant_id',  $tenant_id)->get();

        $arr = [
            'banks' => $data,
            'total_amount'  => number_format($data->sum('amount'), 2, ',', '.')
        ];

        return response()->json($arr);
    }


    /**
     * Cria um novo usuário
     */
    public function create(Request $request)
    {
        // Pega o tenant do usuário logado
        $idUser_idTenant = auth()->user();

        $request->validate([
            'name'  =>  ['required'],
            'amount' =>  ['required']
        ]); 

        $result = Bank::create([
            'tenant_id'     =>   $idUser_idTenant->tenant_id,
            'user_id'       =>   $idUser_idTenant->id,
            'name'          =>   $request->name,
            'amount'        =>   strtr($request->amount, ['.' => '', ',' => '.'])
        ]);

        return response()->json(['response'=>'Registro Criado com Sucesso!'], 201);
    }


    /**
     * Atualiza dados do usuário
     */
    public function update(Request $request)
    {
        // Pega dados do usuário logado
        $idUser_idTenant = auth()->user();


        $arr = [
            'name'          =>   $request->name,
            'amount'        =>   strtr($request->amount, ['.' => '', ',' => '.'])
        ];

        $result = Bank::find($request->id)->update($arr);
        return response()->json(['response'=>'Registro Alterado com Sucesso!'], 201);
    }


    /**
     * Deleta usuárioe todos os registros pertecentes a ele
     */
    public function delete(Request $request, $id)
    {
        $idUser_idTenant = auth()->user();
        
        $restrict = Bank::where('tenant_id', $idUser_idTenant->tenant_id)->where('id', $id)->first();
        //return $restrict;

        if(!isset($restrict)){
            return response()->json(['response'=>'Permissão negada'], 405);
        }

        Bank::find($id)->delete();
            return response()->json(['response'=>'Registro removido'], 200);

        
    }

}
