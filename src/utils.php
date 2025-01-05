<?php
/**
 * Obtém um exemplo prático para uma métrica específica com base no identificador da métrica.
 *
 * @param string $key O identificador da métrica.
 * @return array Um array contendo um exemplo de implementação e código relacionado.
 */
function getExampleForMetric($key)
{
    $metrics = [
        'CUMULATIVE_LAYOUT_SHIFT_SCORE' => [
            'Exemplo' => 'Use a propriedade `width` e `height` explícitas em imagens e vídeos.',
            'Código' => '<img src="image.jpg" width="600" height="400" alt="Exemplo de imagem otimizada">',
        ],
        'EXPERIMENTAL_TIME_TO_FIRST_BYTE' => [
            'Exemplo' => 'Otimize o servidor com cache e compressão GZIP.',
            'Código' => '<FilesMatch "\\.(html|css|js|jpg|png|gif)$">\n    Header set Cache-Control "max-age=604800, public"\n</FilesMatch>',
        ],
        'FIRST_CONTENTFUL_PAINT_MS' => [
            'Exemplo' => 'Utilize fontes de sistema para evitar atrasos de carregamento.',
            'Código' => '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto&display=swap">',
        ],
        'INTERACTION_TO_NEXT_PAINT' => [
            'Exemplo' => 'Minimize scripts longos e divida tarefas pesadas em Web Workers.',
            'Código' => 'const worker = new Worker("worker.js"); worker.postMessage("Processar tarefa pesada");',
        ],
        'LARGEST_CONTENTFUL_PAINT_MS' => [
            'Exemplo' => 'Priorize o carregamento do maior elemento visível.',
            'Código' => '<link rel="preload" href="grande-imagem.jpg" as="image">',
        ],
        'Avoid multiple page redirects' => [
            'Exemplo' => 'Evite múltiplos redirecionamentos em páginas.',
            'Código' => '<meta http-equiv="refresh" content="0; URL=\"https://example.com\"">',
        ],
        'Preconnect to required origins' => [
            'Exemplo' => 'Pré-conecte a origens críticas.',
            'Código' => '<link rel="preconnect" href="https://critical-origin.com">',
        ],
        'Final Screenshot' => [
            'Exemplo' => 'Captura final do estado da página.',
            'Código' => '<img src="screenshot.png" alt="Captura final">',
        ],
        'Has a <meta name="viewport"> tag with width or initial-scale' => [
            'Exemplo' => 'Inclua a tag meta viewport para otimizar a responsividade.',
            'Código' => '<meta name="viewport" content="width=device-width, initial-scale=1">',
        ],
        'Serve images in next-gen formats' => [
            'Exemplo' => 'Use formatos de imagem modernos como WebP.',
            'Código' => '<img src="image.webp" alt="Exemplo de imagem moderna">',
        ],
        'Efficiently encode images' => [
            'Exemplo' => 'Otimize o tamanho das imagens para reduzir o tempo de carregamento.',
            'Código' => 'imagemin input.jpg output.jpg',
        ],
        'Preload Largest Contentful Paint image' => [
            'Exemplo' => 'Pré-carregue a maior imagem visível.',
            'Código' => '<link rel="preload" href="large-image.jpg" as="image">',
        ],
        'Max Potential First Input Delay' => [
            'Exemplo' => 'Divida tarefas longas em pequenos blocos para melhorar a interatividade.',
            'Código' => 'requestIdleCallback(() => { // tarefa });',
        ],
        'Avoid an excessive DOM size' => [
            'Exemplo' => 'Reduza a profundidade e complexidade do DOM.',
            'Código' => '<div id="otimizado"></div>',
        ],
        'Diagnostics' => [
            'Exemplo' => 'Inclua métricas de diagnóstico para identificar gargalos.',
            'Código' => '<script>console.log("Diagnóstico iniciado");</script>',
        ],
        'Avoid non-composited animations' => [
            'Exemplo' => 'Evite animações não compostas para melhorar a performance.',
            'Código' => '<style>transform: translateX(50px);</style>',
        ],
        'Avoid serving legacy JavaScript to modern browsers' => [
            'Exemplo' => 'Use recursos modernos de JavaScript para navegadores atuais.',
            'Código' => '<script type="module" src="script.js"></script>',
        ],
        'Network Round Trip Times' => [
            'Exemplo' => 'Otimize o RTT usando servidores mais próximos.',
            'Código' => '<link rel="dns-prefetch" href="https://example.com">',
        ],
        'Avoids document.write()' => [
            'Exemplo' => 'Evite o uso de document.write para adicionar conteúdo.',
            'Código' => '<script>document.getElementById("example").innerText = "Hello!";</script>',
        ],
        'Reduce unused CSS' => [
            'Exemplo' => 'Remova CSS não utilizado para melhorar o desempenho.',
            'Código' => 'purgecss --css styles.css --content index.html',
        ],
        'Network Requests' => [
            'Exemplo' => 'Minimize o número de solicitações de rede.',
            'Código' => '<script>console.log("Solicitações reduzidas");</script>',
        ],
        'Speed Index' => [
            'Exemplo' => 'Melhore o índice de velocidade otimizando o carregamento.',
            'Código' => '<link rel="stylesheet" href="optimized-style.css">',
        ],
        'Use video formats for animated content' => [
            'Exemplo' => 'Substitua GIFs por vídeos mais eficientes.',
            'Código' => '<video src="animation.mp4" autoplay loop muted></video>',
        ],
        'JavaScript execution time' => [
            'Exemplo' => 'Reduza o tempo de execução de scripts JavaScript.',
            'Código' => 'uglifyjs input.js -o output.min.js',
        ],
        'Lazy load third-party resources with facades' => [
            'Exemplo' => 'Use carregamento lento para recursos de terceiros.',
            'Código' => '<script async src="third-party.js"></script>',
        ],
        'Largest Contentful Paint element' => [
            'Exemplo' => 'Priorize o carregamento do maior elemento visível.',
            'Código' => '<img src="image.jpg" alt="Maior elemento" loading="eager">',
        ],
        'Eliminate render-blocking resources' => [
            'Exemplo' => 'Remova ou adie recursos que bloqueiam renderização.',
            'Código' => '<script src="script.js" defer></script>',
        ],
        'Minimize main-thread work' => [
            'Exemplo' => 'Divida tarefas em pequenos pedaços para evitar bloqueios.',
            'Código' => 'setTimeout(() => { // tarefa });',
        ],
        'Properly size images' => [
            'Exemplo' => 'Use imagens do tamanho correto para o dispositivo.',
            'Código' => '<img src="small.jpg" media="(max-width: 600px)">',
        ],
        'Total Blocking Time' => [
            'Exemplo' => 'Reduza tarefas longas que bloqueiam a thread principal.',
            'Código' => 'performance.mark("Tarefa concluída");',
        ],
        'Screenshot Thumbnails' => [
            'Exemplo' => 'Capture miniaturas para rastrear o progresso de carregamento.',
            'Código' => '<img src="thumbnail.png" alt="Miniatura">',
        ],
        'Script Treemap Data' => [
            'Exemplo' => 'Use mapas de calor para identificar problemas em scripts.',
            'Código' => '<div id="treemap"></div>',
        ],
        'Tasks' => [
            'Exemplo' => 'Liste tarefas críticas na thread principal.',
            'Código' => '<script>console.table(performance.getEntriesByType("task"));</script>',
        ],
        'User Timing marks and measures' => [
            'Exemplo' => 'Meça pontos de desempenho na execução de código.',
            'Código' => '<script>performance.mark("Start");</script>',
        ],
        'Avoid large layout shifts' => [
            'Exemplo' => 'Evite grandes alterações no layout.',
            'Código' => '<style>.fixed-dimension { width: 100px; height: 50px; }</style>',
        ],
        'Reduce unused JavaScript' => [
            'Exemplo' => 'Remova scripts não utilizados para melhorar o desempenho.',
            'Código' => 'webpack --optimize-minimize',
        ],
        'Initial server response time was short' => [
            'Exemplo' => 'Reduza o tempo de resposta inicial do servidor.',
            'Código' => '<meta http-equiv="cache-control" content="max-age=3600">',
        ],
        'Time to Interactive' => [
            'Exemplo' => 'Reduza o tempo até que a página fique interativa.',
            'Código' => '<script>setTimeout(()=>{}, 1000);</script>',
        ],
        'Defer offscreen images' => [
            'Exemplo' => 'Adie o carregamento de imagens fora da tela.',
            'Código' => '<img src="offscreen.jpg" loading="lazy">',
        ],
        'Remove duplicate modules in JavaScript bundles' => [
            'Exemplo' => 'Remova módulos duplicados de pacotes JS.',
            'Código' => 'npm dedupe',
        ],
        'Metrics' => [
            'Exemplo' => 'Colete todas as métricas disponíveis.',
            'Código' => '<script>console.log(performance.getEntries());</script>',
        ],
        'Browser Compatibility' => [
            'Exemplo' => 'Assegure-se de que o código funcione em navegadores modernos e antigos.',
            'Código' => '<script>if (!window.Promise) { console.warn("Promise não suportado"); }</script>',
        ],
        'Trust and Safety' => [
            'Exemplo' => 'Implemente proteções contra scripts maliciosos.',
            'Código' => '<meta http-equiv="Content-Security-Policy" content="default-src \'self\'">',
        ],
        'Mobile Friendly' => [
            'Exemplo' => 'Certifique-se de que o site é responsivo.',
            'Código' => '<meta name="viewport" content="width=device-width, initial-scale=1">',
        ],
        'Crawling and Indexing' => [
            'Exemplo' => 'Otimize para crawlers e indexação.',
            'Código' => '<meta name="robots" content="index, follow">',
        ],
        'Contrast' => [
            'Exemplo' => 'Assegure-se de que o contraste está acessível.',
            'Código' => '<style>body { color: #333; background: #fff; }</style>',
        ],
        'Audio and video' => [
            'Exemplo' => 'Implemente players compatíveis para mídia.',
            'Código' => '<audio controls src="audio.mp3"></audio>',
        ],
        'Tables and lists' => [
            'Exemplo' => 'Estruture dados tabulares corretamente.',
            'Código' => '<table><thead><tr><th>Header</th></tr></thead><tbody><tr><td>Data</td></tr></tbody></table>',
        ],
        'Navigation' => [
            'Exemplo' => 'Forneça navegação acessível.',
            'Código' => '<nav><a href="#">Home</a><a href="#">Sobre</a></nav>',
        ],
        'Best practices' => [
            'Exemplo' => 'Adote boas práticas de desenvolvimento.',
            'Código' => '<!-- Comentário explicativo para desenvolvedores -->',
        ],
        'ARIA' => [
            'Exemplo' => 'Assegure-se de que os elementos interativos tenham suporte ARIA.',
            'Código' => '<button aria-label="Enviar">Enviar</button>',
        ],
        'Enable text compression' => [
            'Exemplo' => 'Habilite a compressão GZIP ou Brotli no servidor.',
            'Código' => 'AddOutputFilterByType DEFLATE text/html text/css application/javascript',
        ],
        'Ensure text remains visible during webfont load' => [
            'Exemplo' => 'Use a propriedade `font-display: swap` para evitar texto invisível.',
            'Código' => '<style>@font-face { font-family: "MyFont"; src: url("myfont.woff2") format("woff2"); font-display: swap; }</style>',
        ],
        'Minify JavaScript' => [
            'Exemplo' => 'Minifique seus arquivos JavaScript para reduzir o tamanho.',
            'Código' => 'uglifyjs script.js -o script.min.js',
        ],
        'Minify CSS' => [
            'Exemplo' => 'Minifique seus arquivos CSS para melhorar a performance.',
            'Código' => 'csso styles.css --output styles.min.css',
        ],
        'Server Backend Latencies' => [
            'Exemplo' => 'Reduza a latência no backend otimizando consultas ao banco de dados.',
            'Código' => '$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);',
        ],


        'Avoids enormous network payloads' => [
            'Exemplo' => 'Reduza o tamanho das respostas do servidor, removendo dados desnecessários.',
            'Código' => '<FilesMatch "\\.(html|css|js)$">\n    SetOutputFilter DEFLATE\n</FilesMatch>',
        ],
        'Avoid chaining critical requests' => [
            'Exemplo' => 'Evite cadeias de solicitações, carregando recursos críticos em paralelo.',
            'Código' => '<link rel="preload" href="styles.css" as="style">',
        ],
        'Largest Contentful Paint image was not lazily loaded' => [
            'Exemplo' => 'Certifique-se de que a imagem do LCP seja carregada de forma prioritária.',
            'Código' => '<img src="lcp-image.jpg" loading="eager">',
        ],
        'Minimize third-party usage' => [
            'Exemplo' => 'Reduza dependências de bibliotecas de terceiros sempre que possível.',
            'Código' => '<script src="meu-script.js"></script>',
        ],
        'Avoid long main-thread tasks' => [
            'Exemplo' => 'Divida tarefas longas para evitar bloqueios na thread principal.',
            'Código' => 'requestAnimationFrame(() => { // tarefa });',
        ],
        'Image elements have explicit width and height' => [
            'Exemplo' => 'Adicione dimensões fixas às imagens para evitar layout shifts.',
            'Código' => '<img src="image.jpg" width="800" height="600" alt="Imagem com dimensões definidas">',
        ],

        'First Meaningful Paint' => [
            'Exemplo' => 'Otimize o carregamento do conteúdo acima da dobra para melhorar a experiência inicial.',
            'Código' => '<link rel="preload" href="important-style.css" as="style">',
        ],
        'Largest Contentful Paint' => [
            'Exemplo' => 'Garanta que o maior elemento de conteúdo visível seja carregado rapidamente.',
            'Código' => '<img src="hero-image.jpg" loading="eager">',
        ],
        'First Contentful Paint' => [
            'Exemplo' => 'Minimize o tempo para o primeiro conteúdo visível aparecer no navegador.',
            'Código' => '<script>console.log("FCP otimizado");</script>',
        ],
        'Serve static assets with an efficient cache policy' => [
            'Exemplo' => 'Implemente políticas de cache para recursos estáticos.',
            'Código' => '<FilesMatch "\\.(html|css|js)$">\n    Header set Cache-Control "max-age=31536000, public"\n</FilesMatch>',
        ],
        'Content Best Practices' => [
            'Exemplo' => 'Use práticas recomendadas para fornecer conteúdo claro e organizado.',
            'Código' => '<meta name="description" content="Descrição clara do conteúdo da página">',
        ],

        'User Experience' => [
            'Exemplo' => 'Garanta que o site seja fácil de usar e acessível.',
            'Código' => '<a href="#content" class="skip-to-content">Pular para o conteúdo</a>',
        ],

        'Names and labels' => [
            'Exemplo' => 'Certifique-se de que todos os campos de formulário possuem labels claros.',
            'Código' => '<label for="email">Email:</label><input type="email" id="email" name="email">',
        ],
        'Internationalization and localization' => [
            'Exemplo' => 'Implemente suporte a múltiplos idiomas e formatação local.',
            'Código' => '<meta name="language" content="pt-BR">',
        ],
        'CUMULATIVE_LAYOUT_SHIFT' => [
            'Exemplo' => 'Adicione dimensões fixas para imagens e elementos para evitar alterações no layout.',
            'Código' => '<img src="image.jpg" width="600" height="400" alt="Imagem com dimensões fixas">',
        ],
        'DOES_NOT_USE_PASSIVE_LISTENERS' => [
            'Exemplo' => 'Adicione `passive: true` a ouvintes de eventos de rolagem para melhorar o desempenho.',
            'Código' => '<script>window.addEventListener("scroll", handler, { passive: true });</script>',
        ],
        'AVOID_CHAINING_CRITICAL_REQUESTS' => [
            'Exemplo' => 'Evite cadeias de solicitações e carregue os recursos críticos em paralelo.',
            'Código' => '<link rel="preload" href="style.css" as="style"><link rel="preload" href="script.js" as="script">',
        ],
        'PERFORMANCE' => [
            'Exemplo' => 'Meça e monitore o desempenho geral usando métricas e ferramentas.',
            'Código' => '<script>console.log(performance.now());</script>',
        ],
        'RESOURCES_SUMMARY' => [
            'Exemplo' => 'Analise o resumo dos recursos para identificar excessos ou gargalos.',
            'Código' => '<script>console.table(performance.getEntriesByType("resource"));</script>',
        ],

        'GENERAL' => [
            'Exemplo' => 'Adote boas práticas gerais como títulos claros e navegação intuitiva.',
            'Código' => '<title>Página otimizada</title><nav><a href="#section">Seção</a></nav>',
        ],


    ];




    return $metrics[$key] ?? [
        'Exemplo' => 'Sem exemplo disponível para esta métrica.',
        'Código' => '',
    ];
}


