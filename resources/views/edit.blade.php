<!-- resources/views/edit.blade.php -->
<div x-show="showEditModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" x-cloak>
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg mx-4">
        <h2 class="text-2xl font-bold mb-4 text-green-700">Editar Registro</h2>
        <form :action="'/update/' + formId" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">CPF</label>
                <input type="text" name="cpf" class="w-full p-2 border rounded" x-model="formCpf" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Nome</label>
                <input type="text" name="nome" class="w-full p-2 border rounded" x-model="formNome" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Sobrenome</label>
                <input type="text" name="sobrenome" class="w-full p-2 border rounded" x-model="formSobrenome" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Data de Nascimento</label>
                <input type="date" name="data_nascimento" class="w-full p-2 border rounded" x-model="formDataNascimento" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" class="w-full p-2 border rounded" x-model="formEmail" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Gênero</label>
                <input type="text" name="genero" class="w-full p-2 border rounded" x-model="formGenero" required>
            </div>
            <div class="flex justify-end">
                <button type="button" @click="closeEditModal()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancelar</button>
                <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded">Salvar</button>
            </div>
        </form>
    </div>
</div>
