<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-xl font-bold mb-4">Formulário</h1>
        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form method="POST" action="{{ route('forms.store') }}" id="form">
            @csrf
            <div class="mb-4">
                <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                <input type="text" name="cpf" id="cpf" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('cpf') }}" required>
                <p id="cpf-error" class="text-red-500 text-xs mt-1 hidden">CPF inválido</p>
            </div>
            <div class="mb-4">
                <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                <input type="text" name="nome" id="nome" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('nome') }}" required>
            </div>
            <div class="mb-4">
                <label for="sobrenome" class="block text-sm font-medium text-gray-700">Sobrenome</label>
                <input type="text" name="sobrenome" id="sobrenome" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('sobrenome') }}" required>
            </div>
            <div class="mb-4">
                <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                <input type="date" name="data_nascimento" id="data_nascimento" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('data_nascimento') }}" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('email') }}" required>
            </div>
            <div class="mb-4">
                <label for="genero" class="block text-sm font-medium text-gray-700">Gênero</label>
                <select name="genero" id="genero" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="" disabled {{ old('genero') == '' ? 'selected' : '' }}>Selecione o Gênero</option>
                    <option value="Masculino" {{ old('genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="Feminino" {{ old('genero') == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                    <option value="Outros" {{ old('genero') == 'Outros' ? 'selected' : '' }}>Outros</option>
                </select>
            </div>
            <div class="flex justify-between">
                <button type="submit" class="btn-green text-white px-4 py-2 rounded">Inserir</button>
                <button type="reset" class="btn-gray text-white px-4 py-2 rounded">Recomeçar</button>
            </div>
        </form>
        <div class="mt-4">
            <a href="{{ route('forms.index') }}" class="text-blue-600 hover:underline">Ver Registros</a>
        </div>
    </div>

    <script>
        document.getElementById('cpf').addEventListener('input', function() {
            const cpf = this.value.replace(/\D/g, '');
            if (cpf.length === 11 && validateCpf(cpf)) {
                document.getElementById('cpf-error').classList.add('hidden');
            } else {
                document.getElementById('cpf-error').classList.remove('hidden');
            }
        });

        function validateCpf(cpf) {
            if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) {
                return false;
            }
            let sum = 0, rest;
            for (let i = 1; i <= 9; i++) sum += parseInt(cpf.substring(i - 1, i)) * (11 - i);
            rest = (sum * 10) % 11;
            if (rest === 10 || rest === 11) rest = 0;
            if (rest !== parseInt(cpf.substring(9, 10))) return false;
            sum = 0;
            for (let i = 1; i <= 10; i++) sum += parseInt(cpf.substring(i - 1, i)) * (12 - i);
            rest = (sum * 10) % 11;
            if (rest === 10 || rest === 11) rest = 0;
            if (rest !== parseInt(cpf.substring(10, 11))) return false;
            return true;
        }
    </script>
</body>
</html>
