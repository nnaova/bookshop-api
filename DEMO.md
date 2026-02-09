# Bookshop API - Demo Guide

This is a simple demonstration REST API built with **Symfony 8.0** and **API Platform 4.2** for managing a bookshop with authors and books.

## Features

- Full REST API with **Authors** and **Books** resources
- Complete CRUD operations (Create, Read, Update, Delete)
- Automatic API documentation (Swagger/OpenAPI)
- Search and filtering capabilities
- Pagination support
- Data validation
- Sample data for immediate testing

## Prerequisites

Before starting, ensure you have:

- **Docker** (for PostgreSQL database)
- **PHP 8.4** or higher
- **Composer**
- **PHP Extensions**: PDO, pdo_pgsql (for PostgreSQL support)

### Installing Required PHP Extensions

If you get a "Class PDO not found" error, install the required PHP extensions:

**Fedora/RHEL:**
```bash
sudo dnf install php-pdo php-pgsql
```

**Ubuntu/Debian:**
```bash
sudo apt-get install php-pdo php-pgsql
```

**Arch Linux:**
```bash
sudo pacman -S php-pgsql
```

After installing, verify with:
```bash
php -m | grep -i pdo
```

You should see `PDO` and `pdo_pgsql` in the output.

## Quick Start

### 1. Start the Database

Start the PostgreSQL container with Docker:

```bash
sudo docker compose up -d
```

Wait a few seconds for PostgreSQL to initialize. Check the status:

```bash
sudo docker compose ps
```

### 2. Create the Database

```bash
php bin/console doctrine:database:create --if-not-exists
```

### 3. Generate and Run Migrations

Generate migration from entity definitions:

```bash
php bin/console doctrine:migrations:diff
```

Execute the migration to create tables:

```bash
php bin/console doctrine:migrations:migrate --no-interaction
```

Validate that the schema matches entities:

```bash
php bin/console doctrine:schema:validate
```

### 4. Load Sample Data

Load fixtures with sample authors and books:

```bash
php bin/console doctrine:fixtures:load --no-interaction
```

This will create:
- **8 authors** (J.K. Rowling, Tolkien, Asimov, Christie, Orwell, Austen, Hemingway, Bradbury)
- **18 books** with realistic data

### 5. Start the Application

Using Symfony CLI (recommended):

```bash
symfony server:start
```

Or using PHP built-in server:

```bash
php -S localhost:8000 -t public/
```

The API will be available at `http://localhost:8000`

## API Documentation

Once the server is running, access the interactive API documentation:

