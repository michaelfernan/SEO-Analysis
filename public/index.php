<?php
// Carrega automaticamente todas as classes e dependências do projeto, conforme definidas no composer.
require_once __DIR__ . '/../vendor/autoload.php';

// Inclui o arquivo de utilitários que provavelmente contém funções auxiliares para o projeto.
require_once __DIR__ . '/../src/utils.php';

// Inclui o arquivo responsável pela lógica de análise SEO.
require_once __DIR__ . '/../src/analyze.php';

// Usa a classe Dotenv para carregar variáveis de ambiente
use Dotenv\Dotenv;

// Inicializa o Dotenv para carregar as variáveis do arquivo .env na pasta config
$dotenv = Dotenv::createImmutable(__DIR__ . '/../config');
$dotenv->load();


$results = [];
// Inicializa a variável $results como um array vazio para armazenar os resultados da análise.

$error = '';
// Inicializa a variável $error como uma string vazia para armazenar mensagens de erro.

// Configurar as chaves das APIs
$keys = [
    'GOOGLE_API_KEY' => $_ENV['GOOGLE_API_KEY'], 
    // Obtém a chave da API do Google a partir das variáveis de ambiente.
    'MOZ_API_KEY' => $_ENV['MOZ_API_KEY'], 
    // Obtém a chave da API do Moz.
    'OPENGRAPH_API_KEY' => $_ENV['OPENGRAPH_API_KEY'], 
    // Obtém a chave da API do OpenGraph.
    'SERPSTACK_API_KEY' => $_ENV['SERPSTACK_API_KEY'], 
    // Obtém a chave da API do Serpstack.
];

// Processar requisição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se a requisição é do tipo POST.
    $url = trim($_POST['url'] ?? '');
    // Obtém a URL enviada no formulário, removendo espaços em branco extras.

    if (!$url || !filter_var($url, FILTER_VALIDATE_URL)) {
        // Verifica se a URL é vazia ou inválida.
        $error = 'URL inválida. Por favor, insira uma URL válida.';
        // Define uma mensagem de erro apropriada.
    } else {
        [$results, $error] = analyzeSEO($url, $keys);
        // Chama a função analyzeSEO para realizar a análise da URL e retorna os resultados e possíveis erros.
    }

    // Verificar se é uma requisição AJAX e retornar apenas os resultados
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        // Verifica se a requisição foi feita por AJAX.
        if ($error) {
            echo "<p style='color: red;'>Erro: " . htmlspecialchars($error) . "</p>";
            // Se houver um erro, exibe uma mensagem de erro formatada em vermelho.
        } else {
            foreach ($results as $api => $metrics) {
                // Itera sobre os resultados retornados de cada API.
                echo "<h3>" . htmlspecialchars($api) . "</h3>";
                // Exibe o nome da API de onde vieram os resultados.
                echo "<div class='charts-container'>";
                // Div para conter os gráficos relacionados às métricas.
                foreach ($metrics as $metric) {
                    // Itera sobre cada métrica retornada.
                    echo "<div class='chart-section'>";
                    // Cria uma seção para cada métrica com seus detalhes.
                    echo "<h4>" . htmlspecialchars($metric['Métrica'] ?? 'Erro') . ": " . htmlspecialchars($metric['Percentil'] ?? 0) . "%</h4>";
                    // Exibe o nome da métrica e o valor do percentil (ou 0, caso não esteja disponível).
                  
                    // Exibir Sugestão
                    if (!empty($metric['Sugestão'])) {
                        echo "<p><strong>Sugestão:</strong> " . htmlspecialchars($metric['Sugestão']) . "</p>";
                        // Exibe a sugestão fornecida pela métrica, se existir.
                    }
                    // Exibir Exemplo
                    if (!empty($metric['Exemplo'])) {
                        echo "<p><strong>Exemplo:</strong> " . htmlspecialchars($metric['Exemplo']) . "</p>";
                        // Exibe um exemplo fornecido pela métrica, se existir.
                    }
                    echo "<canvas width='200' height='200' data-percent='" . htmlspecialchars($metric['Percentil']) . "'></canvas>";
                    // Cria um elemento canvas para exibir o gráfico da métrica.
                    echo "</div>";
                }
                echo "</div>";
            }
        }
        exit; // Finaliza o script para evitar que o restante do código seja executado.
    }
}

// Renderizar a página completa caso não seja AJAX
require 'index.html';
// Inclui o arquivo HTML principal para renderizar a interface completa.
?>
