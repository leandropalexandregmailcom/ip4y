Projeto IP4Y
Este projeto é um sistema simples de gerenciamento de formulários usando Laravel, MySQL e Docker. Ele inclui uma API RESTful documentada com Swagger.

Requisitos
Docker (opcional)
PHP 8.3
Composer
Node.js & NPM
MySQL
Configuração e Execução com Docker
Clone o repositório:

Copiar código
git clone git@github.com:leandropalexandregmailcom/ip4y.git
cd ip4y
Configure o arquivo .env:

Copie o arquivo .env.example para .env e ajuste as configurações conforme necessário.

Construa e inicie os containers:

Copiar código
docker-compose up --build -d
Execute as migrações do banco de dados:


Copiar código
docker-compose exec php php artisan migrate
Acesse a aplicação:

Acesse http://localhost:8081 em seu navegador.

Configuração e Execução sem Docker
Clone o repositório:


Copiar código
git clone git@github.com:leandropalexandregmailcom/ip4y.git
cd ip4y
Instale as dependências PHP:


Copiar código
composer install
Instale as dependências Node:


Copiar código
npm install
Compile os assets:


Copiar código
npm run dev
Configure o arquivo .env:

Copie o arquivo .env.example para .env e ajuste as configurações conforme necessário.

Configure o banco de dados:

Certifique-se de ter um banco de dados MySQL rodando e ajuste as configurações no arquivo .env.

Execute as migrações do banco de dados:


Copiar código
php artisan migrate
Inicie o servidor de desenvolvimento:


Copiar código
php artisan serve
Acesse a aplicação:

Acesse http://localhost:8000 em seu navegador.

API Endpoints
Listar Todos os Formulários
URL: /api/forms
Método: GET
Resposta:
json
Copiar código
[
    {
        "id": 1,
        "cpf": "12345678901",
        "nome": "Nome",
        "sobrenome": "Sobrenome",
        "data_nascimento": "2000-01-01",
        "email": "email@example.com",
        "genero": "Masculino",
        "created_at": "2023-07-03T12:00:00.000000Z",
        "updated_at": "2023-07-03T12:00:00.000000Z"
    }
]
Criar Novo Formulário
URL: /api/forms
Método: POST
Dados de Envio:
json
Copiar código
{
    "cpf": "12345678901",
    "nome": "Nome",
    "sobrenome": "Sobrenome",
    "data_nascimento": "2000-01-01",
    "email": "email@example.com",
    "genero": "Masculino"
}
Resposta:
json
Copiar código
{
    "message": "Formulário criado com sucesso!",
    "form": {
        "id": 2,
        "cpf": "12345678901",
        "nome": "Nome",
        "sobrenome": "Sobrenome",
        "data_nascimento": "2000-01-01",
        "email": "email@example.com",
        "genero": "Masculino",
        "created_at": "2023-07-03T12:00:00.000000Z",
        "updated_at": "2023-07-03T12:00:00.000000Z"
    }
}
Atualizar Formulário
URL: /api/forms/{id}
Método: PUT
Dados de Envio:
json
Copiar código
{
    "cpf": "12345678901",
    "nome": "Nome Atualizado",
    "sobrenome": "Sobrenome Atualizado",
    "data_nascimento": "2000-01-01",
    "email": "email@example.com",
    "genero": "Masculino"
}
Resposta:
json
Copiar código
{
    "message": "Formulário atualizado com sucesso!",
    "form": {
        "id": 1,
        "cpf": "12345678901",
        "nome": "Nome Atualizado",
        "sobrenome": "Sobrenome Atualizado",
        "data_nascimento": "2000-01-01",
        "email": "email@example.com",
        "genero": "Masculino",
        "created_at": "2023-07-03T12:00:00.000000Z",
        "updated_at": "2023-07-03T12:00:00.000000Z"
    }
}
Deletar Formulário
URL: /api/forms/{id}
Método: DELETE
Resposta:
json
Copiar código
{
    "message": "Formulário deletado com sucesso!"
}
Documentação da API
A documentação da API é gerada usando Swagger. Para visualizar a documentação:

Gere a documentação do Swagger:


Copiar código
php artisan l5-swagger:generate
Acesse a documentação no navegador:

http://localhost:8081/api/documentation

Contribuição
Sinta-se à vontade para enviar pull requests e relatar problemas. Para grandes mudanças, por favor, abra uma issue primeiro para discutir o que você gostaria de mudar.

Licença
MIT

Este README fornece instruções claras sobre como configurar e executar o projeto, tanto com Docker quanto sem Docker, além de uma descrição dos endpoints da API e como acessar a documentação da API.
