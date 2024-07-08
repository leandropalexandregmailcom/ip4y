@extends('layouts.app')

@section('content')
    <h1>{{ isset($user) ? 'Edit User' : 'Add User' }}</h1>
    <form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST">
        @csrf
        @if(isset($user))
            @method('PUT')
        @endif
        <div>
            <label>CPF:</label>
            <input type="text" name="cpf" value="{{ isset($user) ? $user->cpf : '' }}" required>
        </div>
        <div>
            <label>Nome:</label>
            <input type="text" name="nome" value="{{ isset($user) ? $user->nome : '' }}" required>
        </div>
        <div>
            <label>Sobrenome:</label>
            <input type="text" name="sobrenome" value="{{ isset($user) ? $user->sobrenome : '' }}" required>
        </div>
        <div>
            <label>Data de Nascimento:</label>
            <input type="date" name="data_nascimento" value="{{ isset($user) ? $user->data_nascimento : '' }}" required>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ isset($user) ? $user->email : '' }}" required>
        </div>
        <div>
            <label>Gênero:</label>
            <input type="text" name="genero" value="{{ isset($user) ? $user->genero : '' }}" required>
        </div>
        <button type="submit">{{ isset($user) ? 'Update' : 'Insert' }}</button>
        <button type="reset">Recomeçar</button>
    </form>
@endsection
