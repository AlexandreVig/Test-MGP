# Full-Stack Project: Symfony Backend with Vue 3 Frontend

This is a full-stack project that combines a **Symfony backend** with a **Vue 3 frontend**. The backend provides a RESTful API with JWT authentication, while the frontend is a single-page application (SPA) built with Vue 3, Vite, and Element Plus.

## 🚀 Features

### Backend (Symfony)

- **JWT Authentication**: Secure user authentication using JSON Web Tokens (JWT).
- **RESTful API**: Endpoints for user registration, login, and fetching authenticated user information.
- **Relational (SQL) Database**: Stores user data.

### Frontend (Vue 3)

- **User Authentication**: Login and registration forms integrated with the backend API.
- **Protected Routes**: Redirects unauthenticated users to the login page.
- **TypeScript Support**: Adds type safety to the frontend codebase.

## 🛠️ Setup Instructions

### Backend Prerequisites
- **PHP 8.2 or higher** (with required extensions: Ctype, iconv, PCRE, Session, SimpleXML, and Tokenizer)
- **Composer** (PHP package manager)
- **Symfony CLI** (for running the Symfony server)
- **PostgreSQL** (for the database)
- **Docker & Docker Compose** (optional, for easy database setup)

### Frontend Prerequisites
- **Node.js** (v18 or higher)
- **npm** or **yarn** (package manager)

## ⚙️ Backend Setup

Follow this [README](./backend/README.md) to setup the backend.

## ⚙️ Frontend Setup

Follow this [README](./frontend/README.md) to setup the backend.

## 🛠️ Tools & Technologies Used

### Backend

- **Symfony** (PHP Framework)
- **Doctrine ORM** (ORM for the Database)
- **LexikJWTAuthenticationBundle** (JWT Auth)
- **PostgreSQL** (Database)
- **Docker** (Containerization)

### Frontend

- **Vue 3** (JavaScript framework)
- **Vite** (Build tool and development server)
- **Element Plus** (UI component library)
- **Vue Router** (Routing library)
- **Axios** (HTTP client)
- **TypeScript** (Type safe Javascript)
- **Sass** (CSS preprocessor)
