<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
    
    /**
     * Valida os campos do formulário e cria hash de senha;
     * Armazena o usuário e loga ele automaticamente.
     *
     * @param  Request $request
     * @return redirect
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        // Cria hash da senha
        $formFields['password'] = bcrypt($formFields['password']);

        // Cria o usuário
        $user = User::create($formFields);

        // Login do usuário
        auth()->login($user);

        return redirect('/')->with('message', 'User Created and logged in');
    }
    
    /**
     * Apenas realiza o logout do usuário logado.
     *
     * @param  Request $request
     * @return redirect
     */
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }
    
    /**
     * Mostra o formulário de login.
     *
     * @return view
     */
    public function login()
    {
        return view('users.login');
    }

    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    public function manage()
    {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
