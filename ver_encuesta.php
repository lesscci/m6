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

// Si se envió el formulario de votación, procesar el voto y redirigir al usuario a la página de resultados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$opcion = $_POST['opcion'];
	$query = "UPDATE tencuestas SET votosopc$opcion = votosopc$opcion + 1 WHERE codencuesta = $id";
	$resultado = $mysqli->query($query);
	header("Location: resultados_encuesta.php?id=$id");
}

?>
<h2><?php echo $encuesta['textoencuesta'] ?></h2>

<form method="POST">
	<input type="hidden" name="encuesta_id" value="<?php echo $id ?>">
	<label>
		<input type="radio" name="opcion" value="1">
		<?php echo $encuesta['opcion1'] ?>
	</label><br>
	<label>
		<input type="radio" name="opcion" value="2">
		<?php echo $encuesta['opcion2'] ?>
	</label><br>
	<label>
		<input type="radio" name="opcion" value="3">
		<?php echo $encuesta['opcion3'] ?>
	</label><br>
	<button type="submit">Votar</button>
</form>

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

<!------------------------>