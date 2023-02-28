<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryBuilderPrueba extends Controller
{
    // Query Builder
    public function pruebas ()
    {   
        /**table() es como si empezaramos las clausula FROM users */
        // SELECT * FROM users
        $user = DB::table('users')->get();
        
        // echo'<pre>';
        //  var_dump($user);
        // echo'</pre>';


        // Metodo par obtener un solo registro
        // FROM users WHERE id = '65'
                                    // Donde el name sea = Emanuel
        $userRegistro = DB:: table('users')->where('name', 'Emanuel')->first();
        // dd($userRegistro);


        // Consegui un solo atributo
        $userName = DB:: table('users')->where('id', 65)->value('name');
        // dd($userName);

        //Obtener registro de la tabla
        $userPorId = DB:: table('users')->find(66);
        // dd($userPorId);


        // Obtener Usuarios registrados
        $userName = DB:: table('users')->where('id', 65)->sum('email');

        // echo'<pre>';
        //  var_dump($userName);
        // echo'</pre>';


        // $emails = DB::table('users')->pluck('email', 'name');
        // return view('welcome') -> with('emails', $emails);


        // Evaluar Registros
        // $cantidadDeUsers = DB::table('users')->where('name', 'emanuel')->exists();
        // if ($cantidadDeUsers) {
        //     echo 'Si existen';
        // } else {
        //     echo 'No existen';
        // }

        /**Hacer clausula */
        /**FROM users */
        $data = DB::table('users')->select('email', 'created_at')->get();
        return view('welcome') -> with('data', $data);

        //Añadir una nueva columna 

        // $data = $queryBuilder->addSelect('prenombre');

    }
}
