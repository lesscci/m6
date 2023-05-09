<!DOCTYPE html>
<html>
<head>
	
	<title>Gestor de Encuestas</title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
	<h1>Gestor de Encuestas</h1>
	<form method="POST" action="crear_encuesta.php">
		<label for="textoencuesta">Texto de la encuesta:</label>
		<input type="text" id="textoencuesta" name="textoencuesta" required><br><br>
		<label for="opcion1">Opción 1:</label>
		<input type="text" id="opcion1" name="opcion1" required><br><br>
		<label for="opcion2">Opción 2:</label>
		<input type="text" id="opcion2" name="opcion2" required><br><br>
		<label for="opcion3">Opción 3:</label>
		<input type="text" id="opcion3" name="opcion3" required><br><br>
		<button type="submit">Crear Encuesta</button>
	</form>
	<hr>
	<h2>Encuestas Creadas</h2>
	

<?php
require 'conexion.php';
$query = "SELECT 1";
$resultado = $mysqli->query($query);
if($resultado){
   echo "Conexión exitosa";
} else {
   echo "Error al conectar con la base de datos: " . $mysqli->connect_error;
}
?>
<?php
	// Mostrar la lista de encuestas creadas
	require 'conexion.php';
	$query = "SELECT * FROM tencuestas";
	$resultado = $mysqli->query($query);
	while ($fila = $resultado->fetch_assoc()) {
		echo "<p><a href='ver_encuesta.php?id=".$fila['codencuesta']."'>".$fila['textoencuesta']."</a></p>";
	}
	?>

</body>
</html>
