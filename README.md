# RESTFUL-API-LARAVEL-UPLOAD-FILE

## Requisitos
- **PHP**: Versão 8.3
- **Composer**: Para gerenciar dependências do PHP.

### Clone o Repositório

```bash
git clone https://github.com/KnSXl/RESTFUL-API-LARAVEL-UPLOAD-FILE.git
```

### Acesse o Diretório do Projeto

```bash
cd RESTFUL-API-LARAVEL-UPLOAD-FILE
```

### Instale as Dependências

```bash
composer install
```

### Crie o Arquivo .env

```bash
cp .env.example .env
```

### Gere a Chave do Projeto

```bash
php artisan key:generate
```

### Migre as Tabelas

```bash
php artisan migrate
```

### Inicie o Projeto

```bash
php artisan serve
```

### Acesso ao Projeto

- **Rodando Em:** [http://127.0.0.1:8000](http://127.0.0.1:8000)

### Endpoints

- `GET` `http://127.0.0.1:8000/api/image` // Listar todas as imagens
- `GET` `http://127.0.0.1:8000/api/image/{id}` // Obter Imagem específica
- `POST` `http://127.0.0.1:8000/api/image` // Criar uma nova imagem
- `POST` `http://127.0.0.1:8000/api/image/{id}` // Atualizar imagem (utilize `_method=PUT` ou `_method=PATCH` no corpo da requisição ou na URL)
- `DELETE` `http://127.0.0.1:8000/api/image/{id}` // Deletar imagem