<?php

require_once '../conexion.php';

try {
	$consulta = $base->query("SELECT * from choferes order by nombre, apellido");
} catch(PDOException $error) {
	die('Error de base de datos');
}

$choferes = $consulta->fetchAll(PDO::FETCH_ASSOC);

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
		<h2>Crear auto</h2>
		<hr>
		<form method="post" action="/autos/crear.php">
			<div class="row">
				<div class="col-md-6 form-group">
					<label>Patente</label>
					<input type="text" name="patente" class="form-control">
				</div>
				<div class="col-md-6 form-group">
					<label>Modelo</label>
					<input type="text" name="modelo" class="form-control">
				</div>
				<div class="col-md-6 form-group">
					<label>Chofer</label>
					<select name="id_chofer" class="form-control">
						<?php foreach($choferes as $chofer) { ?>
							<option value="<?php echo $chofer['id'] ?>"><?php echo $chofer['nombre'] . ' ' . $chofer['apellido'] ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary">Crear</button>
					<a href="/autos/listado.php" class="btn btn-info">Volver</a>
				</div>
			</div>
		</form>
	</div>
</body>
</html>