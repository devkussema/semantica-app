<?php

declare(strict_types=1);

/**
 * Configurações de templates
 * 
 * @author Augusto Kussema
 * @since 28 de setembro de 2025
 */

return [
    // Tema padrão da aplicação
    'tema_padrao' => $_ENV['TEMPLATE_THEME'] ?? 'default',
    
    // Cache de templates (true para ativar)
    'cache' => filter_var($_ENV['TEMPLATE_CACHE'] ?? false, FILTER_VALIDATE_BOOLEAN),
    
    // Diretório de cache
    'cache_dir' => __DIR__ . '/../storage/cache/templates',
    
    // Configurações globais para todos os templates
    'variaveis_globais' => [
        'app_name' => $_ENV['APP_NAME'] ?? 'Semântica Framework',
        'app_version' => '1.0.0',
        'current_year' => date('Y'),
    ],
    
    // Temas disponíveis
    'temas_disponiveis' => [
        'default' => 'Tema Padrão',
        'admin_v1' => 'Painel Administrativo v1',
        'admin_v2' => 'Painel Administrativo v2',
        'blog' => 'Tema de Blog',
    ],
];