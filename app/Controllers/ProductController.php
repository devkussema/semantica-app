<?php

declare(strict_types=1);

namespace App\Controllers;

use Semantica\Core\Http\Request;
use Semantica\Core\Http\Response;
use Semantica\Core\Application;

/**
 * Controlador ProductController
 * 
 * @author Augusto Kussema
 * @since 28 de September de 2025
 */
class ProductController
{
    /**
     * Exibe a página inicial
     * 
     * @param Request $request Requisição HTTP
     * @return Response
     */
    public function index(Request $request): Response
    {
        $app = Application::getInstance();
        $template = $app->getTemplate();
        
        $dados = [
            'titulo' => 'Lista de Itens',
            'mensagem' => 'Bem-vindo ao ProductController!'
        ];
        
        $html = $template->renderizarComLayout('index', $dados);
        
        return new Response($html);
    }

    /**
     * Exibe um item específico
     * 
     * @param Request $request Requisição HTTP
     * @param string $id ID do item
     * @return Response
     */
    public function show(Request $request, string $id): Response
    {
        $app = Application::getInstance();
        $template = $app->getTemplate();
        
        $dados = [
            'titulo' => 'Detalhes do Item',
            'id' => $id,
            'item' => [
                'id' => $id,
                'nome' => 'Item ' . $id,
                'descricao' => 'Descrição do item ' . $id
            ]
        ];
        
        $html = $template->renderizarComLayout('show', $dados);
        
        return new Response($html);
    }

    /**
     * Processa dados via POST
     * 
     * @param Request $request Requisição HTTP
     * @return Response
     */
    public function store(Request $request): Response
    {
        $dados = $request->all();
        
        // Aqui você processaria os dados
        // Por exemplo, salvar no banco de dados
        
        return Response::json([
            'success' => true,
            'message' => 'Dados processados com sucesso',
            'data' => $dados
        ]);
    }
}