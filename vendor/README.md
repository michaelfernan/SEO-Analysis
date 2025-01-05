# SEO-Tool

**SEO-Tool** é uma ferramenta desenvolvida em **PHP** que permite analisar métricas de **SEO (Search Engine Optimization)** de websites. Projetada para ser executada em um ambiente Docker, é fácil de configurar e altamente portátil, oferecendo uma solução prática e eficiente para avaliar e otimizar o SEO de websites.

---

## 🗋 Funcionalidades

- 🔍 **Análise de métricas SEO** de websites.
- 📝 **Geração de relatórios** em PDF.
- ⚙️ **Configuração simplificada** com Docker.
- 🚧 **API** para integração com outros sistemas.

---

## 🚀 Tecnologias Utilizadas

- **PHP 8.1**
- **Docker**
- **Apache**
- **Composer**
- **FPDF**: Para geração de relatórios em PDF.
- **PHP Dotenv**: Gerenciamento de variáveis de ambiente.

---

## 🛠️ Pré-requisitos

Antes de começar, certifique-se de ter instalado:

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

---

## 🧑‍💻 Como Rodar o Projeto

1. **Clone o repositório:**

   ```bash
   git clone https://github.com/seu-usuario/SEO-Tool.git
   cd SEO-Tool
   ```

2. **Configure as variáveis de ambiente:**

   Crie um arquivo `.env` na pasta `config` e preencha com as informações necessárias:

   ```env
   DB_HOST=mysql
   DB_DATABASE=seo_tool
   DB_USERNAME=seu_usuario
   DB_PASSWORD=sua_senha
   ```

3. **Inicie os containers com Docker:**

   ```bash
   docker-compose up --build
   ```

4. **Acesse o projeto no navegador:**

   URL padrão: [http://localhost:8080](http://localhost:8080)

5. **Teste a API:**

   **Endpoint para análise de SEO:**

   ```bash
   curl -X POST http://localhost:8080/analyze \
        -H "Content-Type: application/json" \
        -d '{"url": "https://example.com"}'
   ```

---

## 📂 Estrutura do Projeto

```plaintext
.
├── config/          # Configurações do projeto
├── public/          # Arquivos públicos (HTML, JS, CSS)
├── src/             # Lógica do backend
├── vendor/          # Dependências instaladas pelo Composer
├── Dockerfile       # Configuração do ambiente Docker
├── docker-compose.yml # Orquestração de serviços com Docker Compose
└── README.md        # Documentação do projeto
```

---

## 🖋️ Créditos

Este projeto foi desenvolvido por curiosidade e como forma de aprender a implementação na linguagem **PHP**, uma linguagem que inicialmente eu não dominava completamente. Recebi suporte nas seguintes áreas:

- **Relatórios em PDF:** Implementados com orientação da desenvolvedora **Michelle**.
- **Implementação de funcionalidades em PHP:** Suporte da **inteligência artificial** na estruturação e integração da lógica do backend.

Agradeço a todos que contribuíram para o sucesso deste projeto! 🙏

---

## 📚 Licença

Este projeto é licenciado sob a [MIT License](LICENSE).

---

## 🤝 Contribuições

Contribuições são bem-vindas! Para contribuir, siga as etapas abaixo:

1. **Faça um fork do repositório.**
2. **Crie uma nova branch:**

   ```bash
   git checkout -b feature/sua-feature
   ```

3. **Faça suas alterações e commit:**

   ```bash
   git commit -m "Adiciona nova feature"
   ```

4. **Envie suas alterações:**

   ```bash
   git push origin feature/sua-feature
   ```

5. **Abra um pull request.**

---

## ✨ Autor

- **Michael Fernandes**  
  [GitHub](https://github.com/michaelfernan)  
  [LinkedIn] (https://www.linkedin.com/in/fernandes-michael/)
