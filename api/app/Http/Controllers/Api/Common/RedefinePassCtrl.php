<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\mail\RedefinePassword;

class RedefinePassCtrl extends Controller
{
    /**
     * Verifica se o usuário esta ativo
     * Se ativo, envia nova senha por e-mail
     * Se inativo, informa que o usuário esta inativo e não pode alterar a senha, entre em contato com o adm do sistema.
     */

    public function redefine(Request $request){
        
        $data = $request->all();

        $stats = User::where('email', $data['email'])->first();
        
        //return $stats;

        if($stats->stats == 1)
        {

            Mail::to('wandilson.oliver@gmail.com')->send(new RedefinePassword($stats));
            
        }else{
            return response()->json(['response'=>'Usuário inativo, não pode ser alterado!'], 201);
        }

    }
}
