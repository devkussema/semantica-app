<?php

declare(strict_types=1);

namespace App\Controllers;

use Semantica\Core\Http\Request;
use Semantica\Core\Http\Response;
use Semantica\Core\Application;

/**
 * Controlador de usuários de exemplo
 * 
 * @author Augusto Kussema
 * @since 28 de setembro de 2025
 */
class UserController
{
    /**
     * Lista todos os usuários
     * 
     * @param Request $request Requisição HTTP
     * @return Response
     */
    public function index(Request $request): Response
    {
        $app = Application::getInstance();
        $template = $app->getTemplate();
        
        // Dados simulados
        $usuarios = [
            ['id' => 1, 'nome' => 'João Silva', 'email' => 'joao@exemplo.com'],
            ['id' => 2, 'nome' => 'Maria Santos', 'email' => 'maria@exemplo.com'],
            ['id' => 3, 'nome' => 'Pedro Costa', 'email' => 'pedro@exemplo.com'],
        ];
        
        $dados = [
            'titulo' => 'Lista de Usuários',
            'usuarios' => $usuarios,
            'total' => count($usuarios)
        ];
        
        $html = $template->renderizarComLayout('users/index', $dados);
        
        return new Response($html);
    }

    /**
     * Exibe um usuário específico
     * 
     * @param Request $request Requisição HTTP
     * @param string $id ID do usuário
     * @return Response
     */
    public function show(Request $request, string $id): Response
    {
        $app = Application::getInstance();
        $template = $app->getTemplate();
        
        // Simula busca de usuário
        $usuario = [
            'id' => $id,
            'nome' => 'Usuário ' . $id,
            'email' => 'usuario' . $id . '@exemplo.com',
            'criado_em' => date('d/m/Y H:i:s'),
            'ativo' => true
        ];
        
        $dados = [
            'titulo' => 'Detalhes do Usuário',
            'usuario' => $usuario
        ];
        
        $html = $template->renderizarComLayout('users/show', $dados);
        
        return new Response($html);
    }

    /**
     * Cria um novo usuário
     * 
     * @param Request $request Requisição HTTP
     * @return Response
     */
    public function store(Request $request): Response
    {
        $dados = [
            'nome' => $request->post('nome'),
            'email' => $request->post('email'),
            'senha' => $request->post('senha')
        ];
        
        // Validação simples
        if (empty($dados['nome']) || empty($dados['email'])) {
            return Response::json([
                'success' => false,
                'message' => 'Nome e email são obrigatórios'
            ], 400);
        }
        
        // Aqui você salvaria no banco de dados
        $novoUsuario = [
            'id' => rand(100, 999),
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'criado_em' => date('Y-m-d H:i:s')
        ];
        
        return Response::json([
            'success' => true,
            'message' => 'Usuário criado com sucesso!',
            'usuario' => $novoUsuario
        ], 201);
    }
}