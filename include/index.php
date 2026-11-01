<?php

declare(strict_types = 1);

class ConexionBD{
    private string $host = "localhost";
    private string $db = "don_panchodb";
    private string $user = "root";
    private string $pass = "";
    private string $charset = "utf8mb4";

    public function conectar(): ?PDO {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";

        $opciones = [
            PDO::ATTR_ERRMODE                 => PDO::ERRMODE_EXCEPTION,
            PDO:: ATTR_DEFAULT_FETCH_MODE     => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES        => FALSE,
        ];

    try{
        $pdo = new PDO($dsn, $this -> user, $this -> pass, $opciones);
        return $pdo;
    }catch (PDOException $e){
        error_log("fallo al conectar". $e->getMessage());

        echo "<div><strong>Error de conexion</strong></div>";

        return null;
    };
    }
}

?>