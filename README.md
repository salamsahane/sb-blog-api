# Laravel Blog API

This is a RESTful API for a blog application built with Laravel 10. The API supports user authentication, CRUD operations for blog posts and comments, and image handling.

## Table of Contents

- [Installation](#installation)
- [API Endpoints](#api-endpoints)
  - [Authentication](#authentication)
  - [Posts](#posts)
  - [Comments](#comments)
- [Testing](#testing)

## Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/your-username/your-repository.git
    
    cd your-repository
    ```

2. **Install dependencies:**

    ```bash
    composer install
    ```

3. **Set up your environment:**

    Copy `.env.example` to `.env` and configure your database and other environment variables.

    ```bash
    cp .env.example .env
    ```

4. **Generate the application key:**

    ```bash
    php artisan key:generate
    ```

5. **Run the database migrations:**

    ```bash
    php artisan migrate
    ```

6. **Serve the application:**

    ```bash
    php artisan serve
    ```

## API Endpoints

### Authentication

#### Register

- **Endpoint:** `POST /api/register`
- **Description:** Registers a new user.
- **Request:**
  ```json
  {
      "name": "John Doe",
      "email": "john@example.com",
      "password": "password",
      "password_confirmation": "password"
  }
- **Response:**
  ```json
  {
    "data": {
        "name": "John Doe",
        "email": "john@example.com",
        "updated_at": "2024-09-02T15:21:37.000000Z",
        "created_at": "2024-09-02T15:21:37.000000Z",
        "id": 1
    },
    "message": "User created successfully"
  }

#### Login

- **Endpoint:** `POST /api/login`
- **Description:** Authenticate a user
- **Request:**
  ```json
  {
    "email": "john@example.com",
    "password": "password"
  }
- **Response:**
  ```json
  {
    "data": {
        "access_token": "1|1D2cIaqRbvtS7SEPRFUQiLdhISUtFHNQSll9LbOs8a2ae6c9",
        "token_type": "Bearer"
    }
  }

### Posts

#### Get All Posts

- **Endpoint:** `GET /api/posts`
- **Description:** Retrieves all posts.
- **Headers:** `Authorization: Bearer {token}` 
- **Response:**
  ```json
  {
    "data": [
      { 
          "id": 1,
          "title": "Post Title",
          "content": "Post content...",
          "slug": "post-title",
          "image": "images/post-image.jpg",
          "user_id": 1,
      },
      ...
    ]
  }

#### Create a Post

- **Endpoint:** `POST /api/posts`
- **Description:** Create a new post.
- **Headers:** 
  ```json
  {
    "Authorization": "Bearer {token}",
    "Content-Type": "multipart/form-data"
  }
- **Request:**
  ```json
  {
    "title": "New Post",
    "content": "This is the content of the post.",
    "image": "form-data-file-image"
  }
- **Response:**
  ```json
  {
    "data": {
      "id": 1,
      "title": "New Post",
      "content": "This is the content of the post.",
      "image": "images/post-image.jpg",
      "slug": "new-post",
      "user_id": 1,
    },
    "message": "Post created successfully"
  }

#### Get a Single Post

- **Endpoint:** `GET /api/posts/{post}`
- **Description:** Retrieves a single post by ID.
- **Headers:** `Authorization: Bearer {token}` 
- **Response:**
  ```json
  {
    "data": {
        "id": 1,
        "title": "Post Title",
        "content": "Post content...",
        "slug": "post-title",
        "image": "images/post-image.jpg",
        "user_id": 1,
    },
  }

#### Update a Post

- **Endpoint:** `PUT|PATCH /api/posts/{post}`
- **Description:** Updates an existing post.
- **Headers:** 
  ```json
  {
    "Authorization": "Bearer {token}",
    "Content-Type": "multipart/form-data"
  }
- **Request:**
  ```json
  {
    "title": "Updated Post Title",
    "content": "Updated content.",
    "image": "form-data-file-image"
  }
- **Response:**
  ```json
  {
    "data": true,
    "message": "Post updated successfully"
  }

#### Delete a Post

- **Endpoint:** `DELETE /api/posts/{post}`
- **Description:** Deletes a post.
- **Headers:** `Authorization: Bearer {token}`
- **Response:**
  ```json
  {
    "data": true,
    "message": "Post deleted successfully"
  }

## Testing

To run the tests, use Pest, which is already set up for this project.

Run all tests with:
```bash
php artisan test
```

This command will execute all the unit and feature tests, including those for user authentication and posts.