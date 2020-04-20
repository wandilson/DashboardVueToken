<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class RedefinePassword extends Mailable
{
    use Queueable, SerializesModels;

    public $user;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
	{
        // Caracteres de cada tipo
        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $num = '1234567890';
        $simb = '!@#$%*-';
        
        // Variáveis internas
        $retorno = '';
        $caracteres = '';
        
        // Agrupamos todos os caracteres que poderão ser utilizados
        $caracteres .= $lmin;
        if ($maiusculas) $caracteres .= $lmai;
        if ($numeros) $caracteres .= $num;
        if ($simbolos) $caracteres .= $simb;
        
        // Calculamos o total de caracteres possíveis
        $len = strlen($caracteres);
        
        for ($n = 1; $n <= $tamanho; $n++) {
            // Criamos um número aleatório de 1 até $len para pegar um dos caracteres
            $rand = mt_rand(1, $len);
            // Concatenamos um dos caracteres na variável $retorno
            $retorno .= $caracteres[$rand-1];
        }
        
        return $retorno;
	}

    public function build()
    {
        $rand = $this->geraSenha(10);
        $pass = Hash::make($rand);
        $result = User::find($this->user->id)->update(
            ['password'  =>  $pass]
        );

        return  $this
            ->view('emails.redefine-pass')
            ->with(['pass' => $rand])
            ->subject('Redefinição de Senha');
    }
}
