# Desafio iRede

Este repositório contém a aplicação desenvolvida para o desafio da iRede.

## Como Configurar o Projeto

Siga as instruções abaixo para configurar o projeto localmente.

### 1. Clone o repositório

```bash
git clone https://github.com/heningtonfrota/desafio_irede.git
```

### 2. Navegue até o diretório do projeto
```bash
cd desafio_irede
```

### 3. Inicie os containers Docker

```bash
docker compose up -d
```

### 4. Acesse o container PHP

```bash
docker compose exec php bash
```

### 5. Instale as dependências do PHP

Dentro do container PHP, execute:

```bash
composer install
```

6. Configure o arquivo de ambiente
Ainda dentro do container PHP, crie o arquivo .env:

```bash
cp .env.example .env
```

### 7. Configure as variáveis de ambiente

Abra o arquivo `.env` que foi criado e altere as configurações do banco de dados para as seguintes:

```dotenv
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=desafio_irede
DB_USERNAME=desafio_irede
DB_PASSWORD=secret
```

### 8. Gere a chave da aplicação Laravel

Ainda dentro do container PHP, execute o seguinte comando para gerar a chave da aplicação:

```bash
php artisan key:generate
```

### 9. Execute as migrations e as seeders

Agora, execute as migrations e as seeders para configurar o banco de dados:

```bash
php artisan migrate --seed
```

### 10. Download do arquivo de endpoints para o Postman

Faça o download do arquivo de configuração do Postman que contém os endpoints da aplicação ([URL_DO_ARQUIVO](https://drive.google.com/file/d/1IHxXVa1e_Ne0SuoNurfunbofdqCplds_/view?usp=sharing)).

Após o download, importe o arquivo no Postman para começar a testar os endpoints da API.
