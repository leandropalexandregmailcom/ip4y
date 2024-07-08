<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Rules\Cpf;
use Illuminate\Support\Facades\Http;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::all();
        return view('index', compact('forms'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cpf' => ['required', 'unique:forms,cpf', new Cpf],
            'nome' => 'required|string|max:255',
            'sobrenome' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'email' => 'required|email|max:255',
            'genero' => 'required|string|max:50',
        ]);

        Form::create($validatedData);

        return redirect()->route('index')->with('success', 'Formulário enviado com sucesso!');
    }

    public function edit($id)
    {
        $form = Form::findOrFail($id);
        return response()->json($form);
    }

    public function update(Request $request, $id)
    {
        $form = Form::findOrFail($id);

        $validatedData = $request->validate([
            'cpf' => ['required', 'unique:forms,cpf,'.$id, new Cpf],
            'nome' => 'required|string|max:255',
            'sobrenome' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'email' => 'required|email|max:255',
            'genero' => 'required|string|max:50',
        ]);

        $form->update($validatedData);

        return redirect()->route('index')->with('success', 'Informações atualizadas com sucesso!');
    }

    public function destroy($id)
    {
        $form = Form::findOrFail($id);
        $form->delete();

        return redirect()->route('index')->with('success', 'Registro excluído com sucesso!');
    }
}
