# Symfony API with JWT Authentication

This is a RESTful API built with **Symfony** and **JWT authentication**.
It provides user authentication, registration, and protected routes.

## 🚀 Dependencies

This API is built using Symfony, so make sure that you have the necessary dependencies installed.

### **Required Tools**
- **PHP 8.2 or higher** (with required extensions: Ctype, iconv, PCRE, Session, SimpleXML, and Tokenizer)
- **Composer** (PHP package manager)
- **Symfony CLI** (for running the Symfony server)
- **PostgreSQL** (for the database)
- **Docker & Docker Compose** (optional, for easy database setup)

🔗 **[Symfony Installation Guide](https://symfony.com/doc/current/setup.html)**

## 📦 Install Additional Dependencies

Run the following command to install all required PHP dependencies:

```sh
composer install
```

## ⚙️ Configure the Environment

Rename .env to .env.local and update needed data:

```dotenv
APP_ENV=prod_or_dev
APP_SECRET=your_app_secret
DATABASE_URL="postgresql://db_user:db_password@127.0.0.1:5432/db_name"
CORS_ALLOW_ORIGIN='^https?://(localhost|127\.0\.0\.1)(:[0-9]+)?$'
JWT_PASSPHRASE=your_jwt_passphrase
```

## 🗄️ Initialize the Database

Make sure your database is running before continuing.

If you want to use **Docker**, a `compose.yaml` file is included to start a PostgreSQL database easily:

```sh
docker compose up
```

Then, run the following commands to initialize the database:

```sh
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

## 🔑 Generate JWT Encryption Keys

```sh
php bin/console lexik:jwt:generate-keypair
```

## 🚀 Start the server

```sh
symfony server:start
```

API will be available at http://127.0.0.1:8000

# 🔐 Authentication API Endpoints

## ➕ Register a New User

POST `/api/auth/register`

- Body (JSON):

```json
{
  "email": "user@example.com",
  "password": "password123"
}
```

- Response (201 Created):

```json
{
  "message": "User registered"
}
```

## 🔑 Login

POST `/api/auth/login`

- Body (JSON):

```json
{
  "email": "user@example.com",
  "password": "password123"
}
```

- Response (200 OK):

```json
{
  "token": "your_jwt_token"
}
```

## 👤 Get Authenticated User Info

GET `/api/auth/me`

- Headers:

```
Authorization: Bearer your_jwt_token
```

- Response (200 OK):

```json
{
  "id": 1,
  "email": "user@example.com"
}
```

## 🛠️ Tools & Technologies Used

- **Symfony** (PHP Framework)
- **Doctrine ORM** (ORM for the Database)
- **LexikJWTAuthenticationBundle** (JWT Auth)
- **PostgreSQL** (Database)
- **Docker** (Containerization)
