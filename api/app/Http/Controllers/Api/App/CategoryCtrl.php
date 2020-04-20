<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

class CategoryCtrl extends Controller
{
    /**
     * Lista de Categorias
     */
    public function list()
    {
        $tenant_id = auth()->user()->tenant->id;
        $despesas = Category::where('tenant_id',  $tenant_id)->where('type', 'D')->get();
        $receitas = Category::where('tenant_id',  $tenant_id)->where('type', 'R')->get();

        $arr = [
            'despesas'  => $despesas,
            'receitas'  => $receitas
        ];

        return response()->json($arr);
    }


    /**
     * Cria uma nova categoria
     */
    public function create(Request $request)
    {
        // Pega o tenant do usuário logado
        $idUser_idTenant = auth()->user();

        $request->validate([
            'name'  =>  ['required'],
            'type' =>  ['required']
        ]); 

        $result = Category::create([
            'tenant_id'     =>   $idUser_idTenant->tenant_id,
            'name'          =>   $request->name,
            'type'          =>   $request->type
        ]);

        return response()->json(['response'=>'Registro Criado com Sucesso!'], 201);
    }


    /**
     * Atualiza dados da categoria
     */
    public function update(Request $request)
    {
        $idUser_idTenant = auth()->user();
        
        $restrict = Category::where('tenant_id', $idUser_idTenant->tenant_id)->where('id', $request->id)->first();
        //return $restrict;

        if(!isset($restrict)){
            return response()->json(['response'=>'Permissão negada'], 405);
        }


        $result = Category::find($request->id)->update($request->all());
        return response()->json(['response'=>'Registro Alterado com Sucesso!'], 201);
    }


    /**
     * Deleta categoria
     * Isso não deleta o registro em receita/despesas
     */
    public function delete(Request $request, $id)
    {
        $idUser_idTenant = auth()->user();
        
        $restrict = Category::where('tenant_id', $idUser_idTenant->tenant_id)->where('id', $id)->first();
        //return $restrict;

        if(!isset($restrict)){
            return response()->json(['response'=>'Permissão negada'], 405);
        }

        Category::find($id)->delete();
            return response()->json(['response'=>'Registro removido'], 200);

        
    }
}
