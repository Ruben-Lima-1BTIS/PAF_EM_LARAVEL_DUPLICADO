# PAF EM LARAVEL

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-black.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="#"><img src="https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel 10"></a>
  <a href="#"><img src="https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php" alt="PHP 8.1+"></a>
  <a href="#"><img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License"></a>
</p>

---

## About This Project

A Laravel application built for enterprise-level project management and administration. The project is built on modern PHP and Laravel conventions, with an emphasis on maintainability, clarity, and performance.

### Key Features

- **Admin Panel** — A full-featured dashboard for managing application data and users.
- **Authentication & Access Control** — Role-based access control (RBAC) to manage permissions across different user types.
- **Data Management** — Advanced database queries and Eloquent relationships for efficient data handling.
- **Performance** — Optimised Blade templating and asset compilation for fast page loads.
- **Responsive Interface** — Mobile-friendly layout suitable for all screen sizes.

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | PHP 8.1+, Laravel 10.x |
| Frontend | Blade Templates, JavaScript, CSS |
| Database | MySQL or PostgreSQL |
| Build Tools | Node.js, npm |

---

## Requirements

Before getting started, ensure the following are installed on your system:

- PHP 8.1 or higher
- Composer
- Node.js and npm
- MySQL or PostgreSQL
- Git

---

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/Ruben-Lima-1BTIS/PAF_EM_LARAVEL_DUPLICADO.git
cd PAF_EM_LARAVEL_DUPLICADO
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install JavaScript dependencies

```bash
npm install
```

### 4. Set up the environment file

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure the database

Open the `.env` file and update the following values to match your local database setup:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=paf_em_laravel
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Run database migrations

```bash
php artisan migrate
```

### 7. Compile assets

```bash
# For local development:
npm run dev

# For production:
npm run build
```

### 8. Start the development server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`.

---

## Project Structure

```
├── app/                    # Core application logic (Models, Controllers, Services)
├── resources/
│   ├── views/              # Blade templates
│   ├── css/                # Stylesheets
│   └── js/                 # JavaScript source files
├── routes/                 # Web and API route definitions
├── database/               # Migrations and seeders
├── public/                 # Publicly accessible assets
├── config/                 # Application configuration files
├── tests/                  # Unit and feature tests
└── .env.example            # Environment configuration template
```

---

## Common Commands

| Command | Description |
|---------|-------------|
| `php artisan serve` | Start the local development server |
| `php artisan migrate` | Run all pending database migrations |
| `php artisan db:seed` | Seed the database with sample data |
| `php artisan tinker` | Open the interactive REPL shell |
| `php artisan test` | Run the test suite |
| `php artisan cache:clear` | Clear the application cache |
| `php artisan config:clear` | Clear the configuration cache |
| `npm run dev` | Build assets for development |
| `npm run build` | Build and minify assets for production |

---

## Running Tests

```bash
php artisan test
```

---

## Documentation

For more information on the frameworks and tools used in this project, refer to the official documentation:

- [Laravel Documentation](https://laravel.com/docs)
- [Blade Templating Engine](https://laravel.com/docs/blade)
- [Eloquent ORM](https://laravel.com/docs/eloquent)
- [Laravel Migrations](https://laravel.com/docs/migrations)

---

## Contributing

Contributions are welcome. To propose a change:

1. Fork the repository.
2. Create a new feature branch: `git checkout -b feature/your-feature-name`
3. Commit your changes: `git commit -m 'Add your feature description'`
4. Push to the branch: `git push origin feature/your-feature-name`
5. Open a Pull Request against the main branch.

Please ensure your code is well-tested and follows the existing code style before submitting.

---

## Bug Reports

To report a bug, open an issue on GitHub and include the following details:

- A clear description of the problem.
- Steps to reproduce the issue.
- Expected and actual behaviour.
- Screenshots, if applicable.
- Your environment details (PHP version, operating system, etc.).

---

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for full details.

---

## Author

**Ruben Lima**  
GitHub: [@Ruben-Lima-1BTIS](https://github.com/Ruben-Lima-1BTIS)

---

*Last updated: 2026-04-18*