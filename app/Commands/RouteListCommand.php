<?php

declare(strict_types=1);

namespace App\Commands;

use Semantica\Core\Console\CommandInterface;
use Semantica\Core\Application;

/**
 * Route list command
 * 
 * @author Augusto Kussema
 * @since 28 de setembro de 2025
 */
class RouteListCommand implements CommandInterface
{
    public function __construct(private Application $app)
    {
    }

    public function execute(array $args): int
    {
        // Load routes
        $routesFile = routes_path('web.php');
        if (file_exists($routesFile)) {
            require_once $routesFile;
        }
        
        $router = $this->app->getRouter();
        $routes = $router->getRoutes();
        
        if (empty($routes)) {
            echo "No routes found.\n";
            return 0;
        }
        
        echo "\n";
        echo str_pad("METHOD", 8) . " | " . str_pad("URI", 30) . " | " . str_pad("NAME", 20) . " | ACTION\n";
        echo str_repeat("-", 80) . "\n";
        
        foreach ($routes as $route) {
            $method = str_pad($route->getMethod(), 8);
            $uri = str_pad($route->getUri(), 30);
            $name = str_pad($route->getName() ?? '-', 20);
            $action = is_string($route->getAction()) ? $route->getAction() : 'Closure';
            
            echo "{$method}| {$uri}| {$name}| {$action}\n";
        }
        
        echo "\n";
        echo "Total routes: " . count($routes) . "\n\n";
        
        return 0;
    }

    public function getDescription(): string
    {
        return 'List all registered routes';
    }
}