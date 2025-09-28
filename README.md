# 🚀 Semantica Framework

![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-blue)
![License](https://img.shields.io/badge/License-MIT-green)
![Version](https://img.shields.io/badge/Version-1.0.0-orange)
![Framework](https://img.shields.io/badge/Framework-Semantica-purple)

> Modern PHP framework inspired by Laravel's elegance with Portuguese-friendly architecture. Perfect for rapid development with a clean, semantic approach.

**Desenvolvido por:** Augusto Kussema  
**Data:** 28 de setembro de 2025  
**Versão:** 1.0.0

## 🚀 Instalação

### Via Composer (Recomendado)

```bash
composer create-project semantica/app-skeleton minha-aplicacao
cd minha-aplicacao
```

### Configuração Inicial

1. **Configure o arquivo de ambiente:**
   ```bash
   cp .env.example .env
   ```

2. **Edite o arquivo `.env` com suas configurações:**
   ```env
   APP_NAME="Minha Aplicação"
   APP_ENV=development
   APP_DEBUG=true
   APP_URL=http://localhost

   DB_HOST=localhost
   DB_DATABASE=minha_app
   DB_USERNAME=root
   DB_PASSWORD=sua_senha
   ```

3. **Instale as dependências:**
   ```bash
   composer install
   ```

4. **Configure seu servidor web** para apontar para a pasta `public/`

## 🏗️ Arquitetura

O framework é dividido em **dois pacotes principais:**

### 📦 Core (semantica/core)
- **Aplicação principal** (`Application.php`)
- **Gerenciador de templates** (`TemplateManager.php`) 
- **Gerenciador de banco de dados** (`DatabaseManager.php`)
- **Sistema HTTP** (Request, Response, Router)
- **Sistema CLI** (CommandManager)
- **Gerenciador de configuração** (`ConfigManager.php`)

### 🏠 App Skeleton (semantica/app-skeleton)
- **Estrutura da aplicação** (controllers, models, templates)
- **Configurações** (database, app, template)
- **Rotas** (`routes/web.php`)
- **Templates por tema**
- **Comandos CLI** personalizados

## 🎨 Sistema de Templates Dinâmico

### Troca de Temas
O framework permite trocar temas dinamicamente:

```php
$app = Application::getInstance();
$template = $app->getTemplate();

// Trocar tema
$template->setTema('admin_v1');

// Renderizar com layout
$html = $template->renderizarComLayout('home', $dados);
```

### Temas Disponíveis
- **default** - Tema padrão limpo e moderno
- **admin_v1** - Painel administrativo com sidebar
- **admin_v2** - Painel administrativo alternativo
- **blog** - Tema otimizado para blogs

### Estrutura de Templates
```
templates/
├── default/
│   ├── layouts/
│   │   └── main.php
│   ├── home.php
│   └── users/
│       ├── index.php
│       └── show.php
└── admin_v1/
    ├── layouts/
    │   └── main.php
    └── home.php
```

## 🗄️ Sistema de Banco de Dados

### Múltiplas Conexões
O framework suporta múltiplas conexões simultâneas:

```php
$db = $app->getDatabase();

// Conexão padrão
$usuarios = $db->buscar("SELECT * FROM usuarios");

// Conexão específica
$dados = $db->buscar("SELECT * FROM produtos", [], 'loja');

// Transações
$db->iniciarTransacao();
try {
    $db->executar("INSERT INTO usuarios (nome) VALUES (?)", ['João']);
    $db->executar("INSERT INTO perfis (usuario_id) VALUES (?)", [1]);
    $db->confirmarTransacao();
} catch (Exception $e) {
    $db->desfazerTransacao();
}
```

### Configuração de Conexões
```php
// config/database.php
'conexoes' => [
    'principal' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'app_principal',
        'usuario' => 'root',
        'senha' => 'senha'
    ],
    'loja' => [
        'driver' => 'pgsql',
        'host' => 'localhost',
        'database' => 'sistema_loja',
        'usuario' => 'postgres',
        'senha' => 'senha'
    ]
]
```

## 🛣️ Sistema de Roteamento

### Definindo Rotas
```php
// routes/web.php
$router = $app->getRouter();

// Rotas simples
$router->get('/', function($request) {
    return new Response('Olá Mundo!');
});

// Rotas com parâmetros
$router->get('/usuario/{id}', 'UserController@show');

// Rotas POST
$router->post('/usuarios', 'UserController@store');
```

### Controladores
```php
<?php

namespace App\Controllers;

use Semantica\Core\Http\Request;
use Semantica\Core\Http\Response;

class UserController
{
    public function show(Request $request, string $id): Response
    {
        $app = Application::getInstance();
        $template = $app->getTemplate();
        
        $dados = ['usuario' => $this->buscarUsuario($id)];
        $html = $template->renderizarComLayout('users/show', $dados);
        
        return new Response($html);
    }
}
```

## 🖥️ Comandos CLI

### Comandos Disponíveis

```bash
# Ver todos os comandos
php command.php

# Executar migrações
php command.php migrate

# Criar controlador
php command.php make:controller NomeController
```

### Criar Comandos Personalizados

```php
<?php

namespace App\Commands;

use Semantica\Core\Console\CommandInterface;

class MeuComando implements CommandInterface
{
    public function execute(array $args): int
    {
        echo "Executando meu comando personalizado!\n";
        return 0;
    }
    
    public function getDescription(): string
    {
        return 'Meu comando personalizado';
    }
}
```

## 🔧 Configuração

### Estrutura de Configuração
```
config/
├── app.php          # Configurações da aplicação
├── database.php     # Configurações de banco de dados
└── template.php     # Configurações de templates
```

### Usando Configurações
```php
$config = $app->getConfig();

// Obter configuração
$debug = $config->get('app.debug', false);
$host = $config->get('database.conexoes.principal.host');

// Definir configuração
$config->set('app.timezone', 'Africa/Luanda');
```

## 📁 Estrutura do Projeto

```
minha-aplicacao/
├── app/
│   ├── Controllers/        # Controladores
│   ├── Models/            # Modelos (implementar conforme necessário)
│   └── Commands/          # Comandos CLI personalizados
├── config/                # Arquivos de configuração
├── database/
│   └── migrations/        # Migrações de banco de dados
├── public/
│   └── index.php         # Ponto de entrada
├── routes/
│   └── web.php           # Definição de rotas
├── templates/            # Templates organizados por tema
│   ├── default/
│   └── admin_v1/
├── vendor/               # Dependências do Composer
├── .env                  # Variáveis de ambiente
├── .env.example         # Exemplo de variáveis de ambiente
├── command.php          # Console CLI
└── composer.json        # Configuração do Composer
```

## 🚦 Começando

### 1. Servidor de Desenvolvimento
```bash
# PHP Built-in Server
php -S localhost:8000 -t public/

# Ou configure no Apache/Nginx apontando para public/
```

### 2. Testar Instalação
Acesse: `http://localhost:8000`

### 3. Testar Banco de Dados
Acesse: `http://localhost:8000/db-test`

### 4. Ver Usuários de Exemplo
Acesse: `http://localhost:8000/usuarios`

### 5. Trocar Tema
Acesse: `http://localhost:8000/tema/admin_v1`

## 💡 Exemplos de Uso

### Criar uma Nova Página

1. **Criar rota:**
   ```php
   // routes/web.php
   $router->get('/produtos', 'ProductController@index');
   ```

2. **Criar controlador:**
   ```bash
   php command.php make:controller ProductController
   ```

3. **Criar template:**
   ```php
   <!-- templates/default/products/index.php -->
   <div class="card">
       <h1><?= htmlspecialchars($titulo) ?></h1>
       <!-- seu conteúdo aqui -->
   </div>
   ```

### Trabalhar com Banco de Dados

1. **Criar migração:**
   ```php
   // database/migrations/YYYY_MM_DD_HHMMSS_criar_tabela_produtos.php
   class CriarTabelaProdutos
   {
       public function up(DatabaseManager $db): void
       {
           $sql = "CREATE TABLE produtos (
               id INT PRIMARY KEY AUTO_INCREMENT,
               nome VARCHAR(255) NOT NULL,
               preco DECIMAL(10,2) NOT NULL
           )";
           $db->executar($sql);
       }
   }
   ```

2. **Executar migração:**
   ```bash
   php command.php migrate
   ```

## 🤝 Contribuindo

1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/nova-feature`)
3. Commit suas mudanças (`git commit -am 'Adiciona nova feature'`)
4. Push para a branch (`git push origin feature/nova-feature`)
5. Abra um Pull Request

## 📜 Licença

Este framework está licenciado sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

## 🆘 Suporte

- **Email:** augusto@semantica.dev
- **Documentação:** Em desenvolvimento
- **Issues:** Abra uma issue no repositório

---

**Semântica Framework** - Desenvolvido com ❤️ em Angola 🇦🇴