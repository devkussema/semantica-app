<?php

declare(strict_types=1);

namespace App\Commands;

use Semantica\Core\Console\CommandInterface;
use Semantica\Core\Application;

/**
 * Make model command
 * 
 * @author Augusto Kussema
 * @since 28 de setembro de 2025
 */
class MakeModelCommand implements CommandInterface
{
    public function __construct(private Application $app)
    {
    }

    public function execute(array $args): int
    {
        if (empty($args)) {
            echo "Usage: make:model <ModelName>\n";
            echo "Example: make:model User\n";
            return 1;
        }
        
        $modelName = $args[0];
        
        // Ensure name doesn't end with 'Model'
        if (str_ends_with($modelName, 'Model')) {
            $modelName = substr($modelName, 0, -5);
        }
        
        $className = $modelName . 'Model';
        $modelPath = $this->app->getBasePath() . '/app/Models/' . $className . '.php';
        
        if (file_exists($modelPath)) {
            echo "Model {$className} already exists!\n";
            return 1;
        }
        
        // Create Models directory if it doesn't exist
        $modelsDir = $this->app->getBasePath() . '/app/Models';
        if (!is_dir($modelsDir)) {
            mkdir($modelsDir, 0755, true);
        }
        
        $modelContent = $this->generateModelContent($className, $modelName);
        
        if (file_put_contents($modelPath, $modelContent) === false) {
            echo "Error creating model {$className}\n";
            return 1;
        }
        
        echo "Model {$className} created successfully!\n";
        echo "File: {$modelPath}\n";
        
        return 0;
    }

    private function generateModelContent(string $className, string $modelName): string
    {
        $date = date('d \d\e F \d\e Y');
        $tableName = strtolower($modelName) . 's';
        
        return <<<PHP
<?php

declare(strict_types=1);

namespace App\Models;

use Semantica\Core\Database\Model;

/**
 * {$className} model
 * 
 * @author Augusto Kussema
 * @since {$date}
 */
class {$className} extends Model
{
    /**
     * The table associated with the model
     */
    protected string \$table = '{$tableName}';

    /**
     * The attributes that are mass assignable
     */
    protected array \$fillable = [
        // Add your fillable attributes here
    ];

    /**
     * The attributes that should be hidden for serialization
     */
    protected array \$hidden = [
        // Add hidden attributes here (e.g., passwords)
    ];

    /**
     * Get all {$modelName} records
     */
    public static function all(): array
    {
        return static::query()->get();
    }

    /**
     * Find {$modelName} by ID
     */
    public static function find(int \$id): ?static
    {
        return static::query()->where('id', \$id)->first();
    }

    /**
     * Create new {$modelName}
     */
    public static function create(array \$attributes): static
    {
        \$instance = new static();
        \$instance->fill(\$attributes);
        \$instance->save();
        return \$instance;
    }
}
PHP;
    }

    public function getDescription(): string
    {
        return 'Generate a new model class';
    }
}