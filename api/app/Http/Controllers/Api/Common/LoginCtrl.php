<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\models\User;

class LoginCtrl extends Controller
{
    public function index(){
        return response()->json(['response'=>'Você não está autenticado'], 405);
    }

    public function login(Request $request)
    {

        $request->validate([
            'cpf' => 'required',
            'password' => 'required',
            'device_name' => 'required'
        ]);
        
        $user = User::where('cpf', $request->cpf)->first();

        // Verifica se o usuário esta ativo
        if($user->stats == 0){
            return response()->json(['stats'=> ['O usuário foi desativado, para mais informações entre em contato conosco!']], 401); 
        }


    
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'info' => ['The provided credentials are incorrect.'],
            ]);
        }
        
        $token = $user->createToken($request->device_name)->plainTextToken;

        $return = [
            'user'  => $user,
            'token' => $token
        ];

        return $return;
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['response'=>'Usuário deslogado com sucesso'], 201);
    }
}
