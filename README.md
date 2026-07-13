# 🖼️ Image Hub

Image Hub é uma aplicação web para gerenciamento de imagens desenvolvida utilizando Laravel e Vue.js. O sistema permite que usuários autenticados façam upload, visualizem e removam suas imagens por meio de uma API REST segura.

## 🚀 Tecnologias

### Backend
- PHP 8.1+
- Laravel 10
- Laravel Sanctum
- MySQL
- REST API

### Frontend
- Vue.js 3
- Vite
- Vue Router
- Pinia
- Axios
- Tailwind CSS
- Headless UI

---

## ✨ Funcionalidades

- Autenticação de usuários
- Upload de imagens
- Listagem de imagens
- Exclusão de imagens
- API protegida com Laravel Sanctum
- Interface responsiva

---

## 📁 Estrutura do projeto

```
image_hub/
│
├── backend/      # API Laravel
└── frontend/     # Aplicação Vue.js
```

---

## ⚙️ Instalação

### 1. Clone o repositório

```bash
git clone https://github.com/seu-usuario/image-hub.git
cd image-hub
```

---

## Backend

Entre na pasta do backend

```bash
cd backend
```

Instale as dependências

```bash
composer install
```

Copie o arquivo de ambiente

```bash
cp .env.example .env
```

Configure o banco de dados no arquivo `.env`.

Gere a chave da aplicação

```bash
php artisan key:generate
```

Execute as migrations

```bash
php artisan migrate
```

Crie o link para armazenamento das imagens

```bash
php artisan storage:link
```

Inicie o servidor

```bash
php artisan serve
```

---

## Frontend

Entre na pasta do frontend

```bash
cd frontend
```

Instale as dependências

```bash
npm install
```

Execute o projeto

```bash
npm run dev
```

---

## 🔒 Autenticação

A API utiliza **Laravel Sanctum** para autenticação.

As rotas de gerenciamento de imagens são protegidas e exigem que o usuário esteja autenticado.

---

## 📡 Endpoints

| Método | Endpoint | Descrição |
|---------|----------|-----------|
| GET | `/api/images` | Lista as imagens do usuário |
| POST | `/api/images` | Faz upload de uma imagem |
| DELETE | `/api/images/{id}` | Remove uma imagem |

---

## 📷 Funcionalidades

- Login de usuários
- Upload de arquivos de imagem
- Visualização das imagens enviadas
- Exclusão de imagens
- Interface moderna utilizando Vue.js

---

## 📌 Arquitetura

- **Frontend:** Vue.js consumindo a API REST.
- **Backend:** Laravel responsável pela autenticação, armazenamento das imagens e regras de negócio.
- **Banco de Dados:** MySQL.
- **Armazenamento:** Laravel Storage.

---

## 👨‍💻 Autor

Desenvolvido por **Murilo Kaemmerer Klein**.
