# 🎯 Semantica Framework v2.0 - Modernized

> Modern, object-oriented PHP framework with fluent API and Laravel-inspired features.

**Desenvolvido por:** Augusto Kussema  
**Data:** 28 de setembro de 2025  
**Versão:** 2.0.0

## 🚀 What's New in v2.0

### ✨ **Modern CLI Tool (Similar to Artisan)**
```bash
# Instead of php command.php
./semantica serve                    # Start development server
./semantica make:controller PostController
./semantica make:model User
./semantica make:middleware AuthMiddleware
./semantica route:list              # List all routes
./semantica migrate                 # Run migrations
```

### 🎯 **Helper Functions (Laravel-style)**
```php
// Environment
env('APP_DEBUG', false)

// Configuration
config('app.name', 'Semantica')

// Paths
app_path('Controllers/UserController.php')
config_path('database.php')
storage_path('logs/app.log')
template_path('default/home.php')
public_path('assets/css/app.css')

// Views and Responses
view('home', ['title' => 'Welcome'])
response()->json(['status' => 'ok'])
redirect('/dashboard')
abort(404, 'Not found')

// Debug
dd($data)  // Dump and die
logger('User logged in', 'info')
```

### 🛣️ **Modern Routing System**
```php
// Named routes with constraints
$router->get('/users/{id}', 'UserController@show')
    ->name('users.show')
    ->where('id', '\d+');

// Route groups
$router->group(['prefix' => 'api', 'middleware' => ['auth']], function ($router) {
    $router->get('/users', 'UserController@apiIndex');
    $router->post('/users', 'UserController@store');
});

// Multiple HTTP methods
$router->match(['GET', 'POST'], '/contact', 'ContactController@handle');
$router->any('/webhook', 'WebhookController@handle');
```

### 🏗️ **Object-Oriented Architecture**
- **Dependency Injection Container**
- **Service Providers** (ready for implementation)
- **Route Model Binding** (ready for implementation)
- **Middleware System** (structure ready)

### 🔧 **Apache Configuration**
Included `.htaccess` files for both root and public directories with:
- Clean URLs
- Security headers
- Asset caching
- Protection for sensitive files

## 📦 Installation & Setup

### 1. **Basic Setup**
```bash
# Clone or download the framework
cd semantica-app-skeleton

# Copy environment file
cp .env.example .env

# Make CLI executable
chmod +x semantica

# Test CLI
./semantica
```

### 2. **Apache/Nginx Setup**
Point your web server to the `public/` directory, or use the root `.htaccess` for automatic redirection.

### 3. **Development Server**
```bash
./semantica serve          # Start on localhost:8000
./semantica serve 0.0.0.0  # Start on all interfaces
./semantica serve localhost 3000  # Custom port
```

## 🎮 **Available Commands**

### **Generation Commands**
```bash
./semantica make:controller ProductController
./semantica make:model Product
./semantica make:middleware AuthMiddleware
```

### **Database Commands**
```bash
./semantica migrate         # Run all migrations
```

### **Information Commands**
```bash
./semantica route:list      # Show all registered routes
```

### **Server Commands**
```bash
./semantica serve          # Start development server
```

## 🔧 **Configuration**

### **Environment Variables**
```env
# Application
APP_NAME="My Application"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://myapp.com

# Database
DB_DRIVER=mysql
DB_HOST=localhost
DB_DATABASE=my_app
DB_USERNAME=root
DB_PASSWORD=secret

# Templates
TEMPLATE_THEME=default
```

### **Helper Functions in Action**
```php
// Get configuration
$appName = config('app.name');
$dbHost = config('database.connections.mysql.host');

// Environment
$debug = env('APP_DEBUG', false);
$secret = env('APP_KEY');

// Paths
$configFile = config_path('database.php');
$logFile = storage_path('logs/app.log');
```

## 🛣️ **Modern Routing Examples**

