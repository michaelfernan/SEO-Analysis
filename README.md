# Ferramenta de SEO Técnico

Este projeto é uma ferramenta de análise de SEO técnico que utiliza APIs e funcionalidades customizadas para avaliar o desempenho de sites, propondo melhorias estruturais e técnicas.

## **Funcionalidades**
- Análise de SEO utilizando APIs como Google PageSpeed, Moz, OpenGraph e SerpStack.
- Relatórios detalhados sobre desempenho, acessibilidade e otimização.
- Geração de relatórios em PDF diretamente pelo site.
- Sugestões de melhorias com exemplos e métricas baseadas em melhores práticas.

## **Como Configurar**
1. Clone o repositório:
   ```bash
   git clone https://github.com/seu-usuario/seo-tool.git
   ```
2. Navegue para o diretório do projeto:
   ```bash
   cd seo-tool
   ```
3. Configure o arquivo `.env` com suas chaves de API:
   ```plaintext
   GOOGLE_API_KEY=your-google-api-key-here
   MOZ_API_KEY=your-moz-api-key-here
   OPENGRAPH_API_KEY=your-opengraph-api-key-here
   SERPSTACK_API_KEY=your-serpstack-api-key-here
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=seo_tool
   DB_USERNAME=root
   DB_PASSWORD=your-password
   ```
4. Instale as dependências do PHP usando o Composer:
   ```bash
   composer install
   ```
5. Configure o servidor Apache utilizando o arquivo `config/apache2.conf`.

6. Execute o projeto:
   - Localmente com o PHP:
     ```bash
     php -S localhost:8080 -t public
     ```
   - Ou com Docker:
     ```bash
     docker-compose up
     ```

## **Arquitetura do Projeto**
- `config/`: Configurações do ambiente e servidor.
- `public/`: Arquivos públicos, incluindo o HTML, CSS, JS e o ponto de entrada (`index.php`).
- `src/`: Lógica principal do sistema, incluindo análise SEO e utilitários.
- `vendor/`: Dependências gerenciadas pelo Composer.

## **Desenvolvedores**
- **Michael Fernandes** ([LinkedIn](https://www.linkedin.com/in/fernandes-michael/)): Desenvolvedor backend, responsável pela integração de APIs e pela lógica de análise de SEO.
- **Michelle Fernando** ([LinkedIn](https://www.linkedin.com/in/mixchelle/)): Desenvolvedora frontend, auxiliou na criação do botão de exportação para PDF e na usabilidade geral do site.

## **APIs Utilizadas**
1. **Google PageSpeed**: Análise de desempenho e métricas de carregamento.
2. **SerpStack**: Coleta de dados de visibilidade e ranqueamento.
3. **Moz API**: Métricas de autoridade de domínio e backlinks.
4. **OpenGraph**: Verificação de meta tags para compartilhamento social.

## **Assistência de Inteligência Artificial**
Algumas implementações e correções contaram com o suporte de ferramentas de inteligência artificial, fornecendo sugestões e insights técnicos para otimizar o desempenho e a usabilidade do sistema.

## **Como Usar**
1. Acesse o site e insira a URL do site a ser analisado.
2. Clique em **"Analisar"** para iniciar a avaliação.
3. Veja os resultados na tela ou exporte-os em PDF.

## **Requisitos**
- PHP 8.1+
- Composer 2.0+
- Docker (opcional)
- Banco de Dados MySQL


## **Licença**
Este projeto é licenciado sob a [MIT License](LICENSE).
.

