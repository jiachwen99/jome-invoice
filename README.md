# Kanye Quotes Application

This Laravel application displays random Kanye West quotes, provides an API to fetch quotes, and includes user authentication.

## Features

- User registration and authentication
- Display 5 random Kanye West quotes on a web page
- Refresh quotes functionality
- API endpoint to fetch X number of random quotes
- API authentication using tokens
- Cron job to regularly update quotes with failure handling

## Requirements

- PHP 8.1+
- Laravel 9.x
- Composer
- Node.js and npm
- MySQL or another Laravel-supported database

## Setup Instructions

1. Clone the repository:
   ```
   git clone https://github.com/jiachwen99/jome-invoice.git
   ```

2. Install PHP dependencies:
   ```
   composer install
   ```

3. Install and compile frontend assets:
   ```
   npm install && npm run dev
   ```

4. Copy the `.env.example` file to `.env` and configure your database:
   ```
   cp .env.example .env
   ```

5. Generate application key:
   ```
   php artisan key:generate
   ```

6. Run database migrations:
   ```
   php artisan migrate
   ```

7. Start the development server:
   ```
   php artisan serve
   ```

8. Visit `http://localhost:8000` in your browser and register a new user.

## Usage

### Web Interface

After logging in, navigate to `/quotes` to see the Kanye quotes. Click the "Refresh Quotes" button to get new quotes.

### API Usage

To use the API, you first need to create a token:

1. Make a POST request to `/api/tokens/create` with your email and password:
   ```
   POST /api/tokens/create
   Content-Type: application/json

   {
     "email": "your@email.com",
     "password": "your_password"
   }
   ```

2. The response will contain your API token:
   ```json
   {
     "token": "your_api_token"
   }
   ```

3. Use this token in the Authorization header when making requests to the API:
   ```
   GET /api/quotes/{count}
   Authorization: Bearer your_api_token
   ```

   Replace `{count}` with the number of quotes you want to retrieve (default is 5, maximum is 50).

## Setting up the Cron Job

The application includes a cron job that regularly updates quotes and handles failures. To set this up on your server:

1. Open your server's crontab file:
   ```
   crontab -e
   ```

2. Add the following line to run the Laravel scheduler every minute:
   ```
   * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
   ```
   Replace `/path-to-your-project` with the actual path to your Laravel project on the server.

3. Save and close the crontab file.

This will ensure that the Laravel scheduler runs every minute, which in turn will execute our hourly quote update task.
