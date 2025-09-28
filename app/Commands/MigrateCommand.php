<?php

declare(strict_types=1);

namespace App\Commands;

use Semantica\Core\Console\CommandInterface;
use Semantica\Core\Application;

/**
 * Comando para executar migrações de banco de dados
 * 
 * @author Augusto Kussema
 * @since 28 de setembro de 2025
 */
class MigrateCommand implements CommandInterface
{
    /**
     * Construtor do comando
     * 
     * @param Application $app Instância da aplicação
     */
    public function __construct(private Application $app)
    {
    }

    /**
     * Executa o comando de migração
     * 
     * @param array $args Argumentos do comando
     * @return int Código de saída
     */
    public function execute(array $args): int
    {
        echo "Executando migrações...\n";
        
        $migrationPath = $this->app->getBasePath() . '/database/migrations';
        
        if (!is_dir($migrationPath)) {
            echo "Diretório de migrações não encontrado: {$migrationPath}\n";
            return 1;
        }
        
        $migrations = glob($migrationPath . '/*.php');
        
        if (empty($migrations)) {
            echo "Nenhuma migração encontrada.\n";
            return 0;
        }
        
        sort($migrations);
        
        foreach ($migrations as $migration) {
            $migrationName = basename($migration, '.php');
            echo "Executando migração: {$migrationName}\n";
            
            try {
                $migrationClass = $this->loadMigration($migration);
                
                if ($migrationClass && method_exists($migrationClass, 'up')) {
                    $migrationClass->up($this->app->getDatabase());
                    echo "✓ Migração {$migrationName} executada com sucesso\n";
                } else {
                    echo "✗ Migração {$migrationName} inválida\n";
                }
                
            } catch (\Exception $e) {
                echo "✗ Erro na migração {$migrationName}: " . $e->getMessage() . "\n";
                return 1;
            }
        }
        
        echo "\nTodas as migrações foram executadas com sucesso!\n";
        return 0;
    }

    /**
     * Carrega uma migração
     * 
     * @param string $migrationFile Caminho do arquivo de migração
     * @return object|null
     */
    private function loadMigration(string $migrationFile): ?object
    {
        require_once $migrationFile;
        
        $className = $this->getMigrationClassName($migrationFile);
        
        if (class_exists($className)) {
            return new $className();
        }
        
        return null;
    }

    /**
     * Obtém o nome da classe de migração a partir do nome do arquivo
     * 
     * @param string $migrationFile Caminho do arquivo
     * @return string
     */
    private function getMigrationClassName(string $migrationFile): string
    {
        $filename = basename($migrationFile, '.php');
        
        // Remove timestamp do início (formato: YYYY_MM_DD_HHMMSS_nome_da_migracao)
        $parts = explode('_', $filename);
        if (count($parts) >= 5 && is_numeric($parts[0])) {
            // Remove os primeiros 4 elementos (ano, mês, dia, hora)
            $classNameParts = array_slice($parts, 4);
        } else {
            $classNameParts = $parts;
        }
        
        // Converte para PascalCase
        return implode('', array_map('ucfirst', $classNameParts));
    }

    /**
     * Obtém a descrição do comando
     * 
     * @return string
     */
    public function getDescription(): string
    {
        return 'Executa as migrações de banco de dados';
    }
}