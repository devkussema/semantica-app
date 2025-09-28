<!DOCTYPE html>
<html lang="pt-AO">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo ?? 'Admin - Semântica Framework') ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            color: #333;
        }
        
        .admin-layout {
            display: grid;
            grid-template-columns: 250px 1fr;
            grid-template-rows: 60px 1fr;
            grid-template-areas: 
                "sidebar header"
                "sidebar main";
            min-height: 100vh;
        }
        
        .admin-header {
            grid-area: header;
            background: #2c3e50;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .admin-sidebar {
            grid-area: sidebar;
            background: #34495e;
            color: white;
            overflow-y: auto;
        }
        
        .admin-main {
            grid-area: main;
            padding: 2rem;
            overflow-y: auto;
        }
        
        .sidebar-brand {
            padding: 1rem;
            font-size: 1.2rem;
            font-weight: bold;
            background: #2c3e50;
            text-align: center;
            border-bottom: 1px solid #4a5f7a;
        }
        
        .sidebar-nav {
            list-style: none;
            padding: 1rem 0;
        }
        
        .sidebar-nav li {
            margin: 0.5rem 0;
        }
        
        .sidebar-nav a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            transition: background 0.3s;
        }
        
        .sidebar-nav a:hover {
            background: #4a5f7a;
        }
        
        .sidebar-nav a.active {
            background: #3498db;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .user-avatar {
            width: 32px;
            height: 32px;
            background: #3498db;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .breadcrumb {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .breadcrumb-list {
            list-style: none;
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }
        
        .breadcrumb-list li::after {
            content: '/';
            margin-left: 0.5rem;
            color: #ccc;
        }
        
        .breadcrumb-list li:last-child::after {
            display: none;
        }
        
        .admin-card {
            background: white;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border-left: 4px solid #3498db;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #2c3e50;
        }
        
        .stat-label {
            color: #7f8c8d;
            margin-top: 0.5rem;
        }
        
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
            border: none;
            cursor: pointer;
        }
        
        .btn:hover {
            background: #2980b9;
        }
        
        .btn-success {
            background: #27ae60;
        }
        
        .btn-success:hover {
            background: #229954;
        }
        
        .btn-danger {
            background: #e74c3c;
        }
        
        .btn-danger:hover {
            background: #c0392b;
        }
        
        @media (max-width: 768px) {
            .admin-layout {
                grid-template-columns: 1fr;
                grid-template-rows: 60px 1fr;
                grid-template-areas: 
                    "header"
                    "main";
            }
            
            .admin-sidebar {
                display: none;
            }
            
            .admin-main {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <div class="sidebar-brand">
                🎯 Admin Panel
            </div>
            <nav>
                <ul class="sidebar-nav">
                    <li><a href="/" class="active">📊 Dashboard</a></li>
                    <li><a href="/usuarios">👥 Usuários</a></li>
                    <li><a href="/api/status">🔧 Sistema</a></li>
                    <li><a href="/db-test">💾 Banco de Dados</a></li>
                    <li><a href="#">⚙️ Configurações</a></li>
                    <li><a href="#">📈 Relatórios</a></li>
                    <li><a href="#">🎨 Temas</a></li>
                </ul>
            </nav>
        </aside>
        
        <header class="admin-header">
            <h1><?= htmlspecialchars($titulo ?? 'Dashboard') ?></h1>
            <div class="user-info">
                <span>Bem-vindo, Administrador</span>
                <div class="user-avatar">A</div>
            </div>
        </header>
        
        <main class="admin-main">
            <nav class="breadcrumb">
                <ul class="breadcrumb-list">
                    <li><a href="/">Início</a></li>
                    <li><?= htmlspecialchars($titulo ?? 'Dashboard') ?></li>
                </ul>
            </nav>
            
            <?= $conteudo ?>
        </main>
    </div>
</body>
</html>