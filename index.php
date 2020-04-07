<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Prueba Performance</title>		
	<meta name="viewport" content="width=device-width, user-scalabel=no">
	<link rel="stylesheet" href="bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/app.css">
</head>
<body>
	<div class="container">
		<h3>Pruebas Performance</h3>
		<form action="" role="form" class="form-horizontal" method="post">
			<div class="form-group">
				<label for="num_cedula" class="control-label col-md-2">N&uacute;mero de c&eacute;dula</label>
				<div class="col-md-10">
					<input class="form-control" type="text" id="num_cedula" placeholder="N&uacute;mero de c&eacute;dula"></input>
				</div>
			</div>
			<div class="form-group">
				<label for="correo_e" class="control-label col-md-2">Correo electr&oacute;nico</label>
				<div class="col-md-10">
					<input class="form-control" type="email" id="correo_e" placeholder="Correo electr&oacute;nico"></input>
				</div>
			</div>
			<div class="form-group">
				<div id="msg_error" class="text-danger"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2 col-md-offset-2">
					<button class="btn btn-primary" id="btn_enviar">Enviar</button>
				</div>
			</div>
		</form>
		<div class="col-sm" id="respuesta"></div>
	</div>
	
	<script src="jquery/jquery-3.4.1.min.js"></script>
	<script src="bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="js/app.js"></script>
</body>
</html>