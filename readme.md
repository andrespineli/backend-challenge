# < back >Developer</ end >
API REST utilizando o Laravel 5.5 que implementa endpoints de Customers, Products e Orders.

## Arquitetura

Foi escolhida uma arquitetura de componentes monolítica que permite o isolamento das regras de negócio da estrutura do framework. 
Cada componente implementa sua interface e possui seu respectivo Repository para persistência e recuperação de informações. Às implementações concretas do componente e Repository são injetadas automaticamente pelo Service Container do Laravel invertendo a dependência e permitindo que as regras de negócio não possuam conhecimento sobre o framework ou mesmo sobre o banco de dados, torando a aplicação mais flexível e possibilitando a substituição dos componentes se for necessário além de facilitar sua migração para microsserviços caso haja a necessidade de escalar.

## Iniciando

Para executar esta aplicação, clone este repositório e siga as instruções abaixo:

### Requisitos

Ambiente de desenvolvimento utiliza Docker e docker-compose, portanto se faz necesária sua instalação previa.

Possuindo o ambiente configurado basta executar na raiz do projeto em um Terminal/PowerShell o comando:

```
docker-compose up
```

Feito isso os containers necessários para a execução da aplicação irão subir, são eles:

> - challenge-webserver (Servidor web Nginx)
> - challenge-php (PHP v7.2)
> - challenge-mysql (Banco de Dados MySQL 5.7)

O terminal/cmd deverá permanecer aberto durante a execução da aplicação.

Também sendo possível a execução como uma deamon (segundo plano) acrescentando -d ao comando anterior: 

```
docker-compose up -d
```

Devido a utilização do Docker os comandos do Laravel como o "php artisan" deverão ser executados no container challenge-php

### Instalando dependencias

O Laravel gerencia suas dependencias através do Composer
As dependencias do projeto devem ser instaladas através do comando:

```
docker exec -it challenge-php composer install
```

### Executando as Migrations

Migrations são responsáveis pela criação da base de dados:

```
docker exec -it challenge-php php artisan migrate
```

Atualizando as migrations:

```
docker exec -it challenge-php php artisan migrate:refresh
```

### Executando os testes

Foram implementados testes unitários e de integração (Rotas da API).
Para executar a suite de testes basta utilizar o PHPUnit:

```
docker exec -it challenge-php php vendor/bin/phpunit
```

### Populando o Banco de Dados

Seeds permitem a inserção de dados para facilitar o desenvolvimento e testes:

```
docker exec -it challenge-php php artisan db:seed
```

## Endpoints
Recursos disponíveis na API. 
Necessário o envio do Header: 

```
Accept: application/json
```

### Campos obrigatórios
Para saber quais dados são necessários enviar para cada endpoint, basta realizar uma requisição que a API deverá retornar um erro informando quais campos são obrigatórios e validar seus respectivos tipos.

### Autenticação
Algumas rotas são públicas, outras necessitam de autenticação. Ao cadastrar um Customer ou realizar login a API retornará um token de que deverá ser incluido no header das requisições:

```
Authoriztion: Bearer seuTokenDeAutenticacaoAqui
```

### Auth

Realizar login (pública):
> - POST: /api/v1/login
```json
{
    "email": "seuemail@email.com",
    "password: "suasenha"
}
```

### Customer

Listar todos os customers cadastrados (autenticada):
> - GET: /api/v1/customers

Cadastrar um novo customer (pública)
> - POST: /api/v1/customers
```json
{
    "name": "Seu nome",
    "cpf": "00000000000",
    "email": "seuemail@email.com",
    "password: "suasenha"
}
```

### Products

Listar todos os products cadastrados (pública):
> - GET: /api/v1/products

Cadastrar um novo product (autenticada)
> - POST: /api/v1/products
```json
{
    "sku": "8552515751438644",
    "name": "Casaco Jaqueta Outletdri Inverno Jacquard",
    "price": "109.90"
}
```

### Orders

Listar todos os orders realizados (autenticada):
> - GET: /api/v1/orders

Realizar um novo order (autenticada)
> - POST: /api/v1/orders

O endpoint de pedidos aceita uma lista de "items" que deverá conter a estrutura abaixo.
Utilizando o Postman deverá ser enviado como "raw" do tipo JSON(application/json).
```json
{
    "items": [
        {
            "sku": "8552515751438644",
            "amount": 1
        },
        {
            "sku": "8552515751438645",
            "amount": 2
            
        }
    ]
}
```

Cancelar um order específico (autenticada)
> - PUT: /api/v1/orders/{order_id}

