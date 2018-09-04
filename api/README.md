# Como instalar o back do CartoLoL em sua máquina

> Backend do CartoLoL

## Configure o arquivo .env

O arquivo .env deve ser criado na raiz do projeto, use o .env.example como exemplo.
Atributos essenciais para o funcionamento da API: DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD.

OBS: Você deve criar um banco de dados manualmente em seu computador e inserir o nome de seu banco no atributo DB_DATABASE.

## Abra o terminal e digite os comandos a seguir

``` bash
# Instale as dependências
composer install

# Gere uma APP KEY
php artisan key:generate

# Migre as entidades primordiais para seu banco de dados
php artisan migrate --path=/database/migrations/primeiras

# Migre todas as entidades para seu banco de dados
php artisan migrate

# Rode os seeders que alimentarão o banco com dados essenciais para o funcionamento dos testes de usuário
php artisan db:seed

# Ligue o servidor
php artisan serve


