Prova de Laboratório de sofware

Este é um projeto desenvolvido em Laravel para gerenciar informações sobre filmes e séries, integrado com a API do TMDb (The Movie Database) para obter dados atualizados sobre filmes, como pôsteres, títulos e avaliações.
Funcionalidades Principais

    Autenticação e Autorização: Sistema de login seguro com autenticação de dois fatores opcional. Roles de usuário são implementadas para distinguir entre administradores e usuários padrão.

    Dashboard Principal: Exibe filmes recentes, populares, melhor avaliados e próximos lançamentos. Os dados são obtidos dinamicamente da API do TMDb e apresentados de forma atraente.

    Busca de Filmes: Capacidade de pesquisar filmes por título, com resultados instantâneos baseados em entrada de texto.

    Gerenciamento de Usuários: Funcionalidades CRUD para administradores gerenciarem usuários, incluindo criação, edição, exclusão e atribuição de funções.

    Detalhes de Filmes e Séries: Páginas detalhadas para cada filme ou série, exibindo informações como descrição, elenco, avaliações de usuários e trailers.

Tecnologias Utilizadas

    Laravel 11: Framework PHP poderoso e versátil para o desenvolvimento de aplicativos web.

    Tailwind CSS: Framework CSS para estilização responsiva e moderna, utilizado para criar layouts e componentes visuais.

    TMDb API: API externa utilizada para obter informações atualizadas sobre filmes, como pôsteres, títulos e avaliações.

    MySQL: Banco de dados relacional usado para armazenar dados do aplicativo, como informações de usuário, filmes favoritos e histórico de visualização.

Requisitos de Instalação

    Clone o repositório para sua máquina local.
    Configure o ambiente Laravel e instale as dependências do Composer.
    Configure o banco de dados MySQL e as credenciais de conexão.
    Execute as migrações do banco de dados para criar as tabelas necessárias.
    Configure a API do TMDb com suas credenciais de acesso (chave de API).

Como Contribuir

    Faça um fork do repositório e clone-o para sua máquina local.
    Crie uma nova branch para suas alterações (git checkout -b feature/nova-feature).
    Faça as alterações desejadas e adicione testes, se necessário.
    Faça push das suas alterações para o seu fork (git push origin feature/nova-feature).
    Abra um Pull Request para revisão.

Licença

Este projeto é licenciado sob a MIT License - sinta-se à vontade para usá-lo e modificá-lo conforme suas necessidades.
