<?php

declare(strict_types=1);

namespace App\Commands;

use Semantica\Core\Console\CommandInterface;
use Semantica\Core\Application;

/**
 * Comando para gerar novos controladores
 * 
 * @author Augusto Kussema
 * @since 28 de setembro de 2025
 */
class MakeControllerCommand implements CommandInterface
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
     * Executa o comando de criação de controlador
     * 
     * @param array $args Argumentos do comando
     * @return int Código de saída
     */
    public function execute(array $args): int
    {
        if (empty($args)) {
            echo "Uso: make:controller <NomeDoControlador>\n";
            echo "Exemplo: make:controller UserController\n";
            return 1;
        }
        
        $controllerName = $args[0];
        
        // Garante que o nome termina com 'Controller'
        if (!str_ends_with($controllerName, 'Controller')) {
            $controllerName .= 'Controller';
        }
        
        $controllerPath = $this->app->getBasePath() . '/app/Controllers/' . $controllerName . '.php';
        
        if (file_exists($controllerPath)) {
            echo "Controlador {$controllerName} já existe!\n";
            return 1;
        }
        
        $controllerContent = $this->generateControllerContent($controllerName);
        
        if (file_put_contents($controllerPath, $controllerContent) === false) {
            echo "Erro ao criar o controlador {$controllerName}\n";
            return 1;
        }
        
        echo "Controlador {$controllerName} criado com sucesso!\n";
        echo "Arquivo: {$controllerPath}\n";
        
        return 0;
    }

    /**
     * Gera o conteúdo do controlador
     * 
     * @param string $controllerName Nome do controlador
     * @return string
     */
    private function generateControllerContent(string $controllerName): string
    {
        $date = date('d \d\e F \d\e Y');
        
        return <<<PHP
<?php

declare(strict_types=1);

namespace App\Controllers;

use Semantica\Core\Http\Request;
use Semantica\Core\Http\Response;
use Semantica\Core\Application;

/**
 * Controlador {$controllerName}
 * 
 * @author Augusto Kussema
 * @since {$date}
 */
class {$controllerName}
{
    /**
     * Exibe a página inicial
     * 
     * @param Request \$request Requisição HTTP
     * @return Response
     */
    public function index(Request \$request): Response
    {
        \$app = Application::getInstance();
        \$template = \$app->getTemplate();
        
        \$dados = [
            'titulo' => 'Lista de Itens',
            'mensagem' => 'Bem-vindo ao {$controllerName}!'
        ];
        
        \$html = \$template->renderizarComLayout('index', \$dados);
        
        return new Response(\$html);
    }

    /**
     * Exibe um item específico
     * 
     * @param Request \$request Requisição HTTP
     * @param string \$id ID do item
     * @return Response
     */
    public function show(Request \$request, string \$id): Response
    {
        \$app = Application::getInstance();
        \$template = \$app->getTemplate();
        
        \$dados = [
            'titulo' => 'Detalhes do Item',
            'id' => \$id,
            'item' => [
                'id' => \$id,
                'nome' => 'Item ' . \$id,
                'descricao' => 'Descrição do item ' . \$id
            ]
        ];
        
        \$html = \$template->renderizarComLayout('show', \$dados);
        
        return new Response(\$html);
    }

    /**
     * Processa dados via POST
     * 
     * @param Request \$request Requisição HTTP
     * @return Response
     */
    public function store(Request \$request): Response
    {
        \$dados = \$request->all();
        
        // Aqui você processaria os dados
        // Por exemplo, salvar no banco de dados
        
        return Response::json([
            'success' => true,
            'message' => 'Dados processados com sucesso',
            'data' => \$dados
        ]);
    }
}
PHP;
    }

    /**
     * Obtém a descrição do comando
     * 
     * @return string
     */
    public function getDescription(): string
    {
        return 'Gera um novo arquivo de controlador';
    }
}