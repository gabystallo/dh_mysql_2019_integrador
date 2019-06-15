<?php

require_once '../conexion.php';

$id = intval($_POST['id']);
$id_chofer = intval($_POST['id_chofer']);
$modelo = $_POST['modelo'];
$patente = $_POST['patente'];

try {
	$consulta = $base->prepare("UPDATE autos set id_chofer = ?, modelo = ?, patente = ? where id = ?");
	$consulta->execute([$id_chofer, $modelo, $patente, $id]);	
} catch(PDOException $error) {
	die('Error de base de datos');
}

header('Location: /autos/listado.php');
