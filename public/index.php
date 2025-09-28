<?php

declare(strict_types=1);

/**
 * Ponto de entrada da aplicação Semântica
 * 
 * @author Augusto Kussema
 * @since 28 de setembro de 2025
 */

// Caminho base da aplicação
$basePath = dirname(__DIR__);

// Carrega o autoloader do Composer
require_once $basePath . '/vendor/autoload.php';

use Semantica\Core\Application;

try {
    // Inicializa a aplicação
    $app = new Application($basePath);
    
    // Carrega as rotas
    require_once $basePath . '/routes/web.php';
    
    // Run the application
    $app->run();
    
} catch (Throwable $e) {
    // Em produção, isso deve ser logado e uma página de erro amigável deve ser exibida
    if (getenv('APP_DEBUG') === 'true') {
        echo "<h1>Erro na aplicação</h1>";
        echo "<p><strong>Mensagem:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
        echo "<p><strong>Arquivo:</strong> " . htmlspecialchars($e->getFile()) . "</p>";
        echo "<p><strong>Linha:</strong> " . $e->getLine() . "</p>";
        echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    } else {
        echo "<h1>Oops! Algo deu errado</h1>";
        echo "<p>Tente novamente mais tarde.</p>";
    }
    
    http_response_code(500);
}