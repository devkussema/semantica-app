<?php

declare(strict_types=1);

/**
 * Configurações de banco de dados
 * 
 * @author Augusto Kussema
 * @since 28 de setembro de 2025
 */

return [
    // Conexão padrão
    'padrao' => $_ENV['DB_CONNECTION'] ?? 'principal',
    
    // Configurações das conexões
    'conexoes' => [
        'principal' => [
            'driver' => $_ENV['DB_DRIVER'] ?? 'mysql',
            'host' => $_ENV['DB_HOST'] ?? 'localhost',
            'porta' => (int) ($_ENV['DB_PORT'] ?? 3306),
            'database' => $_ENV['DB_DATABASE'] ?? 'semantica',
            'usuario' => $_ENV['DB_USERNAME'] ?? 'root',
            'senha' => $_ENV['DB_PASSWORD'] ?? '',
            'charset' => $_ENV['DB_CHARSET'] ?? 'utf8mb4',
            'opcoes' => [
                PDO::ATTR_PERSISTENT => false,
                PDO::ATTR_TIMEOUT => 30,
            ]
        ],
        
        'teste' => [
            'driver' => 'sqlite',
            'database' => __DIR__ . '/../database/teste.sqlite',
        ],
        
        // Exemplo de conexão PostgreSQL
        'postgres' => [
            'driver' => 'pgsql',
            'host' => $_ENV['POSTGRES_HOST'] ?? 'localhost',
            'porta' => (int) ($_ENV['POSTGRES_PORT'] ?? 5432),
            'database' => $_ENV['POSTGRES_DATABASE'] ?? 'semantica',
            'usuario' => $_ENV['POSTGRES_USERNAME'] ?? 'postgres',
            'senha' => $_ENV['POSTGRES_PASSWORD'] ?? '',
        ],
    ],
];