/**
 * Obtém o nome amigável de uma métrica com base no identificador.
 *
 * @param string $key O identificador da métrica.
 * @return string O nome amigável da métrica.
 */
function getMetricName($key)
{

    // Remove espaços extras e converte a chave para minúsculas para normalizar
    $normalizedKey = strtolower(trim($key));

    $metricNames = [
        'minimize_third_party_usage' => 'Minimizar uso de terceiros',
        'Minimize third-party usage' => 'banaba split',
        'cumulative_layout_shift_score' => 'Estabilidade Visual (CLS)',
        'experimental_time_to_first_byte' => 'Tempo de Resposta do Servidor (TTFB)',
        'first_contentful_paint_ms' => 'Tempo para Primeiro Conteúdo (FCP)',
        'interaction_to_next_paint' => 'Tempo para Resposta (INP)',
        'largest_contentful_paint_ms' => 'Maior Elemento Visível (LCP)',
        'avoid_multiple_page_redirects' => 'Evitar múltiplos redirecionamentos de página',
        'preconnect_to_required_origins' => 'Pré-conectar às origens necessárias',
        'final_screenshot' => 'Captura de Tela Final',
        'has_a_meta_name_viewport_tag_with_width_or_initial_scale' => 'Tag <meta name="viewport"> presente',
        'serve_images_in_next_gen_formats' => 'Servir imagens em formatos de próxima geração',
        'efficiently_encode_images' => 'Codificar imagens de forma eficiente',
        'preload_largest_contentful_paint_image' => 'Pré-carregar a maior imagem do LCP',
        'max_potential_first_input_delay' => 'Atraso Potencial Máximo de Primeira Interação (FID)',
        'avoid_an_excessive_dom_size' => 'Evitar tamanho excessivo do DOM',
        'diagnostics' => 'Diagnósticos',
        'avoid_non_composited_animations' => 'Evitar animações não compostas',
        'avoids_enormous_network_payloads' => 'Evitar cargas de rede enormes',
        'does_not_use_passive_listeners_to_improve_scrolling_performance' => 'Não usa listeners passivos para rolagem',
        'avoid_chaining_critical_requests' => 'Evitar encadeamento de solicitações críticas',
        'largest_contentful_paint_image_was_not_lazily_loaded' => 'Imagem do LCP não foi carregada de forma lenta',
        'avoid_serving_legacy_javascript_to_modern_browsers' => 'Evitar servir JavaScript legado para navegadores modernos',
        'network_round_trip_times' => 'Tempo de Viagem de Rede (RTT)',
        'avoids_document_write' => 'Evitar uso de document.write()',
        'reduce_unused_css' => 'Reduzir CSS não utilizado',
        'network_requests' => 'Solicitações de Rede',
        'speed_index' => 'Índice de Velocidade',
        'use_video_formats_for_animated_content' => 'Usar formatos de vídeo para conteúdo animado',
        'avoid_long_main_thread_tasks' => 'Evitar tarefas longas na thread principal',
        'largest_contentful_paint_element' => 'Elemento LCP (Maior Conteúdo Visível)',
        'lazy_load_third_party_resources_with_facades' => 'Carregar lentamente recursos de terceiros com facades',
        'server_backend_latencies' => 'Latências no Backend do Servidor',
        'largest_contentful_paint' => 'Maior Conteúdo Visível (LCP)',
        'image_elements_have_explicit_width_and_height' => 'Elementos de imagem têm largura e altura explícitas',
        'resources_summary' => 'Resumo de Recursos',
        'first_meaningful_paint' => 'Primeira Pintura Significativa (FMP)',
        'javascript_execution_time' => 'Tempo de Execução do JavaScript',
        'enable_text_compression' => 'Habilitar compressão de texto',
        'cumulative_layout_shift' => 'Mudança Cumulativa de Layout (CLS)',
        'total_blocking_time' => 'Tempo Total de Bloqueio (TBT)',
        'screenshot_thumbnails' => 'Miniaturas de Capturas de Tela',
        'script_treemap_data' => 'Mapa de Scripts',
        'tasks' => 'Tarefas',
        'user_timing_marks_and_measures' => 'Marcas e Medidas de Tempo do Usuário',
        'avoid_large_layout_shifts' => 'Evitar grandes mudanças de layout',
        'reduce_unused_javascript' => 'Reduzir JavaScript não utilizado',
        'initial_server_response_time_was_short' => 'Tempo de resposta inicial do servidor foi curto',
        'first_contentful_paint' => 'Primeiro Conteúdo Visível (FCP)',
        'time_to_interactive' => 'Tempo para Interatividade (TTI)',
        'metrics' => 'Métricas',
        'minify_javascript' => 'Minificar JavaScript',
        'eliminate_render_blocking_resources' => 'Eliminar recursos que bloqueiam renderização',
        'minify_css' => 'Minificar CSS',
        'ensure_text_remains_visible_during_webfont_load' => 'Garantir que texto permaneça visível durante carregamento de webfont',
        'properly_size_images' => 'Dimensionar imagens corretamente',
        'serve_static_assets_with_an_efficient_cache_policy' => 'Servir ativos estáticos com política de cache eficiente',
        'defer_offscreen_images' => 'Adiar imagens fora da tela',
        'remove_duplicate_modules_in_javascript_bundles' => 'Remover módulos duplicados em pacotes JavaScript',
        'minimize_main_thread_work' => 'Minimizar trabalho da thread principal',
        'performance' => 'Desempenho',
        'content_best_practices' => 'Melhores Práticas de Conteúdo',
        'user_experience' => 'Experiência do Usuário',
        'crawling_and_indexing' => 'Rastreamento e Indexação',
        'tables_and_lists' => 'Tabelas e Listas',
        'contrast' => 'Contraste',
        'audio_and_video' => 'Áudio e Vídeo',
        'names_and_labels' => 'Nomes e Rótulos',
        'mobile_friendly' => 'Compatível com Dispositivos Móveis',
        'general' => 'Práticas Gerais',
        'browser_compatibility' => 'Compatibilidade com Navegadores',
        'trust_and_safety' => 'Confiança e Segurança',
        'navigation' => 'Navegação',
        'internationalization_and_localization' => 'Internacionalização e Localização',
        'best_practices' => 'Melhores Práticas',
        'aria' => 'Acessibilidade (ARIA)',
    ];

    return $metricNames[$normalizedKey] ?? $key;
}


/**
 * Salva uma resposta em cache para uma URL específica.
 *
 * @param string $url  A URL para a qual os dados serão armazenados.
 * @param array $data  Os dados a serem armazenados em cache.
 */
function setCachedResponse($url, $data)
{
    $cacheDir = '../cache/';
    // Define o diretório de cache.

    if (!is_dir($cacheDir)) {
        mkdir($cacheDir, 0777, true);
        // Cria o diretório de cache, caso não exista.
    }

    $cacheFile = $cacheDir . md5($url) . '.json';
    // Gera o nome do arquivo de cache com base no hash da URL.

    file_put_contents($cacheFile, json_encode($data));
    // Escreve os dados no arquivo de cache em formato JSON.
}


?>