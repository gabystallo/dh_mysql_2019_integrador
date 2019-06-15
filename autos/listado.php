<?php

require_once '../conexion.php';

try {
	//quiero todos los autos, con su chofer y la cantidad de características de cada auto
	$consulta = $base->query("SELECT c.nombre, c.apellido, a.id, a.patente, a.modelo, count(ac.id_caracteristica) as cantidad_caracteristicas from autos a inner join choferes c on c.id = a.id_chofer left join autos_caracteristicas ac on a.id = ac.id_auto group by c.nombre, c.apellido, a.id, a.patente, a.modelo order by a.patente");	
} catch(PDOException $error) {
	die('Error de base de datos');
}

$autos = $consulta->fetchAll(PDO::FETCH_ASSOC);

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
		<h2>Listado de autos</h2>
		<hr>
		<div class="row">
			<div class="col-md-12 text-right">
				<a href="/autos/formulario-crear.php" class="btn btn-primary">Crear auto</a>
			</div>
		</div>
		<hr>
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
					<th>Chofer</th>
					<th>Patente</th>
					<th>Modelo</th>
					<th>Cant. Carac.</th>
					<th width="140"></th>
				</tr>
				<?php foreach($autos as $auto) { ?>

					<tr>
						<td><?php echo $auto['nombre'] ?> <?php echo $auto['apellido'] ?></td>
						<td><?php echo $auto['patente'] ?></td>
						<td><?php echo $auto['modelo'] ?></td>
						<td><?php echo $auto['cantidad_caracteristicas'] ?></td>
						<td>
							<a class="btn btn-sm btn-primary" href="/autos/caracteristicas.php?id=<?php echo $auto['id'] ?>"><i class="fa fa-car"></i></a>
							<a class="btn btn-sm btn-warning" href="/autos/formulario-editar.php?id=<?php echo $auto['id'] ?>"><i class="fa fa-edit"></i></a>
							<a class="btn btn-sm btn-danger" href="/autos/eliminar.php?id=<?php echo $auto['id'] ?>"><i class="fa fa-remove"></i></a>
						</td>
					</tr>

				<?php } ?>
			</table>
		</div>

	</div>

</body>
</html>