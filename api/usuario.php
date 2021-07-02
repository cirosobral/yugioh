<?php

// https://www.restapitutorial.com/lessons/httpmethods.html

// Registra a função para autocarregamento
spl_autoload_register(
    // Função para realizar o carregamento da classe
    function ($class) {
        // Monta o nome do arquivo com base no nome da classe.
        // Deve-se observar o nome completo da classe
        $file = "..\\$class.php";

        // Caso o arquivo exista
        if (file_exists($file))
            // Faz a requisição do arquivo
            require_once $file;
    }
);

// Função usada para verificar se TODAS as chaves existem em um array
function array_all_keys_exists($chaves, $array) {
    return count(array_intersect($chaves, array_keys($array))) == count($chaves);
}

// Função usada para verificar se EXISTE ALGUMA das chaves em um array
function array_any_keys_exists($chaves, $array) {
    return count(array_intersect($chaves, array_keys($array))) > 0;
}

// Recebe o path por get e separa onde encontra as barras (/)
$partes = explode('/', $_GET['path']);
$pdo = new db\DB();
$dao = new db\UsuarioDAO($pdo);

// De acordo com o método da requisição
switch ($_SERVER["REQUEST_METHOD"]) {
    // Caso o método de requisição seja POST
    case "POST":
        // Se o path for (/) ou (/{id}), com o id sendo numérico
        if (preg_match('#/[0-9]*$#', $_GET['path'])) {
            // Verifica se os dados enviados estão corretos
            if (array_all_keys_exists(['nome', 'email', 'senha'], $_POST)) {
                // Cria o usuário, informado os dados recebidos por post
                $usuario = new \model\Usuario();
                $usuario->nome = $_POST['nome'];
                $usuario->email = $_POST['email'];
                $usuario->setSenha($_POST['senha']);

                // Caso o id tenha sido informado, define o id do usuário
                if (isset($partes[1]))
                    $usuario->id = $partes[1];
                
                // Tenta realizar a inserção
                try {
                    // Insere o usuário no banco de dados
                    $dao->insert($usuario);

                    // Retorna o código 201 (Criado)
                    http_response_code(201);
                // Caso o usuário com o id informado já exista
                } catch (Exception $e) {
                    // Retorna o código 409 (Conflito)
                    http_response_code(409);
                }
            }
            // Caso os dados enviados não estejam corretos
            else {
                // Retorna o código 400 (Requisição inválida)
                http_response_code(400);
            }
        // Caso o path seja qualquer outro
        } else {
            // Retorna 404 (Não encontrado)
            http_response_code(404);
        }
        break;
    // Caso o método de requisição seja GET
    case "GET":
        // Se o path for (/)
        if (preg_match('#/$#', $_GET['path'])) {
            // Exibe a lista de usuários
            echo json_encode($dao->list());
        // Se o path for (/{id}) com o id sendo numérico E o usuário exista
        } elseif (preg_match('#/[0-9]+$#', $_GET['path']) && $usuario = $dao->getById($partes[1])) {
            // Retorna as informações de um usuário com o id informado
            echo json_encode($usuario);
        // Caso o path seja qualquer outro ou o id seja inválido
        } else {
            // Retorna 404 (Não encontrado)
            http_response_code(404);
        }
        break;
    // Caso o método de requisição seja PUT
    case "PUT":
        // Para receber os dados passados pelo PUT, é necessário ler o conteúdo de php://input
        parse_str(file_get_contents('php://input'), $_POST);

        // Se o path for (/)
        if (preg_match('#/$#', $_GET['path'])) {
            // Retorna 405 (Método não permitido)
            http_response_code(405);
        // Se o path for (/{id}) com o id sendo numéric E o usuário exista E a requisição traga ao menos um dos campos obrigatórios
        } elseif (preg_match('#/[0-9]+$#', $_GET['path']) && ($usuario = $dao->getById($partes[1])) && array_any_keys_exists(['nome', 'email', 'senha'], $_POST)) {
            // Verifica o campo alterado e realiza a alteração no objeto usuário
            if (isset($_POST['nome']))
                $usuario->nome = $_POST['nome'];
            if (isset($_POST['email']))
                $usuario->email = $_POST['email'];
            if (isset($_POST['senha']))
                $usuario->setSenha($_POST['senha']);
            
            // Caso tenha sucesso no update
            if ($dao->update($partes[1], $usuario))
                // Retorna 200 (OK)
                http_response_code(200);
            // Caso não tenha sido realizado o update
            else
                // Retorna 204 (Nenhum conteúdo)
                http_response_code(204);
        // Caso o path seja qualquer outro, ou o id seja inválido, ou não tenham sido informados nenhum dos campos
        } else {
            // Retorna 404 (Não encontrado)
            http_response_code(404);
        }
        break;
    // Caso o método de requisição seja DELETE
    case "DELETE":
        // Se o path for (/)
        if (preg_match('#/$#', $_GET['path'])) {
            // Retorna 405 (Método não permitido)
            http_response_code(405);
        // Se o path for (/{id}) com o id sendo numérico E a exclusão tiver sucesso
        } elseif (preg_match('#/[0-9]+$#', $_GET['path']) && $dao->delete($partes[1])) {
            // Retorna 200 (OK)
            http_response_code(200);
        // Caso o path seja qualquer outro, ou a exclusão tiver falhado
        } else {
            // Retorna 404 (Não encontrado)
            http_response_code(404);
        }
}

// Usado apenas para debug
// var_dump($_SERVER);
// var_dump($_GET, $partes);
// var_dump($_POST);