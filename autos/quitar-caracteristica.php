<?php

require_once '../conexion.php';

$id_auto = intval($_GET['id_auto']);
$id_caracteristica = intval($_GET['id_caracteristica']);

try {
	$consulta = $base->prepare("DELETE from autos_caracteristicas where id_auto = ? AND id_caracteristica = ?");
	$consulta->execute([$id_auto, $id_caracteristica]);	
} catch(PDOException $error) {
	die('Error de base de datos');
}

header('Location: /autos/caracteristicas.php?id=' . $id_auto);
