<?php
require 'conexion.php';

// Obtener el ID de la encuesta a mostrar
$id = $_GET['id'];

// Obtener los datos de la encuesta de la base de datos
$query = "SELECT * FROM tencuestas WHERE codencuesta = $id";
$resultado = $mysqli->query($query);
$encuesta = $resultado->fetch_assoc();

// Calcular el total de votos
$total_votos = $encuesta['votosopc1'] + $encuesta['votosopc2'] + $encuesta['votosopc3'];

// Calcular el porcentaje de votos para cada opción
function porcentaje_votos($opcion, $total_votos) {
	if ($total_votos > 0) {
		return round(($opcion / $total_votos) * 100);
	} else {
		return 0;
	}
}

// Procesar el voto del usuario si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
}

?>

<div class="contenedor-barra">
	<div class="barra" style="width: <?php echo porcentaje_votos($encuesta['votosopc1'], $total_votos) ?>%;">
		<span><?php echo $encuesta['opcion1'] ?> (<?php echo $encuesta['votosopc1'] ?> votos)</span>
	</div>
	<div class="barra" style="width: <?php echo porcentaje_votos($encuesta['votosopc2'], $total_votos) ?>%;">
		<span><?php echo $encuesta['opcion2'] ?> (<?php echo $encuesta['votosopc2'] ?> votos)</span>
	</div>
	<div class="barra" style="width: <?php echo porcentaje_votos($encuesta['votosopc3'], $total_votos) ?>%;">
    <span><?php echo $encuesta['opcion3'] ?> (<?php echo $encuesta['votosopc3'] ?> votos)</span>
	</div>
</div>

Opción 1: <?php echo $encuesta['votosopc1'] ?> votos
Opción 2: <?php echo $encuesta['votosopc2'] ?> votos
Opción 3: <?php echo $encuesta['votosopc3'] ?> votos

<br>

<div class="contenedor-barra">
	<div class="barra" style="width: <?php echo porcentaje_votos($encuesta['votosopc1'], $total_votos) ?>%;">
		<span><?php echo $encuesta['opcion1'] ?> (<?php echo $encuesta['votosopc1'] ?> votos)</span>
	</div>
	<div class="barra" style="width: <?php echo porcentaje_votos($encuesta['votosopc2'], $total_votos) ?>%;">
		<span><?php echo $encuesta['opcion2'] ?> (<?php echo $encuesta['votosopc2'] ?> votos)</span>
	</div>
	<div class="barra" style="width: <?php echo porcentaje_votos($encuesta['votosopc3'], $total_votos) ?>%;">
	    <span><?php echo $encuesta['opcion3'] ?> (<?php echo $encuesta['votosopc3'] ?> votos)</span>
	</div>
	<img class="grafico" src="barra-roja.png" alt="Gráfico de barras">
</div>

<style>
.grafico {
  width: 100%;
  max-width: 500px; /* ajusta este valor según tus necesidades */
  height: auto;
}
</style>

