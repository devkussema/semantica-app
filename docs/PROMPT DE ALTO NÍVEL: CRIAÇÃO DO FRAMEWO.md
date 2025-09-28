PROMPT DE ALTO NÍVEL: CRIAÇÃO DO FRAMEWORK "SEMÂNTICA" VIA COMPOSER
Crie a arquitetura completa para o Framework PHP modular chamado Semântica. O objetivo final é que novos projetos possam ser inicializados através do Composer: composer create-project semantica/app-skeleton <nome-do-projeto>.

A solução deve ser dividida em DOIS PACOTES instaláveis via Composer:

O CORE (semantica/core): Contém toda a lógica, bootstrapping, e classes utilitárias.

O ESQUELETO (semantica/app-skeleton): Contém a estrutura básica da aplicação (public/, app/, templates/, etc.) e depende do CORE.

Requisitos Essenciais do Sistema

O design da solução deve priorizar a semântica e a modularidade, seguindo o princípio da Separação de Preocupações (SOC).

1. Sistema de Templates Dinâmico (TemplateManager)

Crie uma classe central (ex: TemplateManager) que gerencie a visualização.

Deve ser possível trocar o tema/template ativo dinamicamente (ex: default, admin_v1, admin_v2).

A lógica do backend (Controllers/Models) deve ser totalmente desacoplada dos arquivos de visualização.

Crie arquivos de boilerplate para demonstrar a troca entre temas de front-end e versões de painel administrativo.

2. Flexibilidade de Conexão com Banco de Dados

Crie uma classe (ex: DatabaseManager) que use PDO para gerenciar múltiplas conexões (MySQL, PostgreSQL, etc.) simultaneamente.

A configuração deve ser externa (via arquivo de variáveis de ambiente), permitindo que o usuário escolha a conexão por nome (ex: DB_NAME=principal, DB_USER=root).

3. Ferramentas CLI Personalizadas

Inclua um bootstrapper de console (command.php) capaz de executar comandos personalizados.

Crie o boilerplate para comandos cruciais como:

migrate: Para rodar migrações de banco de dados.

make:controller: Para gerar novos arquivos de controlador.

Instruções de Implementação para o Copilot

Definir a Estrutura: O Copilot tem liberdade para definir a estrutura de pastas e a nomenclatura das classes (ex: App/Core/ ou Semantica/) desde que a separação entre CORE e ESQUELETO seja clara.

Geração de Repositórios: Apresente o conteúdo essencial para dois repositórios simulados, incluindo os arquivos composer.json e as classes e configurações cruciais.

Documentação: Crie um arquivo README.md conciso e claro para o semantica/app-skeleton, instruindo o usuário final sobre como:

Instalar o projeto (composer create-project).

Configurar o banco de dados.

Rodar comandos CLI.

Priorizar a Semântica: Use nomes de classes e métodos que reflitam claramente sua função (ex: DatabaseManager, setTheme, handleRequest).

Resultado Esperado (Output):

Conteúdo do composer.json para o semantica/core.

Exemplo de código para a classe ex: 'TemplateManager'.

Conteúdo do composer.json para o semantica/app-skeleton.

Exemplo do ponto de entrada (public/index.php) e do console (command.php) do esqueleto.

O README.md de instrução para o usuário final.

Autor: Augusto Kussema
podes criar o repo diretamente