<?php

declare(strict_types = 1);
require_once __DIR__.'/include/index.php';

$conexion = new ConexionBD();
$db =$conexion -> conectar();

if($db instanceof PDO){
    echo "<p>Conexion establecida</p>";
};
?>