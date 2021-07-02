<?php

namespace DB;

class UsuarioDAO {
    private $db;

    public function __construct(\PDO $db) {
        $this->db = $db;
    }

    public function insert(\model\Usuario $usuario) {
        $sql = 'INSERT INTO `usuario` (`id`, `email`, `senha`, `nome`) VALUES (?, ?, ?, ?)';
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $usuario->id,
            $usuario->email,
            $usuario->getSenha(),
            $usuario->nome
        ]);

        return $this->db->lastInsertId();
    }

    public function list() {
        $sql = 'SELECT * FROM `usuario`';

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, 'model\Usuario');
    }

    public function getById(int $id) {
        $sql = 'SELECT * FROM `usuario` WHERE `id` = ?';

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'model\Usuario');
        return $stmt->fetch();
    }

    public function update(int $id, \model\Usuario $usuario) {
        $sql = 'UPDATE `usuario` SET `email` = ?, `senha` = ?, `nome` = ?  WHERE `id` = ?';

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $usuario->email,
            $usuario->getSenha(),
            $usuario->nome,
            $id
        ]);

        return $stmt->rowCount();
    }

    public function delete(int $id) {
        $sql = 'DELETE FROM `usuario` WHERE `id` = ?';

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        
        return $stmt->rowCount();
    }
}