document.addEventListener('DOMContentLoaded', () => {
    const analyzeForm = document.getElementById('analyze-form');
    const analyzeLoader = document.getElementById('loader');
    const resultSection = document.getElementById('result');
    const urlInput = document.getElementById('url');

    if (!analyzeForm || !analyzeLoader || !resultSection) {
        console.error("Elementos principais não foram encontrados no HTML.");
        return;
    }



    if (urlInput) {
        urlInput.addEventListener('change', () => {
            const urlValue = urlInput.value.trim();

            if (urlValue && isValidURL(urlValue)) {
                localStorage.setItem('savedURL', urlValue);
            } 
        });
    }

 

    // Função para validar a URL
    function isValidURL(url) {
        const pattern = new RegExp('^(https?:\\/\\/)?' + // protocolo
            '((([a-zA-Z0-9\\-\\.]+)\\.([a-zA-Z]{2,}))|' + // domínio
            'localhost|' + // localhost
            '\\d{1,3}(\\.\\d{1,3}){3})' + // endereço IP (v4)
            '(\\:\\d+)?(\\/[-a-zA-Z0-9%_.~+]*)*' + // porta e caminho
            '(\\?[;&a-zA-Z0-9%_.~+=-]*)?' + // query string
            '(\\#[-a-zA-Z0-9_]*)?$', 'i'); // fragmento
        return !!pattern.test(url);
    }
    // Exibir o loader
    const showLoader = () => {
        analyzeLoader.style.display = 'flex';
    };

    // Ocultar o loader
    const hideLoader = () => {
        analyzeLoader.style.display = 'none';
    };

    // Renderizar gráficos com exemplos e sugestões detalhados
    const renderCharts = () => {
        const chartsContainers = document.querySelectorAll('.charts-container');
    
        chartsContainers.forEach(container => {
            const canvases = container.querySelectorAll('canvas');
            canvases.forEach(canvas => {
                const ctx = canvas.getContext('2d');
                const dataValue = parseFloat(canvas.dataset.percent); // Valor fornecido
                const suggestion = canvas.dataset.suggestion || 'Nenhuma sugestão fornecida.';
                const example = canvas.dataset.example || 'Nenhum exemplo fornecido.';

                // Validar se o dado é um número válido
                if (isNaN(dataValue) || dataValue < 0) {
                    console.warn('Dado inválido para renderizar o gráfico:', canvas);
                    return;
                }

                // Determinar a escala máxima adaptativa
                let maxScale;
                if (dataValue <= 100) {
                    maxScale = 100; // Escala de 0 a 100
                } else if (dataValue <= 30000) {
                    maxScale = 30000; // Escala de 0 a 30.000
                } else {
                    maxScale = Math.ceil(dataValue / 10000) * 10000; // Aproximação para múltiplos de 10.000
                }

                const color = dataValue / maxScale >= 0.9
                    ? '#4CAF50' // Verde para alta porcentagem
                    : dataValue / maxScale >= 0.5
                        ? '#FFC107' // Amarelo para média
                        : '#F44336'; // Vermelho para baixa porcentagem

                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: [`Valor (${dataValue})`, `Restante (${maxScale - dataValue})`],
                        datasets: [{
                            data: [dataValue, maxScale - dataValue],
                            backgroundColor: [color, '#e0e0e0'],
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: false,
                        maintainAspectRatio: false,
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        return `${context.label}: ${context.raw}`;
                                    }
                                }
                            }
                        }
                    }
                });

                console.log('Sugestão:', suggestion);
                console.log('Exemplo:', example);

                // Adicionar explicações abaixo do gráfico
                const infoContainer = document.createElement('div');
                infoContainer.style.textAlign = 'center';
                infoContainer.innerHTML = `
                    <p>
                        Resultados Esperados:
                        <span style="color: #4CAF50;">Bom ≥ ${Math.ceil(0.9 * maxScale)}</span>,
                        <span style="color: #FFC107;">Aceitável ≥ ${Math.ceil(0.5 * maxScale)}</span>,
                        <span style="color: #F44336;">Ruim < ${Math.ceil(0.5 * maxScale)}</span>
                    </p>
                `;
                canvas.parentElement.appendChild(infoContainer);
            });
        });
    };

    // Configurar botão "Exportar PDF"
    const setupPDFExport = () => {
        const pdfButton = document.querySelector('#pdf_button');
        const pdfLoader = document.querySelector('#pdf_loader');
    
        if (!pdfButton) {
            console.warn("Botão 'Exportar PDF' não encontrado.");
            return;
        }
    
        if (!pdfLoader) {
            console.warn("Loader não encontrado.");
            return;
        }
    
        pdfButton.addEventListener("click", () => {
            // Exibir o loader imediatamente
            pdfLoader.style.display = 'block';
    
            // Adicionar pequeno atraso para atualizar o DOM
            setTimeout(() => {
                // @ts-ignore
                const { jsPDF } = window.jspdf;
                const chartSections = document.querySelectorAll('.chart-section');
    
                if (chartSections.length === 0) {
                    console.error("Nenhum gráfico encontrado para exportar.");
                    pdfLoader.style.display = 'none'; // Ocultar o loader em caso de erro
                    return;
                }
    
                const pdf = new jsPDF("p", "mm", "a4");
                const pdfWidth = 210;
                const pdfHeight = 297;
                const margin = 10;
                let currentY = margin;
    
                const savedURL = localStorage.getItem('savedURL') || "URL não definida";
                const today = new Date().toLocaleDateString();
    
                const headerHeight = 20;
                pdf.setFillColor(251, 192, 45);
                pdf.roundedRect(5, 5, pdfWidth - 10, headerHeight, 5, 5, "F");
                pdf.setFont("helvetica", "bold");
                pdf.setFontSize(16);
                pdf.setTextColor(255, 255, 255);
                pdf.text("SEO Técnico", pdfWidth / 2, headerHeight / 2 + 5, { align: "center" });
                pdf.setTextColor(0, 0, 0);
                currentY = headerHeight + 15;
    
                const titleHeight = 15;
                pdf.setFillColor(255, 243, 224);
                pdf.roundedRect(10, currentY, pdfWidth - 20, titleHeight, 3, 3, "F");
                currentY += 10;
    
                const siteText = `Análise do site:    `;
                const siteLink = savedURL.startsWith("http") ? savedURL : `https://${savedURL}`;
                pdf.setFontSize(12);
                pdf.setFont("helvetica", "normal");
    
                const fullText = `${siteText}${savedURL} no dia ${today}`;
                const textX = (pdfWidth - pdf.getTextWidth(fullText)) / 2;
    
                pdf.setFont("helvetica", "bold");
                pdf.text(siteText, textX, currentY);
                pdf.setFont("helvetica", "normal");
                pdf.setTextColor(0, 128, 0);
                pdf.textWithLink(savedURL, textX + pdf.getTextWidth(siteText), currentY, { url: siteLink });
                pdf.setTextColor(0, 0, 0);
                pdf.text(` no dia ${today}`, textX + pdf.getTextWidth(siteText + savedURL), currentY);
                currentY += titleHeight;
    
                Promise.all(
                    Array.from(chartSections).map((chartSection) =>
                        html2canvas(chartSection, { scale: 2 }).then((canvas) => {
                            const imgData = canvas.toDataURL("image/png");
                            const imgWidth = pdfWidth - margin * 2;
                            const imgHeight = (canvas.height * imgWidth) / canvas.width;
    
                            if (currentY + imgHeight > pdfHeight - margin) {
                                pdf.addPage();
                                currentY = margin;
                            }
    
                            pdf.addImage(imgData, "PNG", margin, currentY, imgWidth, imgHeight);
                            currentY += imgHeight + 10;
                        })
                    )
                )
                .then(() => pdf.save("resultados_analises.pdf"))
                .catch((err) => console.error("Erro ao exportar PDF:", err))
                .finally(() => {
                    // Ocultar o loader após o término
                    pdfLoader.style.display = 'none';
                });
            }, 100); // Pequeno atraso de 100ms
        });
    };
    
    // Enviar formulário de análise
    analyzeForm.addEventListener('submit', async (event) => {
        event.preventDefault(); // Evitar recarregamento da página
        showLoader();

        const analyzeLoader = document.getElementById('loader');
        const urlInput = document.getElementById('url');

        if (!urlInput.value || !isValidURL(urlInput.value)) {
            alert('Por favor, insira uma URL válida.');
            return;
        }
    
        analyzeLoader.style.display = 'flex';
    
        const formData = new FormData(analyzeForm);
        try {
            const response = await fetch(analyzeForm.action, {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                body: formData,
            });

            if (!response.ok) {
                throw new Error(`Erro na requisição: ${response.statusText}`);
            }
            const today = new Date().toLocaleDateString();

            const responseHTML = await response.text();
            const currentURL = localStorage.getItem('savedURL') || 'URL não definida';
         
            const analysisTitle = `
            <h2>
                Análise do site: 
                <em>
                    <a href="${currentURL}" target="_blank" style="color: #a67c00; text-decoration: none; font-size: 0.9em;">
                        ${new URL(currentURL).hostname}
                    </a>
                </em> 
                no dia ${today}
            </h2>
        `;
        
        
            resultSection.innerHTML = analysisTitle + responseHTML;

            renderCharts(); // Renderizar gráficos após a análise

            const formBtnPdf = document.querySelector('#formBtnPdf');
             formBtnPdf.style.display = 'block';


setupPDFExport();


        console.log("Adicionando botão Exportar PDF...");
        console.log("Conteúdo do resultSection:", resultSection.innerHTML);

 // Configurar funcionalidade do botão
        
        } catch (error) {
            console.error("Erro ao processar a análise:", error);
            resultSection.innerHTML = `<p style="color: red;">Erro ao processar a análise: ${error.message}</p>`;
        } finally {
            hideLoader();
        }
    });


});
