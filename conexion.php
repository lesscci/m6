<?php
$servidor = 'localhost';
$bd = 'encuestasdb';
$user = 'root';
$pass = '';

try {
    $conexion = new PDO('mysql:host=' . $servidor . ';dbname=' . $bd, $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "error de conexion";
    exit;
}

$mysqli = new mysqli($servidor, $user, $pass, $bd);
if ($mysqli->connect_errno) {
    echo "Error al conectar con la base de datos: " . $mysqli->connect_error;
    exit();
}
?>