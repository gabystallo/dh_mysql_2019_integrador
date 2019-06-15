<?php

require_once '../conexion.php';

$id = intval($_GET['id']);

try {
	$consulta = $base->prepare("DELETE from autos where id = ?");
	$consulta->execute([$id]);	
} catch(PDOException $error) {
	die('Error de base de datos');
}

header('Location: /autos/listado.php');
