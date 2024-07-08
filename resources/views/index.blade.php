<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros</title>
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
    <style>
        .table-container {
            background-color: #f5f5f5;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 1000px;
            margin: 2rem auto;
        }
        .btn-green {
            background-color: #2d6a4f;
        }
        .btn-gray {
            background-color: #495057;
        }
        .btn-blue {
            background-color: #1b4332;
        }
        .btn-red {
            background-color: #e63946;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 10;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-gray-100 p-6">
    <div class="table-container">
        <h1 class="text-2xl font-bold mb-6 text-center text-gray-700">Registros</h1>
        @if ($errors->any())
            <div class="alert-error bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert-success bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="mb-4 text-center">
            <button onclick="openCreateModal()" class="btn-blue text-white px-4 py-2 rounded inline-block">Criar Novo Registro</button>
        </div>
        <table class="min-w-full bg-white">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="w-1/6 px-4 py-2">CPF</th>
                    <th class="w-1/6 px-4 py-2">Nome</th>
                    <th class="w-1/6 px-4 py-2">Sobrenome</th>
                    <th class="w-1/6 px-4 py-2">Data de Nascimento</th>
                    <th class="w-1/6 px-4 py-2">E-mail</th>
                    <th class="w-1/6 px-4 py-2">Gênero</th>
                    <th class="w-1/6 px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($forms as $form)
                <tr>
                    <td class="px-4 py-2 border">{{ $form->cpf }}</td>
                    <td class="px-4 py-2 border">{{ $form->nome }}</td>
                    <td class="px-4 py-2 border">{{ $form->sobrenome }}</td>
                    <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($form->data_nascimento)->format('d/m/Y') }}</td>
                    <td class="px-4 py-2 border">{{ $form->email }}</td>
                    <td class="px-4 py-2 border">{{ $form->genero }}</td>
                    <td class="px-4 py-2 border flex justify-center">
                        <button class="btn-green text-white px-4 py-2 rounded mr-2" onclick="openEditModal({{ $form->id }})">Editar</button>
                        <form action="{{ route('forms.destroy', $form->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-red text-white px-4 py-2 rounded">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Create Modal -->
    <div id="createModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeCreateModal()">&times;</span>
            <h2 class="text-2xl font-bold mb-4">Criar Registro</h2>
            <form method="POST" action="{{ route('forms.store') }}" id="createForm">
                @csrf
                <div class="mb-4">
                    <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                    <input type="text" name="cpf" id="cpf" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                    <input type="text" name="nome" id="nome" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="sobrenome" class="block text-sm font-medium text-gray-700">Sobrenome</label>
                    <input type="text" name="sobrenome" id="sobrenome" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" id="data_nascimento" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                    <input type="email" name="email" id="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="genero" class="block text-sm font-medium text-gray-700">Gênero</label>
                    <select name="genero" id="genero" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                        <option value="Outros">Outros</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="btn-green text-white px-4 py-2 rounded mr-2">Salvar</button>
                    <button type="button" class="btn-gray text-white px-4 py-2 rounded" onclick="closeCreateModal()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h2 class="text-2xl font-bold mb-4">Editar Registro</h2>
            <form method="POST" action="" id="editForm">
                @csrf
                <input type="hidden" name="id" id="edit-id">
                <div class="mb-4">
                    <label for="edit-cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                    <input type="text" name="cpf" id="edit-cpf" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="edit-nome" class="block text-sm font-medium text-gray-700">Nome</label>
                    <input type="text" name="nome" id="edit-nome" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="edit-sobrenome" class="block text-sm font-medium text-gray-700">Sobrenome</label>
                    <input type="text" name="sobrenome" id="edit-sobrenome" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="edit-data_nascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" id="edit-data_nascimento" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="edit-email" class="block text-sm font-medium text-gray-700">E-mail</label>
                    <input type="email" name="email" id="edit-email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="edit-genero" class="block text-sm font-medium text-gray-700">Gênero</label>
                    <select name="genero" id="edit-genero" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                        <option value="Outros">Outros</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="btn-green text-white px-4 py-2 rounded mr-2">Salvar</button>
                    <button type="button" class="btn-gray text-white px-4 py-2 rounded" onclick="closeEditModal()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openCreateModal() {
            document.getElementById('createModal').style.display = "block";
        }

        function closeCreateModal() {
            document.getElementById('createModal').style.display = "none";
        }

        function openEditModal(id) {
            fetch(`/api/forms/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit-id').value = data.id;
                    document.getElementById('edit-cpf').value = data.cpf;
                    document.getElementById('edit-nome').value = data.nome;
                    document.getElementById('edit-sobrenome').value = data.sobrenome;
                    document.getElementById('edit-data_nascimento').value = data.data_nascimento;
                    document.getElementById('edit-email').value = data.email;
                    document.getElementById('edit-genero').value = data.genero;
                    document.getElementById('editForm').action = `/update/${data.id}`;
                    document.getElementById('editModal').style.display = "block";
                });
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = "none";
        }
    </script>
</body>
</html>
