# Cahos API by MazBaz

## Features

- **Authentication**: Securely authenticate users.
- **Client Management**: Manage client data efficiently.
- **Category Management**: Manage category data efficiently.
- **Product Management**: Manage product data efficiently.
- **Order Management**: Manage order data efficiently.
- **Scramble Documentation UI**: Redirects to the Scramble documentation UI.
- **Database Migrations**: Easily migrate and seed the sqlite database.
- **Docker Support**: Run the application in a Docker container.

## Getting Started

### Prerequisites

- Git
- Docker
- Docker Compose
- Port 8010 available

If the port 8010 is not available, you can change the port in the `docker-compose.yml` file:
```yml
services:
  app:
    ports:
      - "8010:8000"
```

**⚠️ Don't forget to update the port in the application environment variables.**


### Installation
1. Clone the repository:
    ```sh
    git clone https://github.com/mazbazdev/cahos_api.git
    cd cahos_api
    ```

2. Build and start the Docker containers:
    ```sh
    docker-compose up --build
    ```

3. Access the application:
   Open your web browser and navigate to [http://localhost:8010](http://localhost:8010) to access the Scramble documentation UI.

### Environment Variables

The application uses the following environment variables, which are set in the `docker-compose.yml` file:
- APP_NAME="Cahos API by MazBaz"
- APP_ENV=local
- APP_DEBUG=true
- DB_CONNECTION=sqlite

## Database Migrations

The application automatically applies database migrations when the Docker container starts.

💡 To populate the database with sample data, you can run `php artisan db:seed` from within the API container.

## Database Schema

The database schema consists of the following tables:

![Database Schema](https://github.com/MazBazDev/CAHOS_API/blob/develop/database/diagram.png?raw=true)
