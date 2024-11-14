# Chat Service
## Overview

This is a backend implementation of a chat application using PHP, the Slim framework, and SQLite. Users can create chat groups, join these groups, and send messages within them. The groups are public, so any user can join any group. Users can also view all the messages.

## Features

- Create chat groups
- Join chat groups
- Send messages within chat groups
- List all messages within a group
- List all chat groups
- List all messages within the group

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
  {
    "username": "username"
  }

- **Create Group**
  ```http
  POST /api/groups
  {
    "name": GroupName,
    "user_id": Admin's UserId
  }


- **Join Group**
  ```http
  POST /api/groups/join
  {
    "id": GroupId,
    "user_id": UserId
  }

- **List All Group**
  ```http
  GET /api/groups/list


- **List All Messages within the Group**
  ```http
  GET /api/messages/list
{
    "group_id": GroupId,
}



