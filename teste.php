<?php

// Registra a função para autocarregamento
spl_autoload_register(
    // Função para realizar o carregamento da classe
    function($class) {
        /*
         * Deve-se observar a localização do arquivo e o nome completo da classe.
         * 
         * Este arquivo está na raiz. E as classes estão dentro de pastas
         * correspondente aos namespaces.
         * 
         * Ex.: A classe 'Usuário' está no namespace 'model', logo está em 'model\Usuario'.
         * Como esse script está na raiz, é necessário subir à pasta 'model' e incluir o
         * arquivo 'Usuario.php'. Por isso, $class teria o valor 'model\Usuario' e o arquivo
         * está em '.\model\Usuario.php'.
         * 
         * Obs.: As duas barras (\\) foram usadas pois a barra é um caractere de escape.
         * Logo, para colocar a barra em um string é necessário usar a primeira barra como
         * caractere de escape e a segunda para indicar o caractere a ser usado.
         */
        
         // Monta o nome do arquivo com base no nome da classe
        $file = ".\\$class.php";

        // Caso o arquivo exista
        if (file_exists($file))
            // Faz a requisição do arquivo
            require_once $file;
    }
);

$pdo = new db\DB();
$dao = new db\UsuarioDAO($pdo);

?>
<pre>
<?php 
    try {
        // $usuario = new model\Usuario();  // Cria um usuário.
        // $usuario->nome = 'a';            // Define o nome
        // $usuario->email = 'b';           // o e-mail
        // $usuario->setSenha('c');         // e a senha.
        // $usuario->id = 4;                // ...e o id.
        // $ret = $dao->insert($usuario);   // Insere o usuário no banco de dados.
        // $ret = $dao->list();             // Obtém uma lista dos usuários.
        // $ret = $dao->getById(1);         // Busca um usuário com id 4.
        // $ret->nome = 'd';                // Altera o nome do usuário buscado
        // $ret->email = 'e';               // o e-mail
        // $ret->setSenha('f');             // e a senha.
        // $ret = $dao->update(1, $ret);    // Atualiza o usuário no banco de dados.
        // $ret = $dao->delete(1);          // Apaga o usuário do banco de dados.
        var_dump($ret);
    } catch (PDOException $e) {
        var_dump($e);
        // echo "O id informado já existe";
    }
?>
</pre>