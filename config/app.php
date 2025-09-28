<?php

declare(strict_types=1);

/**
 * Configurações da aplicação
 * 
 * @author Augusto Kussema
 * @since 28 de setembro de 2025
 */

return [
    // Nome da aplicação
    'name' => $_ENV['APP_NAME'] ?? 'Semântica Framework',
    
    // Ambiente da aplicação (development, production, testing)
    'env' => $_ENV['APP_ENV'] ?? 'development',
    
    // Modo debug (true para desenvolvimento, false para produção)
    'debug' => filter_var($_ENV['APP_DEBUG'] ?? true, FILTER_VALIDATE_BOOLEAN),
    
    // URL base da aplicação
    'url' => $_ENV['APP_URL'] ?? 'http://localhost',
    
    // Timezone da aplicação
    'timezone' => $_ENV['APP_TIMEZONE'] ?? 'Africa/Luanda',
    
    // Codificação de caracteres
    'charset' => 'UTF-8',
    
    // Locale da aplicação
    'locale' => $_ENV['APP_LOCALE'] ?? 'pt_AO',
    
    // Chave de criptografia da aplicação (deve ser gerada)
    'key' => $_ENV['APP_KEY'] ?? 'base64:' . base64_encode(random_bytes(32)),
];