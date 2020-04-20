<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\UserFormRequest;

use App\Models\User;

class UserCtrl extends Controller
{
    /**
     * Lista de Usuários
     */
    public function list()
    {
        $tenant_id = auth()->user()->tenant->id;
        $data = User::where('tenant_id',  $tenant_id)->get();

        return response()->json($data);
    }



    /**
     * Cria um novo usuário
     */
    public function create(Request $request)
    {
        // Pega o tenant do usuário logado
        $tenant_id = auth()->user()->tenant->id;

        // Grava em data dados do request
        $data = $request->all();

        $request->validate([
            'cpf'  =>  ['required', 'numeric', 'unique:users'],
            'name'  =>  ['required'],
            'email' =>  ['required', 'email', 'unique:users'],
            'password'  =>  ['required', 'min:8', 'confirmed']
        ]);

        $result = User::create([
            'tenant_id' =>   $tenant_id,
            'cpf'       =>   $request->cpf,
            'name'       =>  $request->name,
            'email'      =>  $request->email,
            'password'   =>  Hash::make($request->password)
        ]);

        return response()->json(['response'=>'Registro Criado com Sucesso!'], 201);
    }



    /**
     * Atualiza dados do usuário
     */
    public function update(UserFormRequest $request)
    {
        $tenant_id = auth()->user()->tenant->id;
        $data = $request->all();

        if(isset($data['password']))
        {
            $request->validate([
                'password'  =>  ['required', 'min:8', 'confirmed']
            ]);

            $data['password'] = Hash::make($data['password']);
        }
        
        $result = User::find($request->id)->update($data);
        return response()->json(['response'=>'Registro Alterado com Sucesso!'], 201);
    }



    /**
     * Habilita/Desabilita usuário
     * 0 = Desabilitado / 1 = Habilitado
     */
    public function disable(Request $request)
    {
        $id_user = $request->id;
        $verfy = User::Where('id', $id_user)->first();
        
        if($verfy->stats == 0){
            $result = User::find($id_user)->update(['stats' => 1]);
        }else{
            $result = User::find($id_user)->update(['stats' => 0]);
        }

        return response()->json(['response'=>'Status do usuário alterado com Sucesso!'], 201);
    }



    /**
     * Deleta usuárioe todos os registros pertecentes a ele
     */
    public function delete($id)
    {
        $result = User::find($id)->delete();
        return response()->json(['response'=>'Status do usuário alterado com Sucesso!'], 204);
    }

}
