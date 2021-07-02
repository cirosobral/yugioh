// Adicionado um eventlistener para esperar o conteúdo da página ser completamente carregado ANTES da execução do script
document.addEventListener('DOMContentLoaded', ()=> {
    // Usa a API do DOM para selecionar um elemento da página
    var titulo = document.querySelector('#titulo');

    // Cria uma requisição XHR (AJAX)
    var request = new XMLHttpRequest();

    // Indica o método e o endpoint para onde será enviada a requisição
    // request.open('GET', 'http://yugiohprices.com/api/set_data/Lightning Overdrive');
    request.open('GET', 'http://localhost/yugioh/api-proxy/index.php?url=http://yugiohprices.com/api/set_data/Lightning Overdrive');
    
    // Quando o navegador acusa CORS usa-se um cabeçalho próprio para envio do OPTIONS (preflight request)
    // request.setRequestHeader('cabecalho-customizado', 'teste');

    // Define a ação a ser realizada quando o estado da requisição for alterado
    request.onreadystatechange = function () {
        // Quando o estado for 'pronto' (4)
        if (this.readyState === 4) {
            // Altera o texto de título com o valor recebido pela requisição
            titulo.innerText = "A média é " + JSON.parse(this.responseText).data.average;
        }
    };

    // Uma vez definidos os parâmetros para a requisição, faz o seu envio
    request.send();
}, false);