# 📚 GourmetLibrary API

Welcome to the **GourmetLibrary API** repository. This is a robust, RESTful API built with **Laravel** to manage a culinary library. It provides features for cataloging books, categorizing them, managing users, handling book borrowings, and generating administrative statistics.

## 🚀 Tech Stack

* **Framework:** Laravel (PHP)
* **Database:** MySQL
* **Authentication:** Laravel Sanctum (Token-based)
* **Architecture:** MVC (Model-View-Controller) with Route Model Binding

---

## ✨ Key Features

1.  **Secure Authentication:** Token-based login and logout using Laravel Sanctum.
2.  **Role-Based Access Control (RBAC):** Middleware-protected routes separating `admin` (librarian) and `reader` (gourmand) permissions.
3.  **Advanced Book Catalog:** * Browse books with dynamic filtering (by category).
    * Search by title or author.
    * Sort by new arrivals (`recent`) or most borrowed (`popular`).
4.  **Category Management:** Organize books into culinary categories.
5.  **Admin Dashboard:** Comprehensive statistics endpoint for library management (total books, damaged copies, top categories, and most consulted books).

---

## 🛠️ Installation & Setup

### Prerequisites
Make sure you have the following installed on your machine:
* [PHP 8.2+](https://www.php.net/)
* [Composer](https://getcomposer.org/)
* [MySQL](https://www.mysql.com/)
* [Postman](https://www.postman.com/) (or Thunder Client for testing)

### Step-by-Step Guide

**1. Clone the repository**
```bash
git clone [https://github.com/your-username/GourmetLibrary_API.git](https://github.com/your-username/GourmetLibrary_API.git)
cd GourmetLibrary_API

```

**2. Install dependencies**

```bash
composer install

```

**3. Environment configuration**
Copy the example `.env` file and generate the application key.

```bash
cp .env.example .env
php artisan key:generate

```

**4. Database setup**
Open your `.env` file and configure your MySQL database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gourmetlibrary
DB_USERNAME=root
DB_PASSWORD=

```

**5. Run Migrations and Seeders**
This will create the database tables and populate them with dummy data (including an admin user, categories, books, and borrowing records).

```bash
php artisan migrate:fresh --seed

```

**6. Start the local server**

```bash
php artisan serve

```

*The API will be available at `http://127.0.0.1:8000`.*

---

## 🔒 Authentication & Headers

This API expects JSON requests and responses. You must include the following header in **all** your API requests:

* `Accept: application/json`

For protected routes, you must first obtain a token via the `/api/login` endpoint and pass it in the Authorization header:

* `Authorization: Bearer {your_access_token}`

---

## 📖 API Endpoints Documentation

### 👤 Authentication (Public)

| Method | Endpoint | Description | Expected Payload |
| --- | --- | --- | --- |
| `POST` | `/api/login` | Authenticate a user and issue a token. | `email`, `password` |
| `POST` | `/api/users` | Register a new user account. | `name`, `email`, `phone` (Moroccan format), `password` |

### 📚 Books Resource

| Method | Endpoint | Access | Description |
| --- | --- | --- | --- |
| `GET` | `/api/books` | Auth | List all books. Supports query params: `?search=xyz`, `?category_id=1`, `?sort=recent/popular`. |
| `GET` | `/api/books/{book}` | Auth | Get a specific book's details. |
| `POST` | `/api/books` | **Admin** | Add a new book to the catalog. |
| `PUT` | `/api/books/{book}` | **Admin** | Update a book's details or damaged quantity. |
| `DELETE` | `/api/books/{book}` | **Admin** | Remove a book from the catalog. |

### 🏷️ Categories Resource

| Method | Endpoint | Access | Description |
| --- | --- | --- | --- |
| `GET` | `/api/categories` | Auth | List all categories (includes book count). |
| `GET` | `/api/categories/{category}` | Auth | Get a specific category. |
| `GET` | `/api/categories/{category}/books` | Auth | Get all books belonging to a specific category. |
| `POST` | `/api/categories` | **Admin** | Create a new category. |
| `PUT` | `/api/categories/{category}` | **Admin** | Rename a category. |
| `DELETE` | `/api/categories/{category}` | **Admin** | Delete a category. |

### 🧑‍🤝‍🧑 Users Management

| Method | Endpoint | Access | Description |
| --- | --- | --- | --- |
| `GET` | `/api/users` | Auth | List all registered users. |
| `GET` | `/api/users/{user}` | Auth | Get user profile. |
| `PUT` | `/api/users/{user}` | Auth | Update user profile (supports partial updates via `sometimes`). |
| `DELETE` | `/api/users/{user}` | **Admin** | Delete a user account. |

### 📊 Administration

| Method | Endpoint | Access | Description |
| --- | --- | --- | --- |
| `GET` | `/api/admin/statistics` | **Admin** | Returns global analytics: total books, total copies, damaged copies, and top 5 most borrowed books. |

### 🚪 Logout

| Method | Endpoint | Access | Description |
| --- | --- | --- | --- |
| `POST` | `/api/logout` | Auth | Revoke the current access token. |

---

## 🗄️ Database Schema Structure

Here are the architectural diagrams for the GourmetLibrary API:

### Entity-Relationship Diagram (ERD)
![GourmetLibrary ERD](docs/GourmetLibrary%20ERD.png)

### Use Case Diagram
![GourmetLibrary Use Case](docs/GourmetLibrary%20Use%20case.png)

### Class Diagram
![GourmetLibrary Class Diagram](docs/GourmetLibrary%20class%20diagram.png)
---

*Developed with ❤️ as part of the GourmetLibrary backend project.*
