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
        <form action="/submit" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">CPF</label>
                <input type="text" name="cpf" class="w-full p-2 border border-gray-300 rounded mt-1">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Nome</label>
                <input type="text" name="nome" class="w-full p-2 border border-gray-300 rounded mt-1">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Sobrenome</label>
                <input type="text" name="sobrenome" class="w-full p-2 border border-gray-300 rounded mt-1">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Data de Nascimento</label>
                <input type="date" name="data_nascimento" class="w-full p-2 border border-gray-300 rounded mt-1">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">E-mail</label>
                <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded mt-1">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Gênero</label>
                <input type="text" name="genero" class="w-full p-2 border border-gray-300 rounded mt-1">
            </div>
            <div class="flex justify-between">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Inserir</button>
                <button type="reset" class="bg-gray-500 text-white px-4 py-2 rounded">Recomeçar</button>
            </div>
        </form>
    </div>
</body>
</html>
