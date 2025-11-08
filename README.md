# Sistema de Gerenciamento de Tarefas

Aplicação Laravel para gerenciar tarefas com CRUD completo, autenticação, soft delete e interface responsiva.

## Tecnologias

- **Laravel 12** (PHP 8.2+)
- **MySQL** (via Docker)
- **Tailwind CSS**
- **Laravel Breeze** (Autenticação)
- **Laravel Sail** (Docker)

## Requisitos

- Docker Desktop (Windows/Mac) ou Docker Engine (Linux)
- WSL2 (Windows)
- Git

> Com Laravel Sail, você NÃO precisa ter PHP, Composer, MySQL ou Node.js instalados localmente.

## Instalação

### 1. Clone e configure

```bash
git clone <url-do-repositorio>
cd simples-hotel
cp .env.example .env
```

### 2. Instale dependências via Docker

**Windows:**
```bash
docker run --rm -v "%cd%:/var/www/html" -w /var/www/html laravelsail/php83-composer:latest composer install --ignore-platform-reqs
```

**Linux/Mac:**
```bash
docker run --rm -v "$(pwd):/var/www/html" -w /var/www/html laravelsail/php83-composer:latest composer install --ignore-platform-reqs
```

### 3. Inicie o ambiente

```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

### 4. Acesse a aplicação

**http://localhost**

**Dica:** Crie um alias:
```bash
alias sail='./vendor/bin/sail'
```

## Funcionalidades

- [x] CRUD completo de tarefas
- [x] Listagem paginada (10 itens/página)
- [x] Filtro por status (pendente/concluída)
- [x] Soft Delete com lixeira
- [x] Restauração de tarefas
- [x] Validação com FormRequest
- [x] Autenticação (Laravel Breeze)
- [x] Interface responsiva

## Estrutura Principal

```
app/
├── Http/Controllers/TaskController.php
├── Http/Requests/
│   ├── StoreTaskRequest.php
│   └── UpdateTaskRequest.php
├── Models/Task.php
└── View/Components/FormTask.php

resources/views/tasks/
├── index.blade.php
├── create.blade.php
├── edit.blade.php
├── trash.blade.php
└── partials/filter.blade.php

routes/web.php
```

## Decisões Técnicas

### Laravel Sail
Ambiente Docker isolado que elimina problemas de "funciona na minha máquina" e facilita onboarding.

### Soft Deletes
Implementado para permitir restauração de dados excluídos acidentalmente (requisito do projeto).

### Form Requests
Validação separada do controller (SRP) para código mais limpo e testável.

### Blade Components
`form-task.blade.php` reutilizado em create/edit para evitar duplicação (DRY).

### Rotas antes do Resource
`tasks/trash` declarada ANTES de `Route::resource()` para evitar conflito com `tasks/{task}`.

## Melhorias Futuras

- Busca por título
- Ordenação de colunas
- Tornar mais prático a troca de status de uma tarefa (toggle/checkbox)
- Testes automatizados
- Dashboard com estatísticas
- Exportação (PDF/CSV)
- Tags/categorias

---