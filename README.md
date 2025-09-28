# 🚀 Semantica Framework - Application Skeleton

[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D8.0-blue.svg)](https://php.net/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
[![Framework](https://img.shields.io/badge/Framework-Semantica-purple.svg)](https://github.com/devkussema/semantica-core)
[![Version](https://img.shields.io/badge/Version-1.0.0-orange.svg)](https://github.com/devkussema/semantica-app/releases)

Modern PHP framework application skeleton inspired by Laravel's elegance and simplicity.

**Created by:** Augusto Kussema  
**Date:** September 28, 2025  
**Version:** 1.0.0

## 📦 Quick Start

```bash
# Install via Composer (replace <folder> with your project name)
composer create-project devkussema/semantica-app <folder>

# Navigate to project
cd <folder>

# Make CLI executable (Unix/Linux/macOS)
chmod +x semantica

# Start development server
./semantica serve
```

### Alternative Installation Methods

#### Option 1: Specific Version
```bash
composer create-project devkussema/semantica-app:^1.0 my-project
```

#### Option 2: Clone Repository
```bash
git clone https://github.com/devkussema/semantica-app.git my-project
cd my-project
composer install
cp .env.example .env
chmod +x semantica
```

## 🛠️ Initial Setup

1. **Environment Configuration:**
   ```bash
   # Copy environment file (done automatically by post-install script)
   cp .env.example .env
   
   # Edit your database and app settings
   nano .env
   ```

2. **Database Setup:**
   ```bash
   # Run migrations
   ./semantica migrate
   ```

3. **Start Development Server:**
   ```bash
   # Start built-in server (default: http://localhost:8000)
   ./semantica serve
   
   # Custom host and port
   ./semantica serve --host=127.0.0.1 --port=8080
   ```

## 🎯 Features

- **🚀 Laravel-inspired CLI** - Artisan-like command system
- **🔄 Modern Routing** - Fluent API with groups and middleware
- **🎨 Theme System** - Dynamic template switching
- **💾 Multi-Database** - MySQL, PostgreSQL, SQLite support
- **🧩 Helper Functions** - Laravel-style helper functions
- **📦 PSR-4 Autoloading** - Modern PHP standards
- **🛡️ Apache Ready** - Includes .htaccess for clean URLs

## 📚 Available Commands

### Framework Commands
```bash
./semantica list              # List all available commands
./semantica serve            # Start development server
./semantica migrate          # Run database migrations
./semantica route:list       # List all registered routes
```

### Code Generation
```bash
./semantica make:controller UserController    # Create controller
./semantica make:model User                   # Create model
./semantica make:middleware AuthMiddleware    # Create middleware
```

## 🏗️ Project Structure

```
project-root/
├── app/
│   ├── Commands/           # CLI commands
│   ├── Controllers/        # HTTP controllers
│   └── Models/            # Data models
├── config/                # Configuration files
│   ├── app.php           # App configuration
│   ├── database.php      # Database configuration
│   └── template.php      # Template configuration
├── database/
│   └── migrations/       # Database migrations
├── public/               # Web root directory
│   ├── index.php        # Application entry point
│   └── .htaccess        # Apache configuration
├── routes/
│   └── web.php          # Web routes
├── templates/           # View templates
│   ├── default/        # Default theme
│   └── admin_v1/       # Admin theme
├── .env.example        # Environment template
├── composer.json       # Composer dependencies
└── semantica          # CLI tool
```

## 🎨 Basic Usage

### Routing
```php
// routes/web.php
use Semantica\Core\Router;

Router::get('/', function() {
    return view('home');
});

Router::get('/users/{id}', function($id) {
    return view('users.show', ['id' => $id]);
});

// Route groups
Router::group(['prefix' => 'api'], function() {
    Router::get('/users', 'UserController@index');
    Router::post('/users', 'UserController@store');
});
```

### Controllers
```php
// app/Controllers/UserController.php
<?php

namespace App\Controllers;

class UserController
{
    public function index()
    {
        return view('users.index', [
            'users' => ['John', 'Jane', 'Bob']
        ]);
    }
    
    public function show($id)
    {
        return view('users.show', ['id' => $id]);
    }
}
```

### Views
```php
// templates/default/users/index.php
<?php $this->layout('layouts.main') ?>

<h1>Users</h1>
<ul>
    <?php foreach ($users as $user): ?>
        <li><?= htmlspecialchars($user) ?></li>
    <?php endforeach; ?>
</ul>
```

### Helper Functions
```php
// Available everywhere after bootstrap
$debug = env('APP_DEBUG', false);
$config = config('app.name');
$view = view('welcome', ['name' => 'World']);
```

## ⚙️ Configuration

### Database Configuration
```php
// config/database.php
return [
    'default' => 'mysql',
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', 3306),
            'database' => env('DB_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
        ],
    ],
];
```

### Environment Variables
```bash
# .env
APP_NAME="My Semantica App"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=my_database
DB_USERNAME=root
DB_PASSWORD=
```

## 🔧 Apache Configuration

For production with Apache, point your virtual host to the `public/` directory:

```apache
<VirtualHost *:80>
    DocumentRoot /path/to/your/project/public
    ServerName your-domain.com
    
    <Directory /path/to/your/project/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

## 🔄 Updating Framework

To update to newer versions:

```bash
# Update dependencies
composer update

# Check for new versions
composer show devkussema/semantica-core
```

## 🐛 Troubleshooting

### Common Issues

1. **"./semantica: Permission denied"**
   ```bash
   chmod +x semantica
   ```

2. **"Call to undefined function env()"**
   - Make sure you're running commands from the project root
   - Ensure `vendor/autoload.php` exists (run `composer install`)

3. **Database connection failed**
   - Check your `.env` file database settings
   - Ensure database server is running
   - Verify credentials

4. **404 errors with Apache**
   - Ensure mod_rewrite is enabled
   - Check that `.htaccess` files are present in root and `public/`
   - Verify Apache configuration allows `.htaccess` overrides

## 📖 Documentation

- [Core Framework](https://github.com/devkussema/semantica-core) - Engine documentation
- [API Reference](https://github.com/devkussema/semantica-core/wiki) - Detailed API docs
- [Examples](examples/) - Usage examples and tutorials

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- Inspired by [Laravel Framework](https://laravel.com/)
- Built with modern PHP 8.0+ features
- Designed for simplicity and productivity

---

**Created with ❤️ by [Augusto Kussema](https://github.com/devkussema)**