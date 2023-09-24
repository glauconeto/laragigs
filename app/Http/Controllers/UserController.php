<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{    
    /**
     * Mostra o formulário de registro de usuários.
     *
     * @return void
     */
    public function create()
    {
        return view('users.register');
    }
}