- **Swagger UI**: [http://localhost:8000/api/docs](http://localhost:8000/api/docs)
- **OpenAPI JSON**: [http://localhost:8000/api/docs.json](http://localhost:8000/api/docs.json)

You can test all API operations directly from the Swagger UI interface!

## Available Endpoints

### Authors

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/authors` | List all authors (paginated) |
| GET | `/api/authors/{id}` | Get a single author |
| POST | `/api/authors` | Create a new author |
| PUT | `/api/authors/{id}` | Update an author (full) |
| PATCH | `/api/authors/{id}` | Update an author (partial) |
| DELETE | `/api/authors/{id}` | Delete an author |

### Books

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/books` | List all books (paginated) |
| GET | `/api/books/{id}` | Get a single book |
| POST | `/api/books` | Create a new book |
| PUT | `/api/books/{id}` | Update a book (full) |
| PATCH | `/api/books/{id}` | Update a book (partial) |
| DELETE | `/api/books/{id}` | Delete a book |

### Query Parameters for Books

- **Search by title**: `/api/books?title=harry` (partial match)
- **Search by ISBN**: `/api/books?isbn=9780747532699` (exact match)
- **Order by title**: `/api/books?order[title]=asc`
- **Order by price**: `/api/books?order[price]=desc`
- **Order by publication date**: `/api/books?order[publishedAt]=desc`
- **Pagination**: `/api/books?page=2` (10 items per page)

## Testing with curl

### List All Authors

```bash
curl -X GET http://localhost:8000/api/authors
```

### Get a Single Author

```bash
curl -X GET http://localhost:8000/api/authors/1
```

### Create a New Author

```bash
curl -X POST http://localhost:8000/api/authors \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Stephen King",
    "biography": "American author of horror, supernatural fiction, suspense, and fantasy novels.",
    "birthDate": "1947-09-21"
  }'
```

### Update an Author (PATCH)

```bash
curl -X PATCH http://localhost:8000/api/authors/1 \
  -H "Content-Type: application/merge-patch+json" \
  -d '{
    "biography": "Updated biography text"
  }'
```

### Delete an Author

```bash
curl -X DELETE http://localhost:8000/api/authors/1
```

### List All Books

```bash
curl -X GET http://localhost:8000/api/books
```

### Search Books by Title

```bash
curl -X GET "http://localhost:8000/api/books?title=potter"
```

### Search Book by ISBN

```bash
curl -X GET "http://localhost:8000/api/books?isbn=9780747532699"
```

### Order Books by Price (ascending)

```bash
curl -X GET "http://localhost:8000/api/books?order[price]=asc"
```

### Get Books with Pagination

```bash
# Page 1 (first 10 books)
curl -X GET "http://localhost:8000/api/books?page=1"

# Page 2 (next 10 books)
curl -X GET "http://localhost:8000/api/books?page=2"
```

### Create a New Book

```bash
curl -X POST http://localhost:8000/api/books \
  -H "Content-Type: application/json" \
  -d '{
    "title": "The Shining",
    "isbn": "9780385121675",
    "description": "A horror novel about a family in an isolated hotel.",
    "price": "24.99",
    "publishedAt": "1977-01-28",
    "author": "/api/authors/1"
  }'
```

**Note**: The `author` field should reference an author IRI (e.g., `/api/authors/1`)

### Update a Book (PUT - full update)

```bash
curl -X PUT http://localhost:8000/api/books/1 \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Updated Title",
    "isbn": "9780747532699",
    "description": "Updated description",
    "price": "29.99",
    "publishedAt": "1997-06-26",
    "author": "/api/authors/1"
  }'
```

### Update a Book (PATCH - partial update)

```bash
curl -X PATCH http://localhost:8000/api/books/1 \
  -H "Content-Type: application/merge-patch+json" \
  -d '{
    "price": "25.99"
  }'
```

### Delete a Book

```bash
curl -X DELETE http://localhost:8000/api/books/1
```

## Data Validation

The API includes validation rules:

### Books
- **ISBN**: Must be a valid ISBN-13 format (13 digits starting with 978 or 979)
- **Price**: Must be a positive number
- **Title**: Required, minimum 1 character
- **Author**: Required

### Authors
- **Name**: Required, minimum 2 characters, maximum 255

### Testing Validation

Try creating a book with an invalid ISBN:

```bash
curl -X POST http://localhost:8000/api/books \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Test Book",
    "isbn": "invalid-isbn",
    "price": "19.99",
    "author": "/api/authors/1"
  }'
```

You should receive a validation error response.

Try creating a book with a negative price:

```bash
curl -X POST http://localhost:8000/api/books \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Test Book",
    "isbn": "9781234567890",
    "price": "-10.00",
    "author": "/api/authors/1"
  }'
```

You should receive a validation error.

## Relationships

Books are linked to Authors through a Many-to-One relationship:

- Each **Book** has one **Author**
- Each **Author** can have many **Books**

When you fetch a book, the author information is embedded in the response:

```bash
curl -X GET http://localhost:8000/api/books/1
```

Response includes author details:
```json
{
  "@context": "/api/contexts/Book",
  "@id": "/api/books/1",
  "@type": "Book",
  "id": 1,
  "title": "Harry Potter and the Philosopher's Stone",
  "isbn": "9780747532699",
  "price": "19.99",
  "author": {
    "@id": "/api/authors/1",
    "@type": "Author",
    "id": 1,
    "name": "J.K. Rowling"
  }
}
```

## Sample Data

After loading fixtures, you'll have:

### Authors (8 total)
1. J.K. Rowling
2. J.R.R. Tolkien
3. Isaac Asimov
4. Agatha Christie
5. George Orwell
6. Jane Austen
7. Ernest Hemingway
8. Ray Bradbury

### Books (18 total)
- Harry Potter series (3 books)
- Lord of the Rings series (3 books)
- Classic novels from various authors
- Mix of genres: Fantasy, Science Fiction, Mystery, Classic Literature

## Troubleshooting

### Docker Permission Denied

If you get "permission denied" when running Docker commands:

```bash
# Add your user to docker group
sudo usermod -aG docker $USER

# Log out and back in, then test:
docker compose up -d
```

Or use `sudo` with Docker commands:

```bash
sudo docker compose up -d
```

### PDO Class Not Found

Install PHP PDO extensions (see Prerequisites section above).

### Database Connection Failed

Make sure Docker container is running:

```bash
sudo docker compose ps
```

Check Docker logs:

```bash
sudo docker compose logs database
```

### Port 5432 Already in Use

If PostgreSQL port is already in use, stop the conflicting service or modify [compose.override.yaml](compose.override.yaml):

```yaml
services:
  database:
    ports:
      - "5433:5432"  # Use port 5433 instead
```

Then update `.env` to use the new port:

```
DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5433/app?serverVersion=16&charset=utf8"
```

### Clear Cache

If you encounter unexpected errors, clear Symfony cache:

```bash
php bin/console cache:clear
```

## Database Management

### View Data Directly

Connect to PostgreSQL:

```bash
sudo docker compose exec database psql -U app -d app
```

Common SQL commands:

```sql
-- List all tables
\dt

-- Count authors
SELECT COUNT(*) FROM author;

-- Count books
SELECT COUNT(*) FROM book;

-- View all authors
SELECT * FROM author;

-- View all books with authors
SELECT b.title, a.name as author, b.price
FROM book b
JOIN author a ON b.author_id = a.id;

-- Exit
\q
```

### Reset Database

To start fresh:

```bash
# Drop database
php bin/console doctrine:database:drop --force

# Create database
php bin/console doctrine:database:create

# Run migrations
php bin/console doctrine:migrations:migrate --no-interaction

# Load fixtures
php bin/console doctrine:fixtures:load --no-interaction
```

## Development Tips

### Adding More Sample Data

Edit [src/DataFixtures/AuthorFixtures.php](src/DataFixtures/AuthorFixtures.php) or [src/DataFixtures/BookFixtures.php](src/DataFixtures/BookFixtures.php) and reload:

```bash
php bin/console doctrine:fixtures:load --no-interaction
```

### Creating New Migrations

After modifying entities:

```bash
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate
```

### Validating Schema

Check if database schema matches entity definitions:

```bash
php bin/console doctrine:schema:validate
```

## Technology Stack

- **PHP**: 8.4
- **Symfony**: 8.0
- **API Platform**: 4.2
- **Doctrine ORM**: 3.6
- **PostgreSQL**: 16 (via Docker)
- **Doctrine Fixtures**: 4.3 (for demo data)

## Project Structure

```
bookshop-api/
├── config/                  # Configuration files
│   ├── packages/           # Bundle configs
│   └── routes/             # Routing configs
├── migrations/             # Database migrations
├── public/                 # Web root
├── src/
│   ├── Entity/            # Doctrine entities
│   │   ├── Author.php
│   │   └── Book.php
│   ├── Repository/        # Entity repositories
│   │   ├── AuthorRepository.php
│   │   └── BookRepository.php
│   └── DataFixtures/      # Sample data
│       ├── AuthorFixtures.php
│       └── BookFixtures.php
├── .env                    # Environment variables
├── compose.yaml           # Docker Compose config
└── DEMO.md                # This file
```

## API Response Format

API Platform uses JSON-LD format by default:

```json
{
  "@context": "/api/contexts/Book",
  "@id": "/api/books/1",
  "@type": "Book",
  "id": 1,
  "title": "Book Title",
  ...
}
```

Collections include pagination metadata:

```json
{
  "@context": "/api/contexts/Book",
  "@id": "/api/books",
  "@type": "hydra:Collection",
  "hydra:totalItems": 18,
  "hydra:member": [
    { /* book 1 */ },
    { /* book 2 */ },
    ...
  ],
  "hydra:view": {
    "hydra:first": "/api/books?page=1",
    "hydra:last": "/api/books?page=2",
    "hydra:next": "/api/books?page=2"
  }
}
```

## Next Steps

This demo provides a foundation for:

- **Adding more entities** (Categories, Publishers, Reviews)
- **Implementing authentication** (JWT, OAuth)
- **Adding more filters** (price ranges, date ranges)
- **File uploads** (book covers)
- **Search functionality** (full-text search)
- **API rate limiting**
- **Versioning**

## Support

For issues or questions:
- Review Symfony documentation: https://symfony.com/doc/current/index.html
- Review API Platform documentation: https://api-platform.com/docs/
- Check logs: `tail -f var/log/dev.log`

Enjoy exploring the Bookshop API!
