# Laravel GraphQL Todo API

## Overview

This is a Laravel-based GraphQL API for managing Todos. The API allows you to perform CRUD operations on Todos, group them into lists, and sync them with third-party Todo services like Microsoft Todo.

## Features
- Query Todos
- Filter by status
- Group Todos in lists
- Add new Todos
- Update existing Todos
- Sync with third-party Todo services (Microsoft Todo)
- User authentication
- Pagination support

## Installation

1. Clone the repository

   `git clone https://github.com/webboy/simpletodo.git`
2. Navigate to project directory
3. Install dependencies

    `composer install`   

4. Copy .env.example to .env
5. Generate application key

    `php artisan key:generate`

6. Configure database in .env

    `DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password`
7. Run migrations

    `php artisan migrate`

8. Seed the database

    `php artisan db:seed`

9. Start the development server

    `php artisan serve`

## Usage

### Authentication

API authentication works through Laravel Sanctum package. Password for all seeded users is `password`

### GraphQL Schema

The API is built using GraphQL. Below are the main types and operations available.

#### Types
- User: Represents a user in the system.
- Todo: Describes a Todo item with fields like id, title, status, and its relationships to User and TodoList.
- TodoList: Represents a list of Todos.
- TodoStatus: Enum representing the status of a Todo (PENDING, COMPLETED, ABORTED).
#### Queries
- me: Fetch the authenticated user's details.
- todos: Fetches a list of Todos, optionally filtered by status. It uses pagination and is guarded for authenticated users.
- todo: Fetches a single Todo by its ID. It is also guarded for authenticated users.

#### Mutations
- login: Authenticate a user.
- createTodo: Allows creating a new Todo item with various fields. It uses a custom validator and is guarded for authenticated users.
- updateTodo: Allows updating an existing Todo item. It also uses a custom validator and is guarded for authenticated users.

For more details, refer to the schema.graphql file in the graphql directory. 

### Third-party Integration
// Describe how to set up and use third-party integrations like Microsoft Todo.

## Testing
Run the PHPUnit tests:

bash
Copy code
./vendor/bin/phpunit










