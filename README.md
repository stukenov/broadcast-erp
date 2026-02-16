# Broadcast ERP

A comprehensive Enterprise Resource Planning (ERP) system specifically designed for broadcast and media companies. Built with Laravel 11, this system manages broadcasting schedules, programs, sales, inventory, procurement, and financial operations.

## Features

- **Broadcasting Management**
  - Program scheduling and management
  - TV show scheduling and coordination
  - Broadcasting timeline management

- **Sales & Finance**
  - Sales tracking and management
  - Financial operations and reporting
  - Revenue management

- **Inventory & Procurement**
  - Inventory tracking and management
  - Supplier management
  - Purchase order management
  - Procurement workflows

- **User Management**
  - Role-based access control
  - User authentication and authorization
  - Multi-user support

## Tech Stack

- **Framework**: Laravel 11.x
- **PHP**: 8.2+
- **Frontend**: Laravel UI with Vite
- **Database**: SQLite (default), MySQL/PostgreSQL compatible
- **Authentication**: Laravel UI

## Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- SQLite/MySQL/PostgreSQL

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/stukenov/broadcast-erp.git
   cd broadcast-erp
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   # For SQLite (default)
   touch database/database.sqlite

   # Or configure MySQL/PostgreSQL in .env
   # DB_CONNECTION=mysql
   # DB_HOST=127.0.0.1
   # DB_PORT=3306
   # DB_DATABASE=broadcast_erp
   # DB_USERNAME=root
   # DB_PASSWORD=
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Build assets**
   ```bash
   npm run build
   # Or for development
   npm run dev
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` in your browser.

## Database Structure

The system includes the following main models:

- **Schedule** - Broadcasting schedules
- **Program** - TV programs and shows
- **Sale** - Sales transactions
- **Finance** - Financial records
- **Inventory** - Inventory items
- **Purchase** - Purchase orders
- **Supplier** - Supplier information
- **User** - System users

## Configuration

All configuration can be done through the `.env` file:

```env
APP_NAME="Broadcast ERP"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=sqlite
# Or use MySQL/PostgreSQL

MAIL_MAILER=log
# Configure email settings for production
```

## Development

```bash
# Run in development mode with hot reload
npm run dev

# Run tests
php artisan test

# Code formatting
./vendor/bin/pint
```

## Production Deployment

1. Set environment to production:
   ```bash
   APP_ENV=production
   APP_DEBUG=false
   ```

2. Optimize the application:
   ```bash
   composer install --optimize-autoloader --no-dev
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

3. Build assets for production:
   ```bash
   npm run build
   ```

## Security

- Always use strong passwords
- Keep your `.env` file secure and never commit it
- Regularly update dependencies
- Enable HTTPS in production
- Configure proper file permissions

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).

## Author

Copyright (c) 2025 Saken Tukenov

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Support

For support, please open an issue on the GitHub repository.