### **Basic Routes**
```php
// routes/web.php
$router->get('/', function () {
    return view('welcome', ['title' => 'Home']);
})->name('home');

$router->post('/contact', function (Request $request) {
    $email = $request->post('email');
    // Process contact form
    return response()->json(['success' => true]);
})->name('contact.store');
```

### **Controller Routes**
```php
$router->get('/users', 'UserController@index')->name('users.index');
$router->get('/users/{id}', 'UserController@show')
    ->name('users.show')
    ->where('id', '\d+');
```

### **Route Groups**
```php
$router->group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function ($router) {
    $router->get('/dashboard', 'AdminController@dashboard');
    $router->get('/users', 'AdminController@users');
});
```

## 🎨 **Template System**

### **Helper Functions**
```php
// In controllers
return response(view('users.index', compact('users')));

// Direct usage
echo view('emails.welcome', ['user' => $user]);
```

### **Theme Switching**
```php
// Change theme programmatically
app('template')->setTema('admin_v1');

// Or via URL
GET /theme/admin_v1
```

## 📁 **Modern Project Structure**

```
semantica-app-skeleton/
├── app/
│   ├── Controllers/       # HTTP Controllers
│   ├── Models/           # Data Models
│   ├── Middleware/       # HTTP Middleware
│   └── Commands/         # CLI Commands
├── config/               # Configuration files
├── database/
│   └── migrations/       # Database migrations
├── public/               # Web server document root
│   ├── .htaccess        # Apache configuration
│   └── index.php        # Application entry point
├── routes/
│   └── web.php          # Route definitions
├── storage/
│   ├── cache/           # Application cache
│   └── logs/            # Log files
├── templates/           # View templates (by theme)
├── .env                 # Environment configuration
├── .htaccess           # Root Apache configuration
└── semantica           # CLI command (like artisan)
```

## 🚀 **Quick Start Example**

### 1. **Create a Controller**
```bash
./semantica make:controller BlogController
```

### 2. **Add Routes**
```php
// routes/web.php
$router->get('/blog', 'BlogController@index')->name('blog.index');
$router->get('/blog/{slug}', 'BlogController@show')->name('blog.show');
```

### 3. **Implement Controller**
```php
<?php
namespace App\Controllers;

use Semantica\Core\Http\Request;
use Semantica\Core\Http\Response;

class BlogController
{
    public function index(Request $request): Response
    {
        $posts = [
            ['title' => 'First Post', 'slug' => 'first-post'],
            ['title' => 'Second Post', 'slug' => 'second-post'],
        ];
        
        return response(view('blog.index', compact('posts')));
    }
    
    public function show(Request $request, string $slug): Response
    {
        $post = ['title' => 'Post Title', 'content' => 'Post content...'];
        
        return response(view('blog.show', compact('post')));
    }
}
```

### 4. **Create Templates**
```php
<!-- templates/default/blog/index.php -->
<div class="card">
    <h1>Blog Posts</h1>
    <?php foreach ($posts as $post): ?>
        <div class="post">
            <h3><?= htmlspecialchars($post['title']) ?></h3>
            <a href="/blog/<?= $post['slug'] ?>">Read more</a>
        </div>
    <?php endforeach; ?>
</div>
```

## 🔥 **Key Improvements**

✅ **CLI similar to Laravel's Artisan**  
✅ **Helper functions (env, config, paths, etc.)**  
✅ **Modern OOP routing with fluent API**  
✅ **Named routes and constraints**  
✅ **Route groups and middleware structure**  
✅ **Apache .htaccess configuration**  
✅ **Dependency injection container**  
✅ **English naming for better compatibility**  
✅ **Laravel-inspired API design**  

## 🎯 **Next Steps (Future Enhancements)**

- **Blade templating engine integration**
- **Eloquent ORM implementation**
- **Middleware pipeline**
- **Service providers**
- **Event system**
- **Queue system**
- **Mail system**

---

**Semantica Framework v2.0** - Modern PHP framework, desenvolvido com ❤️ em Angola 🇦🇴