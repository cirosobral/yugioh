<?php

namespace model;

class Usuario {
    public $id;
    public $email;
    private $senha;
    public $nome;

    public function setSenha($senha) {
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
    }

    public function getSenha() {
        return $this->senha;
    }

    public function verificaSenha($senha) {
        return password_verify($senha, $this->senha);
    }

    public function validaEmail() {
        return preg_match('/^[^@]+@.*\..*$/', $this->email);
    }
    
    public function saudacao() {
        date_default_timezone_set('America/Bahia');
        
        $hora = date('H');
        
        if ($hora >= 6 && $hora <= 12)
            return "Bom dia, {$this->nome}";
        else if ($hora > 12 && $hora <=18 )
            return "Boa tarde, {$this->nome}";
        else
            return "Boa noite, {$this->nome}";
    }
}