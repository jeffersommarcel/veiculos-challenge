## Installation

Abra a pasta do projeoto
```
cd veiculos-challenge-main

```

Instale todas as dependências do composer

```
composer install

```
Crie uma database com o nome "veiculoschallenge"

Execute as migrações do banco de dados (defina a conexão do banco de dados em .env antes de migrar)

```
php artisan migrate

```

Execute o comando para popular o banco de dados com informações aleatórias

```
php artisan db:seed --class=VeiculosSeeder

```

Execute o comando para obter todas as dependências node

```
npm install

```

Execute o comando para iniciar development server do NPM
```
npm run dev

```

Execute o comando para iniciar development server do Laravel

```
php artisan serve

```

