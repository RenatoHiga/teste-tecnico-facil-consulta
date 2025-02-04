# Teste técnico - Fácil consulta

## Sumário

-   Instalação
-   Executando a API
-   Executando testes automatizados

## Instalação

### Requisitos

Para instalar e executar a API desenvolvida, será necessário ter instalado em sua máquina:

-   [Docker](https://www.docker.com/get-started/)

-   [Git](https://git-scm.com/)

-   [Postman](https://www.postman.com/)

-   [Composer](https://getcomposer.org/)

Composer é o gerenciador de pacotes do PHP para podermos instalar as dependências na máquina local.

Docker é um programa que vai conseguir executar a API, sem precisar realizar configurações extras e específicas.

Git é um programa que vai nos auxiliar no download deste projeto.

Postman é o programa que vai nos habilitar executar requisições desta API.

#### Clonando o projeto

Vamos começar instalando o projeto na sua máquina, será necessário clonar este projeto na sua máquina local, eu recomendo de preferência instale na pasta raíz "home" em caso do Linux.

```bash
cd ~
git clone ...
```

Em seguida vamos instalar as dependências do projeto na pasta raíz

```
cd teste-tecnico-facil-consulta
composer install
```

#### Executando o projeto

Após a clonagem do projeto, iremos rodar o projeto via "Sail" que é uma biblioteca do Laravel que usa o Docker para gerenciar e executar os containers.

```
cd teste-tecnico-facil-consulta
./vendor/bin/sail up
```

> DICA: Caso o comando `sail up` não funcione, na maioria dos casos quando ocorre um erro, é porque tem algum programa executando na porta que o docker precisa utilizar. Por exemplo: Na porta 3306, minha máquina estava rodando o serviço de mysql ou rodando um container anterior na porta 3306, então só precisei parar de executar o serviço que estava ocupando a porta em específico.

Com a API rodando via "Sail", vamos rodar as nossas migrações para criar o banco de dados no container do MySQL e popular as tabelas com dados de teste

```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

## Executando a API

#### Importando a coleção postman

Com o Sail rodando, junto com as migrações realizadas, agora iremos acessar os endpoints via Postman. Antes de executar os endpoints no postman, precisamos fazer download da coleção e gerar uma API token para acessar os endpoints que são de acesso restrito.

[Download da coleção do postman](https://www.postman.com/nova-versao-fc-teste/teste-facil-consulta/collection/3sgeuqb/pessoa-back-end-plena-laravel?action=share&creator=5226266)

#### Gerando o Token de acesso

Vá até Autenticação > Login, copie o conteúdo do "access_token". Em seguida vá na coleção > Editar > Cole o valor do token na coluna "current value" da variável "token".

Na mesma janela de edição de variáveis da coleção, vamos trocar de "http://127.0.0.1/api" para "http://127.0.0.1:80/api", porque nossa aplicação está rodando na porta 80.

Agora com o Postman configurado, podemos realizar nossas requisições

## Cidade Endpoints

### Listar cidades

GET - /cidades

Filtros:

-   (Opcional) nome

```
// http://127.0.0.1:80/cidades
[
    {
        "id": 3,
        "nome": "Curitiba",
        "estado": "PR",
        "created_at": "2025-02-04T20:30:14.000000Z",
        "updated_at": "2025-02-04T20:30:14.000000Z",
        "deleted_at": null
    },
    {
        "id": 1,
        "nome": "Pelotas",
        "estado": "RS",
        "created_at": "2025-02-04T20:30:14.000000Z",
        "updated_at": "2025-02-04T20:30:14.000000Z",
        "deleted_at": null
    },
    {
        "id": 2,
        "nome": "São Paulo",
        "estado": "SP",
        "created_at": "2025-02-04T20:30:14.000000Z",
        "updated_at": "2025-02-04T20:30:14.000000Z",
        "deleted_at": null
    }
]
```

```
// http://127.0.0.1:80/cidades?nome=sao
[
    {
        "id": 2,
        "nome": "São Paulo",
        "estado": "SP",
        "created_at": "2025-02-04T20:30:14.000000Z",
        "updated_at": "2025-02-04T20:30:14.000000Z",
        "deleted_at": null
    }
]
```

## Médico Endpoints

### Listar médicos

GET - /medicos

Filtros:

-   (Opcional) nome

### Listar médicos de uma cidade

GET - /cidades/{{id_cidade}}/medicos

### Cadastrar médico

POST - /medicos

Campos obrigatórios no body:

-   nome
-   especialidade
-   cidade_id

### Cadastrar consulta

POST - /medicos/consulta

Campos obrigatórios no body:

-   medico_id
-   paciente_id
-   data

## Paciente Endpoints

### Listar pacientes

GET - /medicos/{{id_medico}}/pacientes

### Cadastrar paciente

POST - /pacientes/{{id_paciente}}

Campos obrigatórios no body:

-   nome
-   cpf
-   celular

### Atualizar paciente

POST - /pacientes/{{id_paciente}}

Campos obrigatórios no body:

-   nome
-   celular

OBS: cpf não é um campo atualizável
