<?php

require_once '../conexion.php';

$id_chofer = intval($_POST['id_chofer']);
$patente = $_POST['patente'];
$modelo = $_POST['modelo'];

try {
	$consulta = $base->prepare("INSERT INTO autos (id_chofer, modelo, patente) values (?, ?, ?)");
	$consulta->execute([$id_chofer, $modelo, $patente]);	
} catch(PDOException $error) {
	die('Error de base de datos');
}

header('Location: /autos/listado.php');
