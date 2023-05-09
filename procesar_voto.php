<?php
require 'conexion.php';

// Obtener el ID de la encuesta y la opción seleccionada por el usuario
$encuesta_id = $_POST['encuesta_id'];
$opcion = $_POST['opcion'];

// Actualizar la base de datos con el nuevo voto
if ($opcion == 1) {
	$query = "UPDATE tencuestas SET votosopc1 = votosopc1 + 1 WHERE codencuesta = $encuesta_id";
} elseif ($opcion == 2) {
	$query = "UPDATE tencuestas SET votosopc2 = votosopc2 + 1 WHERE codencuesta = $encuesta_id";
} elseif ($opcion == 3) {
	$query = "UPDATE tencuestas SET votosopc3 = votosopc3 + 1 WHERE codencuesta = $encuesta_id";
}
$resultado = $mysqli->query($query);

// Redirigir al usuario a la página de resultados
header("Location: resultados_encuesta.php?id=$encuesta_id");
?>
