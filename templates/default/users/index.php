<div class="card">
    <h1><?= htmlspecialchars($titulo) ?></h1>
    
    <p style="margin-bottom: 2rem;">
        <strong>Total de usuários:</strong> <?= htmlspecialchars($total) ?>
    </p>
    
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; background: white;">
            <thead>
                <tr style="background: #f8f9fa;">
                    <th style="padding: 1rem; text-align: left; border-bottom: 2px solid #dee2e6;">ID</th>
                    <th style="padding: 1rem; text-align: left; border-bottom: 2px solid #dee2e6;">Nome</th>
                    <th style="padding: 1rem; text-align: left; border-bottom: 2px solid #dee2e6;">Email</th>
                    <th style="padding: 1rem; text-align: left; border-bottom: 2px solid #dee2e6;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr style="border-bottom: 1px solid #dee2e6;">
                        <td style="padding: 1rem;"><?= htmlspecialchars($usuario['id']) ?></td>
                        <td style="padding: 1rem;"><?= htmlspecialchars($usuario['nome']) ?></td>
                        <td style="padding: 1rem;"><?= htmlspecialchars($usuario['email']) ?></td>
                        <td style="padding: 1rem;">
                            <a href="/usuarios/<?= htmlspecialchars($usuario['id']) ?>" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem;">
                                Ver Detalhes
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 2rem;">
        <h3>Criar Novo Usuário</h3>
        <form id="userForm" style="display: grid; gap: 1rem; max-width: 400px;">
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Nome:</label>
                <input type="text" name="nome" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px;">
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Email:</label>
                <input type="email" name="email" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px;">
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Senha:</label>
                <input type="password" name="senha" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px;">
            </div>
            
            <button type="submit" class="btn">Criar Usuário</button>
        </form>
        
        <div id="result" style="margin-top: 1rem;"></div>
    </div>
</div>

<script>
document.getElementById('userForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const resultDiv = document.getElementById('result');
    
    try {
        const response = await fetch('/usuarios', {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            resultDiv.innerHTML = `
                <div class="alert" style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 1rem; border-radius: 5px;">
                    <strong>Sucesso!</strong> ${data.message}
                    <br>
                    <small>Usuário ID: ${data.usuario.id}</small>
                </div>
            `;
            this.reset();
        } else {
            resultDiv.innerHTML = `
                <div class="alert" style="background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 1rem; border-radius: 5px;">
                    <strong>Erro!</strong> ${data.message}
                </div>
            `;
        }
    } catch (error) {
        resultDiv.innerHTML = `
            <div class="alert" style="background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 1rem; border-radius: 5px;">
                <strong>Erro!</strong> Falha na comunicação com o servidor.
            </div>
        `;
    }
});
</script>