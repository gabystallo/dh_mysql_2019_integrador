<?php

require_once '../conexion.php';

$id = intval($_POST['id']);
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];

try {
	$consulta = $base->prepare("UPDATE choferes set nombre = ?, apellido = ? where id = ?");
	$consulta->execute([$nombre, $apellido, $id]);	
} catch(PDOException $error) {
	die('Error de base de datos');
}

header('Location: /choferes/listado.php');
