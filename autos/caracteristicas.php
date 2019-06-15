<?php

require_once '../conexion.php';

$id = intval($_GET['id']);

try {
	$consulta = $base->prepare("SELECT * from autos where id = ?");
	$consulta->execute([$id]);
} catch(PDOException $error) {
	die('Error de base de datos');
}

$autos = $consulta->fetchAll(PDO::FETCH_ASSOC);
if(count($autos)==0) {
	die('No se encontró el auto');
}

$auto = $autos[0];

try {
	//las caracteristicas que tiene el auto cuyo id recibí por get en $id
	$consulta = $base->prepare("SELECT * from caracteristicas where id in (SELECT id_caracteristica from autos_caracteristicas where id_auto = ?)");
	$consulta->execute([$id]);
} catch(PDOException $error) {
	die('Error de base de datos');
}
$tiene = $consulta->fetchAll(PDO::FETCH_ASSOC);

try {
	//las caracteristicas que NO tiene el auto cuyo id recibí por get en $id
	$consulta = $base->prepare("SELECT * from caracteristicas where not id in (SELECT id_caracteristica from autos_caracteristicas where id_auto = ?)");
	$consulta->execute([$id]);
} catch(PDOException $error) {
	die('Error de base de datos');
}
$no_tiene = $consulta->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Remisería - Autos</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light" style="padding:20px 30px; margin-bottom:20px;">
	  <a class="navbar-brand" href="#">Remisería</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item">
	        <a class="nav-link" href="/choferes/listado.php">Choferes</a>
	      </li>
	      <li class="nav-item active">
	        <a class="nav-link" href="/autos/listado.php">Autos</a>
	      </li>
	      
	    </ul>
	  </div>
	</nav>


	<div class="container">
		<h2>Características del auto <?php echo $auto['patente'] ?></h2>
		<hr>
		<div class="row">
			<div class="col-md-12 text-right">
				<a href="/autos/listado.php" class="btn btn-info">Volver</a>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-6">
				<h3>Tiene:</h3>
				<div class="table-responsive">
					<table class="table table-hover table-striped">
						<?php foreach($tiene as $caracteristica) { ?>
							<tr>
								<td><?php echo $caracteristica['nombre'] ?></td>
								<td width="60"><a href="/autos/quitar-caracteristica.php?id_auto=<?php echo $auto['id'] ?>&id_caracteristica=<?php echo $caracteristica['id'] ?>" class="btn btn-danger"><i class="fa fa-remove"></i></a></td>
							</tr>
						<?php } ?>
					</table>
				</div>
			</div>
			<div class="col-md-6">
				<h3>Le falta:</h3>
				<div class="table-responsive">
					<table class="table table-hover table-striped">
						<?php foreach($no_tiene as $caracteristica) { ?>
							<tr>
								<td><?php echo $caracteristica['nombre'] ?></td>
								<td width="60"><a href="/autos/agregar-caracteristica.php?id_auto=<?php echo $auto['id'] ?>&id_caracteristica=<?php echo $caracteristica['id'] ?>" class="btn btn-success"><i class="fa fa-plus"></i></a></td>
							</tr>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>