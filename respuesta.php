<script src="js/app_pdf.js?v=<?=filemtime('js/app_pdf.js');?>"></script>
<?php
include('conf.ini');

$fecha = new DateTime();
$v_cok = $fecha->getTimestamp();
$id_buscador = "";
$id_estilo = "";
$num_perfil = "";

$intro_SPE = "La Unidad Administrativa Especial del Servicio Público de Empleo con la finalidad de fortalecer los servicios de orientación ocupacional y de preselección de la Red de Prestadores, durante los últimos años suscribió los contratos N .290 de 2015; N. 108 de 2018 y N. 64 de 2019 con el proveedor 4 Beyond SAS quien puso a disposición una plataforma online de su prueba Performance, a través de la cual se identificaban fortalezas y debilidades en los buscadores de empleo.<br><br> 
Teniendo en cuenta que el último contrato finalizó, la Unidad del SPE presenta un aplicativo que le permitirá a la Red de Prestadores consultar los resultados de las pruebas que fueron aplicadas a los buscadores de empleo. Esta búsqueda la podrán realizar con el número del documento de identificación y/o el correo electrónico que la persona usó en la inscripción a la prueba.";

$intro_4B = "4B Performance For Beyond es una herramienta donde podrá identificar su Neurofortaleza, es decir saber donde están las cosas que hace mejor, aquello en lo que naturalmente es bueno y que está asociado con sus fortalezas, así como identificar cuál es su Neurodebilidad, es decir dónde están las tareas que se le dificultan.";

$titulo_01 = "Primera sección";

$titulo_01_des_01 = "Encontrará una gráfica de un cerebro que muestra las características asociadas a cada estilo de pensamiento. La tabla de resultados, le permitirá ver cuál es su estilo más usado en su Tiempo libre, Laboral, Autopercepción, Joven y Adulto. Siempre los puntajes más altos están asociados a su modo de pensamiento preferido o usado en esas situaciones.";

$titulo_01_des_02 = "Bienvenido al reporte Performance persona. A continuación podrá ver los 4 estilos de pensamiento y las caracteristicas que definen cada estilo.<br><br>
Es importante recordar que ningún estilo de pensamiento es mejor o peor que otro, lo más importante es poder entender en dónde fluyo con mayor naturalidad por que implica realizar tareas que se te facilitan, te gustan y las disfrutas";

$titulo_02 = "Segunda sección";

$titulo_02_des = "Se define cuál es su NEUROFORTALEZA, es decir en qué estilo de pensamiento están las cosas que se le facilitan. Hay una descripción de las características asociadas a este estilo de pensamiento. También se describen las características y tareas asociadas a su NEURODEBILIDAD, es decir el estilo de pensamiento donde están las cosas que se le dificultan; Ademas encontrará el PERFIL DE COMPETENCIAS.";


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

