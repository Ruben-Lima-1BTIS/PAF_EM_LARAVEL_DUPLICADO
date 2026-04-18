# PAF EM LARAVEL DUPLICADO

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

## 📋 About This Project

A robust Laravel application built for enterprise-level project management and administration. This project leverages modern PHP and Laravel technologies with a strong focus on maintainability and performance.

### Key Features

- ✨ **Comprehensive Admin Panel** - Full-featured dashboard for management
- 🔐 **Secure Authentication** - Role-based access control (RBAC)
- 📊 **Data Management** - Advanced database queries and relationships
- 🚀 **Performance Optimized** - Efficient blade templating and asset handling
- 📱 **Responsive Design** - Mobile-friendly interface

---

## 🛠️ Tech Stack

- **Backend:** PHP 8.1+, Laravel 10.x
- **Frontend:** Blade Templates (56.9%), JavaScript (1.5%), CSS (1.3%)
- **Database:** MySQL/PostgreSQL
- **Build Tools:** Node.js, npm

---

## 📦 Requirements

- PHP 8.1 or higher
- Composer
- Node.js & npm
- MySQL or PostgreSQL
- Git

---

## 🚀 Installation

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

### 4. Environment setup
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure your database
Edit `.env` and set your database credentials:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=paf_em_laravel
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Run migrations
```bash
php artisan migrate
```

### 7. Build assets
```bash
npm run dev
# or for production:
npm run build
```

### 8. Start the development server
```bash
php artisan serve
```

Visit `http://localhost:8000`

---

## 📁 Project Structure

```
├── app/                    # Application logic (Models, Controllers, Services)
├── resources/
│   ├── views/             # Blade templates (56.9% of codebase)
│   ├── css/               # CSS styles (1.3%)
│   └── js/                # JavaScript files (1.5%)
├── routes/                # Web and API routes
├── database/              # Migrations and seeders
├── public/                # Public-facing assets
├── config/                # Application configuration
├── tests/                 # Unit and feature tests
└── .env.example           # Environment template
```

---

## 🔧 Usage

### Running tests
```bash
php artisan test
```

### Database seeding
```bash
php artisan db:seed
```

### Clear cache
```bash
php artisan cache:clear
php artisan config:clear
```

### Compile assets for production
```bash
npm run build
```

---

## 📚 Documentation

- [Laravel Documentation](https://laravel.com/docs)
- [Blade Templating Engine](https://laravel.com/docs/blade)
- [Eloquent ORM](https://laravel.com/docs/eloquent)
- [Laravel Migrations](https://laravel.com/docs/migrations)

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

---

## 🐛 Bug Reports & Issues

Found a bug? Please create an issue on GitHub with:
- Clear description of the bug
- Steps to reproduce the issue
- Expected behavior
- Actual behavior
- Screenshots (if applicable)
- Your environment details (PHP version, OS, etc.)

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👤 Author

**Ruben Lima**
- GitHub: [@Ruben-Lima-1BTIS](https://github.com/Ruben-Lima-1BTIS)

---

## 🚀 Quick Commands Reference

| Command | Purpose |
|---------|---------|
| `php artisan serve` | Start development server |
| `php artisan migrate` | Run database migrations |
| `php artisan tinker` | Interactive shell |
| `npm run dev` | Build assets for development |
| `npm run build` | Build assets for production |
| `php artisan cache:clear` | Clear application cache |

---

**Last Updated:** 2026-04-18 15:38:19