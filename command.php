<?php

declare(strict_types=1);

/**
 * Console CLI para comandos personalizados
 * 
 * @author Augusto Kussema
 * @since 28 de setembro de 2025
 */

// Caminho base da aplicação
$basePath = __DIR__;

// Carrega o autoloader do Composer
require_once $basePath . '/vendor/autoload.php';

use Semantica\Core\Application;
use Semantica\Core\Console\CommandManager;
use App\Commands\MigrateCommand;
use App\Commands\MakeControllerCommand;

try {
    // Inicializa a aplicação
    $app = new Application($basePath);
    
    // Cria o gerenciador de comandos
    $commandManager = new CommandManager();
    
    // Registra comandos padrão
    $commandManager->register('migrate', new MigrateCommand($app));
    $commandManager->register('make:controller', new MakeControllerCommand($app));
    
    // Carrega comandos personalizados se existirem
    $commandsFile = $basePath . '/app/Commands/commands.php';
    if (file_exists($commandsFile)) {
        require_once $commandsFile;
    }
    
    // Executa o comando
    $exitCode = $commandManager->run($argv);
    exit($exitCode);
    
} catch (Throwable $e) {
    echo "Erro ao executar comando: " . $e->getMessage() . "\n";
    
    if (getenv('APP_DEBUG') === 'true') {
        echo $e->getTraceAsString() . "\n";
    }
    
    exit(1);
}