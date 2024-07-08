@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4 text-green-700">Formulário</h1>
        <form @submit.prevent="submitForm">
            <div class="mb-4">
                <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                <input type="text" v-model="formCpf" id="cpf" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                <p v-if="cpfError" class="text-red-500 text-xs mt-1">CPF inválido</p>
            </div>
            <div class="mb-4">
                <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                <input type="text" v-model="formNome" id="nome" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="sobrenome" class="block text-sm font-medium text-gray-700">Sobrenome</label>
                <input type="text" v-model="formSobrenome" id="sobrenome" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                <input type="date" v-model="formDataNascimento" id="data_nascimento" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                <input type="email" v-model="formEmail" id="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="genero" class="block text-sm font-medium text-gray-700">Gênero</label>
                <select v-model="formGenero" id="genero" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="" disabled>Selecione o Gênero</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                    <option value="Outros">Outros</option>
                </select>
            </div>
            <div class="flex justify-between">
                <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded">Inserir</button>
                <button type="button" @click="resetForm" class="bg-gray-500 text-white px-4 py-2 rounded">Recomeçar</button>
            </div>
        </form>
        <a href="{{ route('records') }}" class="block mt-4 text-center bg-blue-500 text-white px-4 py-2 rounded">Ver Registros</a>
    </div>
@endsection

<script>
    export default {
        data() {
            return {
                formCpf: '',
                formNome: '',
                formSobrenome: '',
                formDataNascimento: '',
                formEmail: '',
                formGenero: '',
                cpfError: false
            }
        },
        methods: {
            validateCpf() {
                const cpf = this.formCpf.replace(/\D/g, '');
                if (cpf.length !== 11) {
                    this.cpfError = true;
                    return false;
                }
                let sum = 0;
                let rest;
                if (cpf === "00000000000") {
                    this.cpfError = true;
                    return false;
                }
                for (let i = 1; i <= 9; i++) sum += parseInt(cpf.substring(i - 1, i)) * (11 - i);
                rest = (sum * 10) % 11;
                if (rest === 10 || rest === 11) rest = 0;
                if (rest !== parseInt(cpf.substring(9, 10))) {
                    this.cpfError = true;
                    return false;
                }
                sum = 0;
                for (let i = 1; i <= 10; i++) sum += parseInt(cpf.substring(i - 1, i)) * (12 - i);
                rest = (sum * 10) % 11;
                if (rest === 10 || rest === 11) rest = 0;
                if (rest !== parseInt(cpf.substring(10, 11))) {
                    this.cpfError = true;
                    return false;
                }
                this.cpfError = false;
                return true;
            },
            submitForm() {
                if (!this.validateCpf()) return;
                this.resetForm();
            },
            resetForm() {
                this.formCpf = '';
                this.formNome = '';
                this.formSobrenome = '';
                this.formDataNascimento = '';
                this.formEmail = '';
                this.formGenero = '';
                this.cpfError = false;
            }
        }
    }
</script>
