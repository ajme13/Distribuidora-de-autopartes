<?php

declare(strict_types = 1);
require_once __DIR__.'/include/index.php';

class Repuestos{
    private PDO $pdo;
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function listar(): array{
        $sql = "SELECT id, nombre, categoria, precio, stock, marca, fotografia, es_destacado FROM repuestos
        WHERE es_destacado = 1";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>