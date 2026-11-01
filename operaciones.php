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

    public function listar2(): array{
        $sql = "SELECT id, nombre, categoria, precio, stock, marca, fotografia, es_destacado FROM repuestos";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar(int $id):bool{
        $sql = "DELETE FROM repuestos WHERE id = :id";
        $smtp = $this -> pdo -> prepare($sql);
        return $smtp -> execute ([':id' => $id]);
    }

    public function crear(string $nombre, string $categoria, float $precio, int $stock, string $marca, string $fotografia): int{
        $sql = "INSERT INTO productos(nombre, categoria, precio, stock, marca, fotografia)
                VALUES (:nombre, :categoria, :precio, :stock, :marca, :fotografia)";

        $stmt = $this -> pdo ->prepare($sql);
        $stmt -> execute([
            ':nombre' => $nombre,
            ':categoria' => $categoria,
            ':precio' => $precio,
            ':stock' => $stock,
            ':marca' => $marca,
            ':fotografia' => $fotografia
        ]);
        return (int)$this ->pdo ->lastInsertId();
    }

    public function actualizar(int $id, float $nuevo_precio,int $nuevo_stock, string $nuevo_nombre, string $nueva_marca, string $nueva_categoria): bool{
        $sql = "UPDATE repuestos
                SET precio = :precio, stock = :stk, nombre = :nombre
                WHERE id = :id";
        
        $stmt = $this -> pdo -> prepare($sql);
        return $stmt -> execute([
            ':precio' => $nuevo_precio,
            ':stk' => $nuevo_stock,
            ':id' => $id,
            ':nombre' => $nuevo_nombre,
            ':marca' => $nueva_marca,
            ':categoria' => $nueva_categoria
        ]);
                
    }

}

?>