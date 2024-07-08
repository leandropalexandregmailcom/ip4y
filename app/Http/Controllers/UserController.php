<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cpf' => ['required', new Cpf, 'unique:forms'],
            'nome' => 'required',
            'sobrenome' => 'required',
            'data_nascimento' => 'required|date',
            'email' => 'required|email|unique:users',
            'genero' => 'required',
        ]);

        User::create($request->all());

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'cpf' => ['required', new Cpf, 'unique:forms,cpf,'.$form->id],
            'nome' => 'required',
            'sobrenome' => 'required',
            'data_nascimento' => 'required|date',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'genero' => 'required',
        ]);

        $user->update($request->all());

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }

    public function send()
    {
        $users = User::all();
        $response = Http::post('https://api-teste.ip4y.com.br/cadastro', $users->toJson());

        return redirect()->route('users.index')->with('status', 'Dados enviados com sucesso!');
    }
}
