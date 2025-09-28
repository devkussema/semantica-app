<?php

declare(strict_types=1);

/**
 * Web routes for the application
 * 
 * @author Augusto Kussema
 * @since 28 de setembro de 2025
 */

use Semantica\Core\Application;
use Semantica\Core\Http\Request;
use Semantica\Core\Http\Response;

$app = Application::getInstance();
$router = $app->getRouter();

// Home route
$router->get('/', function (Request $request) {
    $data = [
        'titulo' => 'Welcome to Semantica Framework',
        'mensagem' => 'Your modular PHP framework is working!',
        'versao' => '1.0.0',
        'tema_atual' => app('template')->getTemaAtivo(),
        'temas_disponiveis' => app('template')->listarTemas()
    ];
    
    return response(view('home', $data));
})->name('home');

// Theme switcher route
$router->get('/theme/{theme}', function (Request $request, string $theme) {
    try {
        app('template')->setTema($theme);
        
        return response()->json([
            'success' => true,
            'message' => "Theme changed to '{$theme}' successfully!",
            'current_theme' => app('template')->getTemaAtivo()
        ]);
    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 400);
    }
})->name('theme.switch');

// User routes with names and constraints
$router->get('/users', 'UserController@index')->name('users.index');
$router->get('/users/{id}', 'UserController@show')->name('users.show')->where('id', '\d+');
$router->post('/users', 'UserController@store')->name('users.store');

// Route groups example
$router->group(['prefix' => 'api', 'middleware' => ['api']], function ($router) {
    $router->get('/status', function () {
        return response()->json([
            'status' => 'ok',
            'framework' => 'Semantica',
            'version' => '1.0.0',
            'timestamp' => time(),
            'memory_usage' => memory_get_usage(true),
            'theme' => app('template')->getTemaAtivo()
        ]);
    })->name('api.status');
    
    $router->get('/users', 'UserController@apiIndex')->name('api.users.index');
});

// Rota de teste de banco de dados
$router->get('/db-test', function (Request $request) use ($app) {
    $db = $app->getDatabase();
    
    try {
        // Testa a conexão executando uma query simples
        $resultado = $db->buscar('SELECT 1 as teste, NOW() as agora');
        
        return Response::json([
            'success' => true,
            'message' => 'Conexão com banco de dados bem-sucedida!',
            'resultado' => $resultado[0] ?? null,
            'conexoes_ativas' => $db->listarConexoes()
        ]);
    } catch (Exception $e) {
        return Response::json([
            'success' => false,
            'message' => 'Erro na conexão com banco de dados: ' . $e->getMessage()
        ], 500);
    }
});

// Rota API exemplo
$router->get('/api/status', function (Request $request) use ($app) {
    return Response::json([
        'status' => 'ok',
        'framework' => 'Semântica',
        'versao' => '1.0.0',
        'timestamp' => time(),
        'memoria_usada' => memory_get_usage(true),
        'tema_ativo' => $app->getTemplate()->getTemaAtivo()
    ]);
});