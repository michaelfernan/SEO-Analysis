<?php
require_once 'utils.php';
// Inclui o arquivo utils.php, que contém funções ou utilitários necessários.

/**
 * Realiza a análise de SEO utilizando várias APIs.
 * 
 * @param string $url  A URL do site que será analisada.
 * @param array $keys  As chaves de acesso para as APIs utilizadas.
 * @return array       Retorna os resultados da análise e possíveis erros.
 */
function analyzeSEO($url, $keys)
{
    // Inicializa os resultados com categorias para cada API.
    $results = [
        'Google PageSpeed' => [],
        'SerpStack API' => [],
    ];
    $error = ''; // Variável para armazenar mensagens de erro.

    try {
        // Faz uma requisição à API Google PageSpeed para analisar o desempenho do site.
        $googleResponse = apiRequest('https://www.googleapis.com/pagespeedonline/v5/runPagespeed', [
            'url' => $url, // URL do site a ser analisado.
            'key' => $keys['GOOGLE_API_KEY'] // Chave de acesso à API do Google.
        ]);

        // Verifica se há métricas no relatório de experiência de carregamento.
        if (isset($googleResponse['loadingExperience']['metrics'])) {
            foreach ($googleResponse['loadingExperience']['metrics'] as $key => $metric) {
                // Processa cada métrica e converte os valores percentuais.
                $percentile = ($metric['percentile'] ?? 0) / 10; // Converte escala para 0-100.
                $example = getExampleForMetric($key); // Obtém exemplos para a métrica.

                // Adiciona os dados da métrica aos resultados.
                $results['Google PageSpeed'][] = [
                    'Métrica' => getMetricName($key), // Nome legível da métrica.
                    'Categoria' => $metric['category'] ?? 'UNKNOWN', // Categoria da métrica.
                    'Percentil' => $percentile, // Valor percentual da métrica.
                    'Exemplo' => $example['Exemplo'], // Exemplo relevante.
                    'Código' => $example['Código'], // Código ou detalhe técnico do exemplo.
                ];
            }
        }

        // Verifica se há auditorias no resultado do Lighthouse.
        if (isset($googleResponse['lighthouseResult']['audits'])) {
            foreach ($googleResponse['lighthouseResult']['audits'] as $auditKey => $audit) {
                if (isset($audit['score'])) {
                    // Processa auditorias e converte a pontuação em uma escala percentual.
                    $percentile = min($audit['score'] * 100, 100);
                    $results['Google PageSpeed'][] = [
                        'Métrica' => $audit['title'] ?? $auditKey, // Nome ou título da auditoria.
                        'Categoria' => $audit['scoreDisplayMode'] ?? 'UNKNOWN', // Tipo de exibição.
                        'Percentil' => $percentile, // Pontuação convertida em percentual.
                        'Sugestão' => $audit['description'] ?? 'Sem descrição.', // Descrição da métrica.
                    ];
                }
            }
        }
    } catch (Exception $e) {
        // Captura erros ao acessar a API do Google PageSpeed.
        $results['Google PageSpeed'][] = [
            'Métrica' => 'Erro',
            'Categoria' => 'ERROR',
            'Sugestão' => 'Erro ao acessar a API Google PageSpeed: ' . $e->getMessage(),
        ];
    }

    // Faz uma requisição à API SerpStack para obter informações de visibilidade nos motores de busca.
    try {
        $serpResponse = apiRequest('https://api.serpstack.com/search', [
            'query' => 'site:' . $url, // Pesquisa de resultados para o site.
            'access_key' => $keys['SERPSTACK_API_KEY'] // Chave de acesso à API SerpStack.
        ]);

        if (!empty($serpResponse['search_information'])) {
            // Adiciona as informações de busca ao resultado.
            $results['SerpStack API'][] = [
                'Métrica' => 'Total de Resultados',
                'Valor' => $serpResponse['search_information']['total_results'] ?? 'N/A',
                'Sugestão' => 'Aumente a visibilidade do site nos resultados de busca.',
            ];
        }
    } catch (Exception $e) {
        // Captura erros ao acessar a API SerpStack.
        $results['SerpStack API'][] = [
            'Métrica' => 'Erro',
            'Categoria' => 'ERROR',
            'Sugestão' => 'Erro ao acessar a API SerpStack: ' . $e->getMessage(),
        ];
    }

    // Filtra métricas inválidas para garantir que apenas métricas úteis sejam retornadas.
    foreach ($results as $api => $metrics) {
        $results[$api] = array_filter($metrics, function ($metric) {
            return isset($metric['Percentil']) && $metric['Percentil'] > 0;
        });
    }

    return [$results, $error];
    // Retorna os resultados processados e possíveis mensagens de erro.
}

/**
 * Faz uma solicitação para a API e retorna os dados.
 * 
 * @param string $url     O endpoint da API.
 * @param array $params   Os parâmetros da requisição.
 * @return array          Os dados retornados pela API em formato de array.
 * @throws Exception      Lança uma exceção caso ocorra um erro na conexão.
 */
function apiRequest($url, $params)
{
    $query = http_build_query($params);
    // Converte os parâmetros em uma string de consulta URL.

    $response = file_get_contents("{$url}?{$query}");
    // Faz a requisição para o endpoint com os parâmetros.

    if ($response === false) {
        // Lança uma exceção se a resposta for inválida.
        throw new Exception("Erro ao conectar ao endpoint: {$url}");
    }

    return json_decode($response, true);
    // Decodifica a resposta JSON em um array associativo.
}

?>
