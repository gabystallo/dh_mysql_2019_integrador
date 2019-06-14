<?php

require_once '../conexion.php';

$id = intval($_GET['id']);

try {
	$consulta = $base->prepare("DELETE from choferes where id = ?");
	$consulta->execute([$id]);	
} catch(PDOException $error) {
	die('Error de base de datos');
}

header('Location: /choferes/listado.php');
