# Laravel Blog App

A blog application built with Laravel where users can create posts, comment, like posts, and manage their profiles.
This project was built to practice real-world Laravel development concepts such as authentication, authorization, CRUD operations, REST APIs, policies, services, and testing.

---

## Features

### Authentication

* User Registration
* User Login & Logout
* Profile Management
* Password Confirmation
* Account Deletion

### Blog System

* Create Posts
* Edit Posts
* Delete Posts
* Public Blog Feed
* Single Post View
* Search Posts
* Pagination

### Comments & Likes

* Add Comments on Posts
* Delete Comments
* Like / Unlike Posts

### Admin Features

* Admin Dashboard
* Role-based Authorization
* Admin Middleware Protection

### API Features

* API Login using Sanctum
* Fetch All Posts
* Fetch Single Post
* Create Post via API
* Update Post via API
* Delete Post via API
* Like Posts via API

---

## Technologies Used

### Backend

* Laravel
* PHP
* MySQL

### Frontend

* Blade Templates
* Bootstrap

### Authentication

* Laravel Breeze
* Laravel Sanctum

### Testing

* PHPUnit

---

## Laravel Concepts Used

* MVC Architecture
* Eloquent ORM
* Route Model Binding
* Middleware
* Policies
* Form Request Validation
* Service Classes
* API Development
* Database Relationships
* Pagination
* File Uploads
* Authentication & Authorization

---

## Database Relationships

### One-to-Many

* User → Posts
* Post → Comments

### Many-to-Many

* Users ↔ Likes

---

## Installation

Clone the repository:

```bash
git clone <your-repository-link>
```

Move into the project folder:

```bash
cd blog-app
```

Install dependencies:

```bash
composer install
npm install
```

Create environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Configure your database inside `.env`

Run migrations:

```bash
php artisan migrate
```

Start the Laravel server:

```bash
php artisan serve
```

Run Vite:

```bash
npm run dev
```

---

## Running Tests

```bash
php artisan test
```

---

## API Authentication

This project uses Laravel Sanctum for API authentication.

Example flow:

1. Login using `/api/login`
2. Receive token
3. Use token in Authorization header:

```plaintext
Bearer YOUR_TOKEN
```

---

## Future Improvements

* Categories & Tags
* Rich Text Editor
* Notifications
* Full Vue.js Frontend
* Better UI/UX

---

## What I Learned

While building this project, I learned:

* Laravel authentication system
* Authorization using Policies
* Service layer architecture
* API creation in Laravel
* Sanctum authentication
* Database relationships
* Testing with PHPUnit
* Clean routing and controller structure
* CRUD operations in real applications

---

## Author

Shubham Sharma
