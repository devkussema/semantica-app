<?php

declare(strict_types=1);

use Semantica\Core\Database\DatabaseManager;

/**
 * Migração de exemplo para criar tabela de usuários
 * 
 * @author Augusto Kussema
 * @since 28 de setembro de 2025
 */
class CriarTabelaUsuarios
{
    /**
     * Executa a migração
     * 
     * @param DatabaseManager $db Gerenciador de banco de dados
     * @return void
     */
    public function up(DatabaseManager $db): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS usuarios (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nome VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL UNIQUE,
                senha_hash VARCHAR(255) NOT NULL,
                ativo BOOLEAN DEFAULT TRUE,
                criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ";
        
        $db->executar($sql);
        
        // Inserir alguns dados de exemplo
        $usuarios = [
            [
                'nome' => 'Augusto Kussema',
                'email' => 'augusto@semantica.dev',
                'senha_hash' => password_hash('123456', PASSWORD_DEFAULT)
            ],
            [
                'nome' => 'João Silva',
                'email' => 'joao@exemplo.com',
                'senha_hash' => password_hash('123456', PASSWORD_DEFAULT)
            ],
            [
                'nome' => 'Maria Santos',
                'email' => 'maria@exemplo.com',
                'senha_hash' => password_hash('123456', PASSWORD_DEFAULT)
            ]
        ];
        
        foreach ($usuarios as $usuario) {
            $db->executar(
                "INSERT INTO usuarios (nome, email, senha_hash) VALUES (?, ?, ?)",
                [$usuario['nome'], $usuario['email'], $usuario['senha_hash']]
            );
        }
    }

    /**
     * Desfaz a migração
     * 
     * @param DatabaseManager $db Gerenciador de banco de dados
     * @return void
     */
    public function down(DatabaseManager $db): void
    {
        $db->executar("DROP TABLE IF EXISTS usuarios");
    }
}