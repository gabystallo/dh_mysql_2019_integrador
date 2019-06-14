<?php

require_once '../conexion.php';

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];

try {
	$consulta = $base->prepare("INSERT INTO choferes (nombre, apellido) values (?, ?)");
	$consulta->execute([$nombre, $apellido]);	
} catch(PDOException $error) {
	die('Error de base de datos');
}

header('Location: /choferes/listado.php');