try {
	
	$conn = new PDO("mysql:host=$h_db1;dbname=$b_db1", $u_db1, $p_db1);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//Consulta nombres y apellidos del candidato
	if(($num_cedula != "")&&($correo_e == "")){
		$consulta = "SELECT a.id_buscador
		, a.nombre
		, a.apellido
		, b.tipo_documento
		, a.documento
		, a.fecha_prueba
		, concat(c.nombre,' ',c.apellido) AS prestador
		FROM buscador a
		INNER JOIN tipo_documento b
		ON a.id_tipo_documento = b.id_tipo_documento
		INNER JOIN prestador_usuario c
		ON a.id_prestador_usuario = c.id_prestador_usuario
		WHERE a.documento = '$num_cedula'";
	}
	if(($num_cedula == "")&&($correo_e != "")){
		$consulta = "SELECT a.id_buscador
		, a.nombre
		, a.apellido
		, b.tipo_documento
		, a.documento
		, a.fecha_prueba
		, concat(c.nombre,' ',c.apellido) AS prestador
		FROM buscador a
		INNER JOIN tipo_documento b
		ON a.id_tipo_documento = b.id_tipo_documento
		INNER JOIN prestador_usuario c
		ON a.id_prestador_usuario = c.id_prestador_usuario
		WHERE a.email = '$correo_e'";
	}
	if(($num_cedula != "")&&($correo_e != "")){
		$consulta = "SELECT a.id_buscador
		, a.nombre
		, a.apellido
		, b.tipo_documento
		, a.documento
		, a.fecha_prueba
		, concat(c.nombre,' ',c.apellido) AS prestador
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
	
	$consulta1 = "SELECT a.ei
	, a.ai
	, a.ad
	, a.ed
	, a.id_estilo
	, RIGHT(CONCAT('00',a.id_perfil),2) AS num_perfil
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
			$id_estilo = $row1['id_estilo'];	
			$num_perfil = $row1['num_perfil'];	
		}
	}
	
	$consulta2 = "SELECT a.perfil
	, a.desc_perfil
	FROM perfil a
	WHERE a.id_perfil = '$num_perfil'";
	$result2 = $conn->query($consulta2);
	$rows2 = $result2->fetchAll();
	if(count($rows2) > 0){		
		foreach ($rows2 as $row2) {
			$perfil = $row2['perfil'];	
			$perfil_desc = $row2['desc_perfil'];
		}
	}
	
	$consulta3 = "SELECT a.estilo
	, a.opuesto
	, a.estilo_desc
	, a.estilo_desc_general
	, a.estilo_desc_adjetivo
	, a.estilo_desc_decision
	, a.opuesto_desc
	FROM estilo a
	WHERE a.id_estilo = '$id_estilo'";
	$result3 = $conn->query($consulta3);
	$rows3 = $result3->fetchAll();
	if(count($rows3) > 0){		
		foreach ($rows3 as $row3) {
			$num_estilo = $row3['estilo'];	
			$estilo = $row3['estilo'];	
			$num_opuesto = $row3['opuesto'];	
			$opuesto = $row3['opuesto'];
			$estilo_desc = $row3['estilo_desc'];	
			$estilo_desc_general = $row3['estilo_desc_general'];	
			$estilo_desc_adjetivo = $row3['estilo_desc_adjetivo'];	
			$estilo_desc_decision = $row3['estilo_desc_decision'];	
			$opuesto_desc = $row3['opuesto_desc'];	
		}
	}
	
	$consulta4 = "SELECT a.joven_ei
	, a.joven_ai
	, a.joven_ad
	, a.joven_ed
	, a.libre_ei
	, a.libre_ai
	, a.libre_ad
	, a.libre_ed
	, a.laboral_ei
	, a.laboral_ai
	, a.laboral_ad
	, a.laboral_ed
	, a.auto_ei
	, a.auto_ai
	, a.auto_ad
	, a.auto_ed
	FROM resultado_buscador a
	WHERE a.id_buscador = '$id_buscador'";
	$result4 = $conn->query($consulta4);
	$rows4 = $result4->fetchAll();
	if(count($rows4) > 0){		
		foreach ($rows4 as $row4) {
			$joven_ei = $row4['joven_ei'];	
			$joven_ai = $row4['joven_ai'];	
			$joven_ad = $row4['joven_ad'];	
			$joven_ed = $row4['joven_ed'];	
			$libre_ei = $row4['libre_ei'];	
			$libre_ai = $row4['libre_ai'];	
			$libre_ad = $row4['libre_ad'];	
			$libre_ed = $row4['libre_ed'];	
			$laboral_ei = $row4['laboral_ei'];	
			$laboral_ai = $row4['laboral_ai'];	
			$laboral_ad = $row4['laboral_ad'];	
			$laboral_ed = $row4['laboral_ed'];	
			$auto_ei = $row4['auto_ei'];	
			$auto_ai = $row4['auto_ai'];	
			$auto_ad = $row4['auto_ad'];	
			$auto_ed = $row4['auto_ed'];	
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
			
			<div class="row mt-5"></div>
			
			<div class="border bg-grey shadow-sm rounded-lg p-3">
				<div><?php echo $intro_SPE; ?></div>
			</div>
			
			<div class="row mt-3"></div>
			
			<div class="border bg-blue shadow-sm rounded-lg p-3">
				<div class="text-light text-height-1 text-uppercase"><h5><?php echo $nombre." ".$apellido;?></h5></div>
				<div class="text-light text-height-1"><small><?php echo $tipo_documento." ".$documento;?></small></div>
				<div class="row mt-3"></div>
				<div class="row">
					<div class="col text-left">
						<div class="text-light"><small><strong>Prestador:</strong> <?php echo $prestador;?></small></div>						
					</div>
					<div class="col text-right">
						<div class="text-light"><small><strong>Fecha de la prueba:</strong> <?php echo $fecha_prueba;?></small></div>
					</div>
				</div>
			</div>
			
			<div class="row mt-3"></div>
			
			<div class="border bg-grey shadow-sm rounded-lg p-3">
				<div><?php echo $intro_4B; ?></div>
			</div>
			
			<div class="row mt-3"></div>
			
			<div>
				<h5><?php echo $titulo_01;?></h5>
				<p>
				<?php echo $titulo_01_des_01;?>
				</p>
				<h5><?php echo $titulo_02;?></h5>
				<p>
				<?php echo $titulo_02_des;?>
				</p>
			</div>
						
			<div class="row mt-5"></div>
			
			<h3><?php echo $titulo_01;?></h3>
			
			<div class="row mt-3"></div>
			
			<div>
				<p><?php echo $titulo_01_des_02;?></p>
			</div>
			
			<div class="row mt-3"></div>
			
			<div class="col-sm-12 text-center">
				<img class="center-block" alt="Estilos de pensamiento" src="images/cerebro.png?v=<?=$v_cok?>" width="640" height="298">
			</div>
			
			<div class="row mt-3"></div>
			
			<div class="col-sm-12 text-center">
				<img class="center-block" alt="Estilos de pensamiento" src="respuesta_graf_barras.php?v=<?=$v_cok?>&ei=<?=$ei?>&ai=<?=$ai?>&ad=<?=$ad?>&ed=<?=$ed?>" width="600" height="320">
			</div>			
			
			<div class="row mt-3"></div>
			
			<div class="d-flex justify-content-center">
				<div class="col-sm-7">
					<table class="table">
						<thead class="alert">
							<tr>
								<th>Competencias</th>
								<th>Analítico EI</th>
								<th>Eficiente AI</th>
								<th>Empático AD</th>
								<th>Creativo ED</th>
							</tr>
						</thead>
						<tr class="table-primary">
							<td>Joven</td>
							<td><?php echo $joven_ei; ?></td>
							<td><?php echo $joven_ai; ?></td>
							<td><?php echo $joven_ad; ?></td>
							<td><?php echo $joven_ed; ?></td>
						</tr>
						<tr class="table-primary">
							<td>Adulto</td>
							<td><?php echo $ei; ?></td>
							<td><?php echo $ai; ?></td>
							<td><?php echo $ad; ?></td>
							<td><?php echo $ed; ?></td>
						</tr>
						<tr class="bg-primary">
							<td>Tiempo Libre</td>
							<td><?php echo $libre_ei; ?></td>
							<td><?php echo $libre_ai; ?></td>
							<td><?php echo $libre_ad; ?></td>
							<td><?php echo $libre_ed; ?></td>
						</tr>
						<tr class="bg-primary">
							<td>Laboral</td>
							<td><?php echo $laboral_ei; ?></td>
							<td><?php echo $laboral_ai; ?></td>
							<td><?php echo $laboral_ad; ?></td>
							<td><?php echo $laboral_ed; ?></td>
						</tr>
						<tr class="bg-primary">
							<td>Autopercepción</td>
							<td><?php echo $auto_ei; ?></td>
							<td><?php echo $auto_ai; ?></td>
							<td><?php echo $auto_ad; ?></td>
							<td><?php echo $auto_ed; ?></td>
						</tr>
					</table>
				</div>
			</div>
						
			<div class="row mt-5"></div>
			
			<h3><?php echo $titulo_02;?></h3>
			
			<div class="row mt-3"></div>
			
			<div class="border row text-center shadow-sm rounded-lg p-3">
				<div class="row">
					<div class="col-3 text-right">
						<img class="center-block" alt="Perfil de competencia" src="images/estilo_<?=$num_estilo?>.png?v=<?=$v_cok?>" width="200" height="200">
					</div>
					<div class="col text-left">
						<p><strong>NEUROFORTALEZA: <?php echo $estilo; ?></strong></p>
						<p>
						<?php echo $estilo_desc; ?>					
						</p>
					</div>
					<div class="w-100"></div>
					<div class="col-3 text-right">
						<p><strong>Descriptor General:</strong></p>
					</div>
					<div class="col text-left">
						<p><?=$estilo_desc_general?></p>
					</div>
					<div class="w-100"></div>
					<div class="col-3 text-right">
						<p><strong>Adjetivos que lo describen:</strong></p>
					</div>
					<div class="col text-left">
						<p><?=$estilo_desc_adjetivo?></p>
					</div>
					<div class="w-100"></div>
					<div class="col-3 text-right">
						<p><strong>Toma de decisión:</strong></p>
					</div>
					<div class="col text-left">
						<p><?=$estilo_desc_decision?></p>
					</div>
				</div>
			</div>
			
			<div class="row mt-3"></div>
			
			<div class="border row text-center shadow-sm rounded-lg p-3">
				<div class="col-3 text-right">
					<img class="center-block" alt="Perfil de competencia" src="images/opuesto_<?=$num_opuesto?>.png?v=<?=$v_cok?>" width="200" height="200">
				</div>
				<div class="col text-left">
					<p><strong>NEURODEBILIDAD: <?php echo $opuesto; ?></strong></p>
					<p>
					<?php echo $opuesto_desc; ?>
					</p>
				</div>
			</div>
			
			<div class="row mt-3"></div>
			
			<div class="border row text-center shadow-sm rounded-lg p-3">
				<div class="col-3 text-right">
					<img class="center-block" alt="Perfil de competencia" src="images/perfil_<?=$num_perfil?>.png?v=<?=$v_cok?>" width="200" height="200">
				</div>
				<div class="col text-left">
					<p><strong>PERFIL DE COMPETENCIAS: <?php echo $perfil; ?></strong></p>
					<p>
					<?php echo $perfil_desc; ?>
					</p>
				</div>
			</div>
						
		</div>
		<div class="row mt-3"></div>
		<input type="hidden" id="intro_SPE" value="<?php echo $intro_SPE;?>" />
		<input type="hidden" id="intro_4B" value="<?php echo $intro_4B;?>" />
		<input type="hidden" id="titulo_01" value="<?php echo $titulo_01;?>" />
		<input type="hidden" id="titulo_01_des_01" value="<?php echo $titulo_01_des_01;?>" />
		<input type="hidden" id="titulo_01_des_02" value="<?php echo $titulo_01_des_02;?>" />		
		<input type="hidden" id="titulo_02" value="<?php echo $titulo_02;?>" />
		<input type="hidden" id="titulo_02_des" value="<?php echo $titulo_02_des;?>" />		
		<input type="hidden" id="resp_nombres" value="<?php echo $nombre." ".$apellido;?>" />
		<input type="hidden" id="resp_docu" value="<?php echo $documento;?>" />
		<input type="hidden" id="resp_fech_prueba" value="<?php echo $fecha_prueba;?>" />
		<input type="hidden" id="resp_prestador" value="<?php echo $prestador;?>" />	
		<input type="hidden" id="num_estilo" value="<?php echo $num_estilo;?>" />
		<input type="hidden" id="estilo" value="<?php echo $estilo;?>" />
		<input type="hidden" id="estilo_desc" value="<?php echo $estilo_desc;?>" />		
		<input type="hidden" id="estilo_desc_general" value="<?php echo $estilo_desc_general;?>" />		
		<input type="hidden" id="estilo_desc_adjetivo" value="<?php echo $estilo_desc_adjetivo;?>" />		
		<input type="hidden" id="estilo_desc_decision" value="<?php echo $estilo_desc_decision;?>" />		
		<input type="hidden" id="num_opuesto" value="<?php echo $num_opuesto;?>" />
		<input type="hidden" id="opuesto" value="<?php echo $opuesto;?>" />
		<input type="hidden" id="opuesto_desc" value="<?php echo $opuesto_desc;?>" />		
		<input type="hidden" id="num_perfil" value="<?php echo $num_perfil;?>" />
		<input type="hidden" id="perfil" value="<?php echo $perfil;?>" />
		<input type="hidden" id="perfil_desc" value="<?php echo $perfil_desc;?>" />
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
