<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\Tenant;
use App\mail\Register;

class RegisterCtrl extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'cpf'  =>  ['required', 'numeric'],
            'name'  =>  ['required'],
            'email' =>  ['required', 'email', 'unique:users'],
            'password'  =>  ['required', 'min:8', 'confirmed']
        ]);


        $tenant = Tenant::create([
            'name'  =>  $request->name
        ]);

        
        $user = User::create([
            'tenant_id'  =>  $tenant['id'],
            'type'      =>  1,
            'cpf'       =>  $request->cpf,
            'name'       =>  $request->name,
            'email'      =>  $request->email,
            'password'   =>  Hash::make($request->password)
        ]);

        

        /**
         * Ao se registrar efetuar login automatico
         */
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

        Mail::to($request->email)->send(new Register());

        return $return;
    }
}
