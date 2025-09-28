<?php

declare(strict_types=1);

namespace App\Commands;

use Semantica\Core\Console\CommandInterface;
use Semantica\Core\Application;

/**
 * Serve command - Start development server
 * 
 * @author Augusto Kussema
 * @since 28 de setembro de 2025
 */
class ServeCommand implements CommandInterface
{
    public function __construct(private Application $app)
    {
    }

    public function execute(array $args): int
    {
        $host = $args[0] ?? 'localhost';
        $port = (int) ($args[1] ?? 8000);
        
        $publicPath = public_path();
        
        if (!is_dir($publicPath)) {
            echo "Public directory not found: {$publicPath}\n";
            return 1;
        }
        
        $url = "http://{$host}:{$port}";
        
        echo "Semantica development server started: {$url}\n";
        echo "Document root is: {$publicPath}\n";
        echo "Press Ctrl+C to stop the server\n\n";
        
        // Start PHP built-in server
        $command = sprintf(
            'php -S %s:%d -t %s',
            escapeshellarg($host),
            $port,
            escapeshellarg($publicPath)
        );
        
        passthru($command);
        
        return 0;
    }

    public function getDescription(): string
    {
        return 'Start the development server';
    }
}