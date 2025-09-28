<?php

declare(strict_types=1);

namespace App\Commands;

use Semantica\Core\Console\CommandInterface;
use Semantica\Core\Application;

/**
 * Make middleware command
 * 
 * @author Augusto Kussema
 * @since 28 de setembro de 2025
 */
class MakeMiddlewareCommand implements CommandInterface
{
    public function __construct(private Application $app)
    {
    }

    public function execute(array $args): int
    {
        if (empty($args)) {
            echo "Usage: make:middleware <MiddlewareName>\n";
            echo "Example: make:middleware AuthMiddleware\n";
            return 1;
        }
        
        $middlewareName = $args[0];
        
        // Ensure name ends with 'Middleware'
        if (!str_ends_with($middlewareName, 'Middleware')) {
            $middlewareName .= 'Middleware';
        }
        
        $middlewarePath = $this->app->basePath() . '/app/Middleware/' . $middlewareName . '.php';
        
        if (file_exists($middlewarePath)) {
            echo "Middleware {$middlewareName} already exists!\n";
            return 1;
        }
        
        // Create Middleware directory if it doesn't exist
        $middlewareDir = $this->app->basePath() . '/app/Middleware';
        if (!is_dir($middlewareDir)) {
            mkdir($middlewareDir, 0755, true);
        }
        
        $middlewareContent = $this->generateMiddlewareContent($middlewareName);
        
        if (file_put_contents($middlewarePath, $middlewareContent) === false) {
            echo "Error creating middleware {$middlewareName}\n";
            return 1;
        }
        
        echo "Middleware {$middlewareName} created successfully!\n";
        echo "File: {$middlewarePath}\n";
        
        return 0;
    }

    private function generateMiddlewareContent(string $middlewareName): string
    {
        $date = date('d \d\e F \d\e Y');
        
        return <<<PHP
<?php

declare(strict_types=1);

namespace App\Middleware;

use Semantica\Core\Http\Request;
use Semantica\Core\Http\Response;

/**
 * {$middlewareName} middleware
 * 
 * @author Augusto Kussema
 * @since {$date}
 */
class {$middlewareName}
{
    /**
     * Handle an incoming request
     * 
     * @param Request \$request
     * @param \Closure \$next
     * @return Response
     */
    public function handle(Request \$request, \Closure \$next): Response
    {
        // Process the request before passing to the next middleware/controller
        // Example: Check authentication, validate input, etc.
        
        // Continue to next middleware/controller
        \$response = \$next(\$request);
        
        // Process the response after the controller has handled the request
        // Example: Add headers, modify response, etc.
        
        return \$response;
    }
}
PHP;
    }

    public function getDescription(): string
    {
        return 'Generate a new middleware class';
    }
}