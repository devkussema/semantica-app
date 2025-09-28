<div class="card">
    <h1><?= htmlspecialchars($titulo) ?></h1>
    
    <div class="alert alert-info">
        <strong>🎉 <?= htmlspecialchars($mensagem) ?></strong>
    </div>
    
    <p>Esta é a página inicial do seu framework Semântica! Aqui estão algumas informações úteis:</p>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin: 2rem 0;">
        <div class="card">
            <h3>📋 Informações do Sistema</h3>
            <ul style="list-style: none; padding: 0;">
                <li style="padding: 0.5rem 0; border-bottom: 1px solid #eee;"><strong>Versão:</strong> <?= htmlspecialchars($versao) ?></li>
                <li style="padding: 0.5rem 0; border-bottom: 1px solid #eee;"><strong>PHP:</strong> <?= phpversion() ?></li>
                <li style="padding: 0.5rem 0; border-bottom: 1px solid #eee;"><strong>Tema Atual:</strong> <?= htmlspecialchars($tema_atual) ?></li>
                <li style="padding: 0.5rem 0;"><strong>Memória:</strong> <?= round(memory_get_usage(true) / 1024 / 1024, 2) ?> MB</li>
            </ul>
        </div>
        
        <div class="card">
            <h3>🎨 Temas Disponíveis</h3>
            <p>Experimente trocar entre os temas disponíveis:</p>
            <div class="theme-selector">
                <?php foreach ($temas_disponiveis as $tema): ?>
                    <a href="/tema/<?= htmlspecialchars($tema) ?>" 
                       class="btn <?= $tema === $tema_atual ? 'btn-secondary' : '' ?>" 
                       style="margin: 0.25rem; display: inline-block;">
                        <?= ucfirst(htmlspecialchars($tema)) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <div class="card">
        <h3>🚀 Próximos Passos</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
            <div>
                <h4>1. Configure o Banco de Dados</h4>
                <p>Edite o arquivo <code>.env</code> com suas configurações de banco de dados.</p>
                <a href="/db-test" class="btn">Testar Conexão</a>
            </div>
            
            <div>
                <h4>2. Explore os Usuários</h4>
                <p>Veja como funciona o sistema de templates e controladores.</p>
                <a href="/usuarios" class="btn">Ver Usuários</a>
            </div>
            
            <div>
                <h4>3. Use os Comandos CLI</h4>
                <p>Execute <code>php command.php</code> para ver os comandos disponíveis.</p>
                <a href="#" class="btn btn-secondary">Documentação</a>
            </div>
            
            <div>
                <h4>4. API Status</h4>
                <p>Verifique o status da API do framework.</p>
                <a href="/api/status" class="btn">Ver Status</a>
            </div>
        </div>
    </div>
</div>

<style>
code {
    background: #f8f9fa;
    padding: 0.2rem 0.4rem;
    border-radius: 3px;
    font-family: 'Courier New', monospace;
    border: 1px solid #e9ecef;
}

h4 {
    color: #495057;
    margin-bottom: 0.5rem;
}

.card .card {
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}
</style>