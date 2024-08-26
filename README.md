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
