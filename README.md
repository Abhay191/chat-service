---

# Chat Service
![Alt text](data:image/png;base64,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)

## Overview

This is a backend implementation of a chat application using PHP, the Slim framework, and SQLite. Users can create chat groups, join these groups, and send messages within them. The groups are public, so any user can join any group. Users can also view all the messages.

## Features

- Create chat groups
- Join chat groups
- Send messages within chat groups
- List all messages within a group
- List all chat groups

## Technologies Used

- PHP
- Slim Framework
- SQLite
- PHPUnit (for testing)
- Guzzle (for HTTP client)

## Setup

### Prerequisites

- PHP 7.4 or higher
- Composer

### Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/Abhay191/chat-service.git
    cd chat-service
    ```

2. Install dependencies:
    ```bash
    composer install
    ```

3. Set up the database:
    ```bash
    php src/database/init_db.php
    ```

### Running the Application

1. Start the Slim application:
    ```bash
    php -S localhost:8000 -t public
    ```

2. The application should now be running at `http://localhost:8000`.

### API Endpoints

#### User Endpoints

- **Create User**  
  ```http
  POST /api/users
  Content-Type: application/json
  {
    "username": "username"
  }
  ```

- **Create Group**  
  ```http
  POST /api/groups
  Content-Type: application/json
  {
    "name": "GroupName",
    "user_id": "Admin's UserId"
  }
  ```

- **Join Group**  
  ```http
  POST /api/groups/join
  Content-Type: application/json
  {
    "id": "GroupId",
    "user_id": "UserId"
  }
  ```

- **List All Groups**  
  ```http
  GET /api/groups/list
  ```

- **List All Messages within the Group**  
  ```http
  GET /api/messages/list
  Content-Type: application/json
  {
    "group_id": "GroupId"
  }
  ```

**Note:** All IDs are integers.

---
