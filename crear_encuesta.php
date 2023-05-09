<?php
require 'conexion.php';

// Obtener los datos del formulario
$textoencuesta = $_POST['textoencuesta'];
$opcion1 = $_POST['opcion1'];
$opcion2 = $_POST['opcion2'];
$opcion3 = $_POST['opcion3'];

// Insertar la encuesta en la base de datos
$query = "INSERT INTO tencuestas (textoencuesta, votosopc1, votosopc2, votosopc3, opcion1, opcion2, opcion3)
			VALUES ('$textoencuesta', 0, 0, 0, '$opcion1', '$opcion2', '$opcion3')";
$resultado = $mysqli->query($query);

// Redirigir a la página principal
header("Location: index.php");
exit();
?>
