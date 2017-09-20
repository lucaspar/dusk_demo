Demonstração do Laravel Dusk
===
Aplicação web simples para demonstração do Laravel Dusk

---

> As classes PHP de testes estão em `tests/Browser/`

## Pré-requisitos

- MySQL
- PHP >= 7.0
- Composer
- Laravel

## Execução da aplicação

1. Executar os comandos SQL do arquivo `init.sql` pra criar o banco de dados;

2. Definir variáveis de ambiente:

    `cp .env.example .env`

3. Instalar dependências do projeto:

    `composer update`

4. Gerar as tabelas do banco de dados:

    `php artisan migrate`

5. Gerar chave do web app:

    `php artisan key:generate`

6. Servir aplicação (acessar em `localhost:8000`)

    `php artisan serve &`


## Execução dos testes

> É preciso ter executado a aplicação com os passos acima.

1. Preparar Dusk:

    `php artisan dusk:install`

2. Executar testes:

    `php artisan dusk`

    OU executar um teste específico:

    `php artisan dusk tests/Browser/ExampleTest.php`
