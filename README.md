# Teste técnico - Fácil consulta

## Sumário

-   Instalação
-   Executando a API
-   Executando testes automatizados

## 🔧 Instalação

### Requisitos

Para instalar e executar a API desenvolvida, será necessário ter instalado em sua máquina:

-   [Docker](https://www.docker.com/get-started/)

-   [Git](https://git-scm.com/)

-   [Postman](https://www.postman.com/)

-   [Composer](https://getcomposer.org/)

Docker é um programa que vai executar a API, sem precisar realizar configurações extras e específicas por parte do usuário.

Git é um programa que vai nos auxiliar no download deste projeto.

Postman é o programa que vai executar requisições desta API.

Composer é o gerenciador de pacotes do PHP para podermos instalar as dependências na máquina local.

#### Clonando o projeto

Vamos começar instalando o projeto na sua máquina, será necessário clonar este projeto na sua máquina local, eu recomendo de preferência instalar na pasta raíz "home" em caso do Linux.

```bash
cd ~
git clone https://github.com/RenatoHiga/teste-tecnico-facil-consulta.git
```

Em seguida vamos instalar as dependências do projeto na pasta raíz

```bash
cd teste-tecnico-facil-consulta
composer install
```

#### Executando o projeto

Após a clonagem do projeto, iremos rodar o projeto via "Sail" que é uma biblioteca do Laravel que usa o Docker para gerenciar e executar os containers.

```bash
cd teste-tecnico-facil-consulta
./vendor/bin/sail up
```

> 💡 DICA: Caso o comando `sail up` não funcione, na maioria dos casos quando ocorre um erro, é porque tem algum programa executando na porta que o docker precisa utilizar. Por exemplo: Na porta 3306, minha máquina estava rodando o serviço de mysql ou rodando um container anterior na porta 3306, então só precisei parar de executar o serviço que estava ocupando a porta em específico.

Com a API rodando via "Sail", vamos rodar as nossas migrações para criar o banco de dados no container do MySQL e popular as tabelas com dados de teste

```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

## 🔁 Executando a API

#### Importando a coleção postman

Com o Sail rodando, junto com as migrações realizadas, agora iremos acessar os endpoints via Postman. Antes de executar os endpoints no postman, precisamos fazer download da coleção e gerar uma API token para acessar os endpoints que são de acesso restrito.

[Download da coleção do postman](https://www.postman.com/nova-versao-fc-teste/teste-facil-consulta/collection/3sgeuqb/pessoa-back-end-plena-laravel?action=share&creator=5226266)

#### Gerando o Token de acesso

Antes de gerar o Token de acesso, iremos alterar a variável {{domínio}} de "http://127.0.0.1/api" para "http://127.0.0.1:80/api", pois nossa aplicação está rodando por padrão na porta 80. Vá na coleção > Edit > Variables > Na coluna "current value", troque o valor de domínio para "http://127.0.0.1:80/api"

![2025-02-05_06-51](https://github.com/user-attachments/assets/b53da0db-6020-4e83-abca-be5df5bf0dfe)

![2025-02-05_06-51_1](https://github.com/user-attachments/assets/753af815-c48f-44d5-8556-7271510f84ee)

Vá até Autenticação > Login > Send, copie o conteúdo do "access_token". Em seguida vá novamente na coleção > Edit > Variables > Cole o valor do token na coluna "current value" da variável "token".

![2025-02-05_06-58](https://github.com/user-attachments/assets/017b8099-aed7-4eb0-a1b0-fe609da47409)

![2025-02-05_06-59](https://github.com/user-attachments/assets/f14239a4-dd1e-43f8-95ea-3182eade3359)

Agora com o Postman configurado, podemos realizar nossas requisições

🌐 - Endpoint aberto para o público
🔒 - Endpoint privado que requere o Token de acesso

## Cidade Endpoints

### 🌐 Listar cidades

GET - /cidades

Filtros:

-   (Opcional) nome

Resultados de exemplo:

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

### 🌐 Listar médicos

GET - /medicos

Filtros:

-   (Opcional) nome

Resultados de exemplo:

```
http://127.0.0.1:80/medicos
[
    {
        "id": 1,
        "nome": "Dr. Renan Fidalgo Domingues",
        "especialidade": "Neurologia",
        "cidade_id": 2,
        "created_at": "2025-02-05T10:21:30.000000Z",
        "updated_at": "2025-02-05T10:21:30.000000Z",
        "deleted_at": null
    },
    {
        "id": 4,
        "nome": "Dra. Alessandra Moura",
        "especialidade": "Neurologista",
        "cidade_id": 1,
        "created_at": "2025-02-05T10:24:33.000000Z",
        "updated_at": "2025-02-05T10:24:33.000000Z",
        "deleted_at": null
    },
    {
        "id": 2,
        "nome": "Juliana Léia Neves Jr.",
        "especialidade": "Dermatologia",
        "cidade_id": 1,
        "created_at": "2025-02-05T10:21:30.000000Z",
        "updated_at": "2025-02-05T10:21:30.000000Z",
        "deleted_at": null
    },
    {
        "id": 3,
        "nome": "Juliane Ortega",
        "especialidade": "Oftalmologia",
        "cidade_id": 3,
        "created_at": "2025-02-05T10:21:30.000000Z",
        "updated_at": "2025-02-05T10:21:30.000000Z",
        "deleted_at": null
    }
]
```

```
// http://127.0.0.1:80/medicos?nome=san
[
    {
        "id": 4,
        "nome": "Dra. Alessandra Moura",
        "especialidade": "Neurologista",
        "cidade_id": 1,
        "created_at": "2025-02-05T10:24:33.000000Z",
        "updated_at": "2025-02-05T10:24:33.000000Z",
        "deleted_at": null
    }
]
```

### 🌐 Listar médicos de uma cidade

GET - /cidades/{{id_cidade}}/medicos

Resultado de exemplo:

```
// http://127.0.0.1:80/cidades/1/medicos
[
    {
        "id": 4,
        "nome": "Dra. Alessandra Moura",
        "especialidade": "Neurologista",
        "cidade_id": 1,
        "created_at": "2025-02-05T10:24:33.000000Z",
        "updated_at": "2025-02-05T10:24:33.000000Z",
        "deleted_at": null
    },
    {
        "id": 2,
        "nome": "Juliana Léia Neves Jr.",
        "especialidade": "Dermatologia",
        "cidade_id": 1,
        "created_at": "2025-02-05T10:21:30.000000Z",
        "updated_at": "2025-02-05T10:21:30.000000Z",
        "deleted_at": null
    }
]
```

### 🔒 Cadastrar médico

POST - /medicos

Campos obrigatórios no body:

-   nome
-   especialidade
-   cidade_id

Resultado de exemplo:

```
// http://127.0.0.1:80/medicos
{
    "nome": "Dra. Alessandra Moura",
    "especialidade": "Neurologista",
    "cidade_id": 1,
    "updated_at": "2025-02-05T10:24:33.000000Z",
    "created_at": "2025-02-05T10:24:33.000000Z",
    "id": 4
}
```

### 🔒 Cadastrar consulta

POST - /medicos/consulta

Campos obrigatórios no body:

-   medico_id
-   paciente_id
-   data (em formato ANO-MÊS-DIA HORA:MINUTOS:SEGUNDOS)

Resultado de exemplo:

```
// http://127.0.0.1:80/medicos/consulta
{
    "nome": "Dra. Alessandra Moura",
    "especialidade": "Neurologista",
    "cidade_id": 1,
    "updated_at": "2025-02-05T10:24:33.000000Z",
    "created_at": "2025-02-05T10:24:33.000000Z",
    "id": 4
}
```

## Paciente Endpoints

### 🔒 Listar pacientes

GET - /medicos/{{id_medico}}/pacientes

Resultado de exemplo:

```
// http://127.0.0.1:80/medicos/1/pacientes
[
    {
        "id": 1,
        "nome": "Luana Rodrigues",
        "cpf": "662.669.840-08",
        "celular": "(11) 9 8484-6363",
        "deleted_at": null,
        "created_at": "2025-02-05T10:21:30.000000Z",
        "updated_at": "2025-02-05T10:21:30.000000Z",
        "consulta": {
            "id": 1,
            "medico_id": 1,
            "paciente_id": 1,
            "data": "2025-02-05 22:21:30.000000",
            "created_at": "2025-02-05 10:21:30.000000",
            "updated_at": "2025-02-05 10:21:30.000000",
            "deleted_at": null
        }
    }
]
```

### 🔒 Cadastrar paciente

POST - /pacientes/{{id_paciente}}

Campos obrigatórios no body:

-   nome
-   cpf
-   celular

Resultado de exemplo:

```
// http://127.0.0.1:80/pacientes
{
    "nome": "Matheus Henrique",
    "cpf": "795.429.941-60",
    "celular": "(11) 9 8432-5789",
    "updated_at": "2025-02-05T10:33:33.000000Z",
    "created_at": "2025-02-05T10:33:33.000000Z",
    "id": 3
}
```

### 🔒 Atualizar paciente

POST - /pacientes/{{id_paciente}}

Campos obrigatórios no body:

-   nome
-   celular

OBS: cpf não é um campo atualizável

Resultado de exemplo:

```
// http://127.0.0.1:80/pacientes/1
{
    "id": 1,
    "nome": "Luana Rodrigues Garcia",
    "cpf": "662.669.840-08",
    "celular": "(11) 98484-6362",
    "deleted_at": null,
    "created_at": "2025-02-05T10:21:30.000000Z",
    "updated_at": "2025-02-05T10:40:59.000000Z"
}
```

## 👷 Executando testes

Para executar os testes feitos em PHP Unit, basta estar no diretório do projeto e rodar o comando abaixo:

```bash
./vendor/bin/sail test
```

No total há 13 testes, nos quais testam as funções dos endpoints como: Geração de token, Cidade, Mèdico, Paciente
