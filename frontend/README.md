# Vue 3 Frontend with Vite and Element Plus

This is a **Vue 3** frontend application built with **Vite** and **Element Plus** as the UI library. It integrates with a Symfony backend API for user authentication using **JWT**. The application consists of three main pages:

1. **Index Page**: Displays authenticated user information or redirects to the login page if no user is logged in.
2. **Login Page**: Allows users to log in using their email and password.
3. **Register Page**: Allows new users to register.

## 🚀 Dependencies

This app is built using Vite, so make sure that you have the necessary dependencies installed.

### **Required Tools**
- **Node.js** (v18 or higher)
- **npm** or **yarn** (package manager)

🔗 **[Vite Installation Guide](https://vite.dev/guide/)**

## 📦 Install Additional Dependencies

Run the following command to install all required dependencies:

```sh
npm install
# or
yarn install
```

## ⚙️ Configure the Environment

Rename .env to .env.local and update needed data:

```dotenv
VITE_API_URL="http://127.0.0.1:8000/api"
```

## 🚀 Running the Project

Development

```sh
npm run dev
# or
yarn dev
```

Build for production

```sh
npm run build
# or
yarn build
```

Preview Production Build

```sh
npm run preview
# or
yarn preview
```

# 🔐 Authentication Flow

1. **Login**
- Users enter their email and password on the **Login Page**.
- On successful login, the JWT token is stored in `localStorage`.
- The user is redirected to the **Index Page**.
2. **Registration**
- New users enter their email and password on the **Register Page**.
- On successful registration, they are redirected to the **Login Page**.
3. **Protected Routes**
- The **Index Page** checks for a valid JWT token in `localStorage`.
- If no token is found, the user is redirected to the **Login Page**.

# 📄 Pages
1. **Index Page** (`/`)
- Displays authenticated user information (email and ID).
- If no user is logged in, redirects to the **Login Page**.
2. **Login Page** (`/login`)
- Allows users to log in using their email and password.
- On successful login, stores the JWT token and redirects to the **Index Page**.
3. **Register Page** (`/register`)
- Allows new users to register by providing an email and password.
- On successful registration, redirects to the **Login Page**.

## 🛠️ Tools & Technologies Used

- **Vue 3** (JavaScript framework)
- **Vite** (Build tool and development server)
- **Element Plus** (UI component library)
- **Vue Router** (Routing library)
- **Axios** (HTTP client)
- **TypeScript** (Type safe Javascript)
- **Sass** (CSS preprocessor)
