<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1><?= htmlspecialchars($titulo) ?></h1>
        <a href="/usuarios" class="btn btn-secondary">← Voltar para Lista</a>
    </div>
    
    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem; align-items: start;">
        <div class="card">
            <div style="text-align: center; padding: 2rem;">
                <div style="width: 100px; height: 100px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem; font-weight: bold;">
                    <?= strtoupper(substr($usuario['nome'], 0, 1)) ?>
                </div>
                <h2 style="margin: 0; color: #2c3e50;"><?= htmlspecialchars($usuario['nome']) ?></h2>
                <p style="color: #7f8c8d; margin: 0.5rem 0;">ID: <?= htmlspecialchars($usuario['id']) ?></p>
                <div style="display: inline-block; padding: 0.25rem 0.75rem; background: <?= $usuario['ativo'] ? '#d4edda' : '#f8d7da' ?>; color: <?= $usuario['ativo'] ? '#155724' : '#721c24' ?>; border-radius: 20px; font-size: 0.9rem; margin-top: 1rem;">
                    <?= $usuario['ativo'] ? '✓ Ativo' : '✗ Inativo' ?>
                </div>
            </div>
        </div>
        
        <div class="card">
            <h3 style="margin-top: 0;">Informações Detalhadas</h3>
            
            <div style="display: grid; gap: 1rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; background: #f8f9fa; border-radius: 5px;">
                    <strong>Email:</strong>
                    <span><?= htmlspecialchars($usuario['email']) ?></span>
                </div>
                
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; background: #f8f9fa; border-radius: 5px;">
                    <strong>Data de Criação:</strong>
                    <span><?= htmlspecialchars($usuario['criado_em']) ?></span>
                </div>
                
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; background: #f8f9fa; border-radius: 5px;">
                    <strong>Status:</strong>
                    <span style="color: <?= $usuario['ativo'] ? '#28a745' : '#dc3545' ?>;">
                        <?= $usuario['ativo'] ? 'Conta Ativa' : 'Conta Inativa' ?>
                    </span>
                </div>
            </div>
            
            <div style="margin-top: 2rem; display: flex; gap: 1rem;">
                <button class="btn">Editar Usuário</button>
                <button class="btn btn-secondary">Desativar</button>
                <button class="btn" style="background: #e74c3c;" onclick="if(confirm('Tem certeza que deseja excluir este usuário?')) { alert('Função de exclusão não implementada ainda.'); }">Excluir</button>
            </div>
        </div>
    </div>
    
    <div class="card" style="margin-top: 2rem;">
        <h3>Atividades Recentes</h3>
        <div style="text-align: center; padding: 2rem; color: #7f8c8d;">
            <p>📊 Nenhuma atividade registrada ainda.</p>
            <small>As atividades do usuário aparecerão aqui quando disponíveis.</small>
        </div>
    </div>
</div>

<style>
.card .card {
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    margin-bottom: 0;
}

@media (max-width: 768px) {
    .card > div:first-child {
        grid-template-columns: 1fr !important;
        gap: 1rem !important;
    }
}
</style>