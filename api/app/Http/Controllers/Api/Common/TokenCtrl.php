<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class TokenCtrl extends Controller
{
    public function userAuth(Request $request)
    {
        $return = [
            'user' => $request->user()
        ];
        return $request->user();
    }



    public function listTokens(Request $request)
    {
        $return = [
            'token' => $request->user()->tokens()->get()
        ];
    
        return $return;
    }



    public function remove($id)
    {
       $result = Auth::user()->tokens()->where('id', $id)->delete();

       if($result == 0)
       {
            return response()->json(['response'=>'Não foi possivel remover esse token'], 201);
       }
       return response()->json(['response'=>'Token removido com sucesso'], 201);
    }
}
