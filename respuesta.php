<script src="js/app_pdf.js"></script>
<?php
include('conf.ini');

$fecha = new DateTime();
$v_cok = $fecha->getTimestamp();
$id_buscador = "";

if(isset($_POST["num_cedula"])){
	$num_cedula = $_POST["num_cedula"];
}else{
	$num_cedula = "";
}

if(isset($_POST["correo_e"])){
	$correo_e = $_POST["correo_e"];
}else{
	$correo_e = "";
}

$fecha_archivo = date('Ymd');

$desc_perfil = "Este perfil de competencia se caracteriza por: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

try {
	
	$conn = new PDO("mysql:host=$h_db1;dbname=$b_db1", $u_db1, $p_db1);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//Consulta nombres y apellidos del candidato
	if(($num_cedula != "")&&($correo_e == "")){
		$consulta = "SELECT a.id_buscador, a.nombre, a.apellido, b.tipo_documento, a.documento, a.fecha_prueba,
		concat(c.nombre,' ',c.apellido) AS prestador
		FROM buscador a
		INNER JOIN tipo_documento b
		ON a.id_tipo_documento = b.id_tipo_documento
		INNER JOIN prestador_usuario c
		ON a.id_prestador_usuario = c.id_prestador_usuario
		WHERE a.documento = '$num_cedula'";
	}
	if(($num_cedula == "")&&($correo_e != "")){
		$consulta = "SELECT a.id_buscador, a.nombre, a.apellido, b.tipo_documento, a.documento, a.fecha_prueba,
		concat(c.nombre,' ',c.apellido) AS prestador
		FROM buscador a
		INNER JOIN tipo_documento b
		ON a.id_tipo_documento = b.id_tipo_documento
		INNER JOIN prestador_usuario c
		ON a.id_prestador_usuario = c.id_prestador_usuario
		WHERE a.email = '$correo_e'";
	}
	if(($num_cedula != "")&&($correo_e != "")){
		$consulta = "SELECT a.id_buscador, a.nombre, a.apellido, b.tipo_documento, a.documento, a.fecha_prueba,
		concat(c.nombre,' ',c.apellido) AS prestador
		FROM buscador a
		INNER JOIN tipo_documento b
		ON a.id_tipo_documento = b.id_tipo_documento
		INNER JOIN prestador_usuario c
		ON a.id_prestador_usuario = c.id_prestador_usuario
		WHERE a.documento = '$num_cedula'
		AND a.email = '$correo_e'";
	}
	$result = $conn->query($consulta);
	$rows = $result->fetchAll();
	if(count($rows) > 0){		
		foreach ($rows as $row) {
			$id_buscador = $row['id_buscador'];	
			$nombre = $row['nombre'];	
			$apellido = $row['apellido'];	
			$tipo_documento = $row['tipo_documento'];	
			$documento = $row['documento'];	
			$fecha_prueba = $row['fecha_prueba'];	
			$prestador = $row['prestador'];	
		}		
	}else{
		echo "No se encuentran resultados.";
	}
	
	$consulta1 = "SELECT a.ei, a.ai, a.ad, a.ed, RIGHT(CONCAT('00',a.id_perfil),2) AS num_perfil
	FROM resultado_buscador a
	WHERE a.id_buscador = '$id_buscador'";
	$result1 = $conn->query($consulta1);
	$rows1 = $result1->fetchAll();
	if(count($rows1) > 0){		
		foreach ($rows1 as $row1) {
			$ei = $row1['ei'];	
			$ai = $row1['ai'];	
			$ad = $row1['ad'];	
			$ed = $row1['ed'];	
			$num_perfil = $row1['num_perfil'];	
		}
	}
	
	$consulta2 = "SELECT a.perfil
	FROM perfil a
	WHERE a.id_perfil = '$num_perfil'";
	$result2 = $conn->query($consulta2);
	$rows2 = $result2->fetchAll();
	if(count($rows2) > 0){		
		foreach ($rows2 as $row2) {
			$perfil = $row2['perfil'];	
		}
	}
	
	$consulta3 = "SELECT a.joven_ei, a.joven_ai, a.joven_ad, a.joven_ed,
	a.libre_ei, a.libre_ai, a.libre_ad, a.libre_ed,
	a.laboral_ei, a.laboral_ai, a.laboral_ad, a.laboral_ed,
	a.auto_ei, a.auto_ai, a.auto_ad, a.auto_ed
	FROM resultado_buscador a
	WHERE a.id_buscador = '$id_buscador'";
	$result3 = $conn->query($consulta3);
	$rows3 = $result3->fetchAll();
	if(count($rows3) > 0){		
		foreach ($rows3 as $row3) {
			$joven_ei = $row3['joven_ei'];	
			$joven_ai = $row3['joven_ai'];	
			$joven_ad = $row3['joven_ad'];	
			$joven_ed = $row3['joven_ed'];	
			$libre_ei = $row3['libre_ei'];	
			$libre_ai = $row3['libre_ai'];	
			$libre_ad = $row3['libre_ad'];	
			$libre_ed = $row3['libre_ed'];	
			$laboral_ei = $row3['laboral_ei'];	
			$laboral_ai = $row3['laboral_ai'];	
			$laboral_ad = $row3['laboral_ad'];	
			$laboral_ed = $row3['laboral_ed'];	
			$auto_ei = $row3['auto_ei'];	
			$auto_ai = $row3['auto_ai'];	
			$auto_ad = $row3['auto_ad'];	
			$auto_ed = $row3['auto_ed'];	
		}
	}
	
	if(count($rows) > 0){
		?>	
		<div id="resp_pdf">
			<div class="row">
				<div class="col">
					<img class="float-left" alt="Servicio Público de Empleo" src="images/logo-spe.png" width="200" height="83">
				</div>
				<div class="col">
					<img class="float-right" alt="Ministerio del Trabajo" src="images/logo-mintrabajo.png" width="340" height="66">
				</div>
			</div>
			<div class="row mt-3"></div>
			<div><strong><?php echo $nombre." ".$apellido;?></strong></div>
			<div><?php echo $tipo_documento." ".$documento;?></div>
			<div class="row mt-3"></div>
			<div>Fecha de la prueba: <?php echo $fecha_prueba;?></div>
			<div>Prestador: <?php echo $prestador;?></div>
			
			<div class="row mt-3"></div>
			<h4>Estilos de pensamiento - Neuro fortaleza y Neuro debilidad</h4>
			<div class="row mt-3"></div>
			
			<div class="col-sm-12 text-center">
				<img class="center-block" alt="Estilos de pensamiento" src="images/cerebro.png?v=<?=$v_cok?>" width="640" height="298">
			</div>
			
			<div class="row mt-3"></div>
			<h4>Perfil de competencia</h4>
			<div class="row mt-3"></div>
			
			<div class="row text-center">
				<div class="col text-right">
					<img class="center-block" alt="Perfil de competencia" src="images/perfil_<?=$num_perfil?>.png?v=<?=$v_cok?>" width="200" height="200">
				</div>
				<div class="col text-left">
					<p><strong><?php echo $perfil; ?></strong></p>
					<p>
					<?php echo $desc_perfil; ?>
					</p>
				</div>
			</div>
			
			<div class="row mt-3"></div>
			<h4>Competencias desarrolladas</h4>
			<div class="row mt-3"></div>
			<div class="col-sm-12 text-center">
				<img class="center-block" alt="Estilos de pensamiento" src="respuesta_graf_barras.php?v=<?=$v_cok?>&ei=<?=$ei?>&ai=<?=$ai?>&ad=<?=$ad?>&ed=<?=$ed?>" width="600" height="320">
			</div>
			<div class="row mt-3 d-flex justify-content-center">
				<div class="col-sm-7">
					<table class="table table-striped">
						<thead class="alert alert-info">
							<tr>
								<th>Competencias</th>
								<th>Analítico EI</th>
								<th>Eficiente AI</th>
								<th>Empático AD</th>
								<th>Creativo ED</th>
							</tr>
						</thead>
						<tr>
							<td>Joven</td>
							<td><?php echo $joven_ei; ?></td>
							<td><?php echo $joven_ai; ?></td>
							<td><?php echo $joven_ad; ?></td>
							<td><?php echo $joven_ed; ?></td>
						</tr>
						<tr>
							<td>Adulto</td>
							<td><?php echo $ei; ?></td>
							<td><?php echo $ai; ?></td>
							<td><?php echo $ad; ?></td>
							<td><?php echo $ed; ?></td>
						</tr>
						<tr>
							<td>Tiempo Libre</td>
							<td><?php echo $libre_ei; ?></td>
							<td><?php echo $libre_ai; ?></td>
							<td><?php echo $libre_ad; ?></td>
							<td><?php echo $libre_ed; ?></td>
						</tr>
						<tr>
							<td>Laboral</td>
							<td><?php echo $laboral_ei; ?></td>
							<td><?php echo $laboral_ai; ?></td>
							<td><?php echo $laboral_ad; ?></td>
							<td><?php echo $laboral_ed; ?></td>
						</tr>
						<tr>
							<td>Autopercepción</td>
							<td><?php echo $auto_ei; ?></td>
							<td><?php echo $auto_ai; ?></td>
							<td><?php echo $auto_ad; ?></td>
							<td><?php echo $auto_ed; ?></td>
						</tr>
					</table>
				</div>
			</div>
			
		</div>
		<div class="row mt-3"></div>
		<input type="hidden" id="resp_nombres" value="<?php echo $nombre." ".$apellido;?>" />
		<input type="hidden" id="resp_docu" value="<?php echo $documento;?>" />
		<input type="hidden" id="resp_fech_prueba" value="<?php echo $fecha_prueba;?>" />
		<input type="hidden" id="resp_prestador" value="<?php echo $prestador;?>" />		
		<input type="hidden" id="num_perfil" value="<?php echo $num_perfil;?>" />
		<input type="hidden" id="perfil" value="<?php echo $perfil;?>" />
		<input type="hidden" id="desc_perfil" value="<?php echo $desc_perfil;?>" />
		<input type="hidden" id="ei" value="<?php echo $ei;?>" />
		<input type="hidden" id="ai" value="<?php echo $ai;?>" />
		<input type="hidden" id="ad" value="<?php echo $ad;?>" />
		<input type="hidden" id="ed" value="<?php echo $ed;?>" />		
		<input type="hidden" id="joven_ei" value="<?php echo $joven_ei;?>" />
		<input type="hidden" id="joven_ai" value="<?php echo $joven_ai;?>" />
		<input type="hidden" id="joven_ad" value="<?php echo $joven_ad;?>" />
		<input type="hidden" id="joven_ed" value="<?php echo $joven_ed;?>" />
		<input type="hidden" id="libre_ei" value="<?php echo $libre_ei;?>" />
		<input type="hidden" id="libre_ai" value="<?php echo $libre_ai;?>" />
		<input type="hidden" id="libre_ad" value="<?php echo $libre_ad;?>" />
		<input type="hidden" id="libre_ed" value="<?php echo $libre_ed;?>" />	
		<input type="hidden" id="laboral_ei" value="<?php echo $laboral_ei;?>" />
		<input type="hidden" id="laboral_ai" value="<?php echo $laboral_ai;?>" />
		<input type="hidden" id="laboral_ad" value="<?php echo $laboral_ad;?>" />
		<input type="hidden" id="laboral_ed" value="<?php echo $laboral_ed;?>" />
		<input type="hidden" id="auto_ei" value="<?php echo $auto_ei;?>" />
		<input type="hidden" id="auto_ai" value="<?php echo $auto_ai;?>" />
		<input type="hidden" id="auto_ad" value="<?php echo $auto_ad;?>" />
		<input type="hidden" id="auto_ed" value="<?php echo $auto_ed;?>" />			
		
		<button class="btn btn-primary" id="btn_crear_pdf">Descargar</button
		<?php
	}
	
	$conn = null;	
	
	
} catch (PDOException $e) {
	print "Error: " . $e->getMessage() . "<br/>";
	die();
}
?>
