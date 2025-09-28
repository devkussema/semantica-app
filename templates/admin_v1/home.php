<div class="stats-grid">
    <div class="stat-card" style="border-left-color: #3498db;">
        <div class="stat-number">1.0.0</div>
        <div class="stat-label">Versão do Framework</div>
    </div>
    
    <div class="stat-card" style="border-left-color: #27ae60;">
        <div class="stat-number"><?= phpversion() ?></div>
        <div class="stat-label">Versão do PHP</div>
    </div>
    
    <div class="stat-card" style="border-left-color: #f39c12;">
        <div class="stat-number"><?= round(memory_get_usage(true) / 1024 / 1024, 1) ?>MB</div>
        <div class="stat-label">Memória Utilizada</div>
    </div>
    
    <div class="stat-card" style="border-left-color: #9b59b6;">
        <div class="stat-number"><?= htmlspecialchars($tema_atual) ?></div>
        <div class="stat-label">Tema Ativo</div>
    </div>
</div>

<div class="admin-card">
    <h2 style="margin-bottom: 1rem;">🎯 Semântica Framework - Painel Administrativo</h2>
    
    <div style="background: #e8f5e8; border: 1px solid #c3e6cb; color: #155724; padding: 1rem; border-radius: 5px; margin-bottom: 2rem;">
        <strong>✅ Sistema Funcionando!</strong> Bem-vindo ao painel administrativo v1 do framework Semântica.
    </div>
    
    <p style="margin-bottom: 2rem; color: #555;">
        Este é o tema administrativo do framework. Aqui você pode gerenciar usuários, 
        configurações e monitorar o sistema. Este tema demonstra como é fácil trocar 
        entre diferentes interfaces no framework Semântica.
    </p>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
        <div class="admin-card" style="margin: 0;">
            <h3 style="color: #2c3e50; margin-bottom: 1rem;">🚀 Ações Rápidas</h3>
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <a href="/usuarios" class="btn">Gerenciar Usuários</a>
                <a href="/db-test" class="btn btn-success">Testar Banco de Dados</a>
                <a href="/api/status" class="btn">Status da API</a>
            </div>
        </div>
        
        <div class="admin-card" style="margin: 0;">
            <h3 style="color: #2c3e50; margin-bottom: 1rem;">🎨 Alternar Tema</h3>
            <p style="margin-bottom: 1rem; color: #666;">Experimente os diferentes temas disponíveis:</p>
            <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                <?php foreach ($temas_disponiveis as $tema): ?>
                    <a href="/tema/<?= htmlspecialchars($tema) ?>" 
                       class="btn <?= $tema === $tema_atual ? 'btn-success' : '' ?>" 
                       style="font-size: 0.9rem; padding: 0.5rem 1rem;">
                        <?= ucfirst(str_replace('_', ' ', htmlspecialchars($tema))) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div class="admin-card">
    <h3 style="color: #2c3e50; margin-bottom: 1rem;">📊 Informações do Sistema</h3>
    
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa;">
                    <th style="padding: 1rem; text-align: left; border-bottom: 2px solid #dee2e6;">Componente</th>
                    <th style="padding: 1rem; text-align: left; border-bottom: 2px solid #dee2e6;">Status</th>
                    <th style="padding: 1rem; text-align: left; border-bottom: 2px solid #dee2e6;">Informação</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 1rem;">Framework</td>
                    <td style="padding: 1rem;"><span style="color: #27ae60;">✅ Ativo</span></td>
                    <td style="padding: 1rem;"><?= htmlspecialchars($versao) ?></td>
                </tr>
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 1rem;">Templates</td>
                    <td style="padding: 1rem;"><span style="color: #27ae60;">✅ Funcionando</span></td>
                    <td style="padding: 1rem;"><?= count($temas_disponiveis) ?> temas disponíveis</td>
                </tr>
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 1rem;">Roteamento</td>
                    <td style="padding: 1rem;"><span style="color: #27ae60;">✅ Funcionando</span></td>
                    <td style="padding: 1rem;">Sistema de rotas ativo</td>
                </tr>
                <tr>
                    <td style="padding: 1rem;">Banco de Dados</td>
                    <td style="padding: 1rem;"><span style="color: #f39c12;">⚠️ Não testado</span></td>
                    <td style="padding: 1rem;"><a href="/db-test" class="btn" style="padding: 0.25rem 0.75rem; font-size: 0.8rem;">Testar Agora</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>