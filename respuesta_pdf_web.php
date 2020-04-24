<?php
header('Content-Type: application/pdf');

require('fpdf/fpdf.php');

$actual_link = dirname((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")."/";

$intro_SPE = utf8_decode("La Unidad Administrativa Especial del Servicio Público de Empleo con la finalidad de fortalecer los servicios de orientación ocupacional y de preselección de la Red de Prestadores, durante los últimos años suscribió los contratos N .290 de 2015; N. 108 de 2018 y N. 64 de 2019 con el proveedor 4 Beyond SAS quien puso a disposición una plataforma online de su prueba Performance, a través de la cual se identificaban fortalezas y debilidades en los buscadores de empleo.<br><br> 
Teniendo en cuenta que el último contrato finalizó, la Unidad del SPE presenta un aplicativo que le permitirá a la Red de Prestadores consultar los resultados de las pruebas que fueron aplicadas a los buscadores de empleo. Esta búsqueda la podrán realizar con el número del documento de identificación y/o el correo electrónico que la persona usó en la inscripción a la prueba.");
$intro_SPE = str_replace("<br><br>", "\n", $intro_SPE); 

$intro_4B = utf8_decode("4B Performance For Beyond es una herramienta donde podrá identificar su Neurofortaleza, es decir saber donde están las cosas que hace mejor, aquello en lo que naturalmente es bueno y que está asociado con sus fortalezas, así como identificar cuál es su Neurodebilidad, es decir dónde están las tareas que se le dificultan.");

$titulo_01 = utf8_decode("Primera sección");

$titulo_01_des_01 = utf8_decode("Encontrará una gráfica de un cerebro que muestra las características asociadas a cada estilo de pensamiento. La tabla de resultados, le permitirá ver cuál es su estilo más usado en su Tiempo libre, Laboral, Autopercepción, Joven y Adulto. Siempre los puntajes más altos están asociados a su modo de pensamiento preferido o usado en esas situaciones.");

$titulo_01_des_02 = utf8_decode("Bienvenido al reporte Performance persona. A continuación podrá ver los 4 estilos de pensamiento y las caracteristicas que definen cada estilo.<br><br>
Es importante recordar que ningún estilo de pensamiento es mejor o peor que otro, lo más importante es poder entender en dónde fluyo con mayor naturalidad por que implica realizar tareas que se te facilitan, te gustan y las disfrutas");
$titulo_01_des_02 = str_replace("<br><br>", "\n", $titulo_01_des_02); 

$titulo_02 = utf8_decode("Segunda sección");

$titulo_02_des = utf8_decode("Se define cuál es su NEUROFORTALEZA, es decir en qué estilo de pensamiento están las cosas que se le facilitan. Hay una descripción de las características asociadas a este estilo de pensamiento. También se describen las características y tareas asociadas a su NEURODEBILIDAD, es decir el estilo de pensamiento donde están las cosas que se le dificultan; Ademas encontrará el PERFIL DE COMPETENCIAS.");

$resp_nombres = utf8_decode(strtoupper("Estefany Valencia"));
$resp_docu = utf8_decode("C.C. 1234567890");
$resp_fech_prueba = utf8_decode("2017-12-11");
$resp_prestador = utf8_decode("COMFAGUAJIRA_RIOHACHA COMFAGUAJIRA");

$num_estilo = utf8_decode("EI");
$estilo = utf8_decode("EI");
$estilo_desc = utf8_decode('Analiza información, datos, situaciones y personas, y aplica la lógica para tomar decisiones. Es objetivo y calmado. Si no tiene suficiente información, busca hasta quedar satisfecho con lo que ha encontrado. Se caracteriza por su pensamiento lógico, matemático o cuantitativo, analítico, estructural y con habilidades para el análisis de causas de un problema y la elaboración de diagnósticos. Cuenta con una alta capacidad para enfocarse en la solución de problemas y en la toma de decisiones soportadas en el análisis de hechos y datos con exactitud. Se destaca por comparar realidades diferentes para realizar una recomendación o tomar una decisión, se le facilitará la clasificación de información y establecer diferentes opciones de solución. Toda tarea que implique el establecimiento de prioridades será una buena oportunidad para analizar, categorizar, agrupar y evaluar. Hará un adecuado uso de la información disponible, para la toma de decisiones, será visto como alguien supremamente exigente consigo mismo y con su entorno, además de competitivo y orientado a resultados. En su toma de decisiones será percibido como un interlocutor crítico y confrontador.');
$estilo_desc_general = utf8_decode('estable, empático, trabajador incansable, escucha.');
$estilo_desc_adjetivo = utf8_decode('confiable, amable, paciente, estable, buen escucha, gentil.');
$estilo_desc_decision = utf8_decode('cauteloso en situaciones nuevas, evita riesgos, piensa en antecedentes, desea revisar  dos veces, concilia.');

$num_opuesto = utf8_decode("AI");
$opuesto = utf8_decode("AI");
$opuesto_desc = utf8_decode("Deberá hacer esfuerzo cada vez que deba efectuar acciones dentro de procedimientos que hayan sido previamente definidos y que le exijan el rigor de realizarse sin ninguna modificación. 
El realizar acciones en las que se requiera detectar, recolectar o administrar información detallada a través de procesos minuciosos y la realización de tareas de rutina con procedimientos consecutivos. 
Se esforzará en el cumplimiento de políticas y normas siempre y cuando éstas limiten sus intereses por promover cambios o generar soluciones que estén por fuera del marco normativo. 
Se le dificultará el exponer/adaptar su estilo naturalmente innovador a entornos o situaciones típicamente conservadoras a entornos rígidos y poco abiertos al cambio.");

$num_perfil = utf8_decode("11");
$perfil = utf8_decode("Técnico - Estratégico");
$perfil_desc = utf8_decode("Aquellos en que no está presente el modo Apoyo Derecho. Poseen una visión intelectual de corto y largo plazo, son personas que tienen habilidad para resolver problemas complejos y van directo al núcleo del problema. Para la solución de los problemas aplican su capacidad lógica, el análisis y su pensamiento crítico. Dirigen a las personas utilizando su análisis conceptual de los problemas y teniendo en cuenta los objetivos. Cuando se relacionan con las personas, tienen más en cuenta su conocimiento que su posición. Diseñan estrategias dirigidas a la consecución de objetivos globales. Menos del 20% de la población tiene este perfil. No obstante, pueden ser de mucha ayuda cuando se necesita que las personas cooperen entre sí, ya que ellos tienen su desarrollo de competencias en la mayoría de los estilos de pensamiento. Para utilizar este perfil es importante conocer cuál es su Neurodebilidad. Aunque como personas con un desarrollo de competencias Triple, son personas muy flexibles y adaptables, es probable que no le presten suficiente atención a su Neurodebilidad.");


$ei = 71;
$ai = 82;
$ad = 90;
$ed = 69;
$joven_ei = 24;
$joven_ai = 44;
$joven_ad = 52;
$joven_ed = 128;
$libre_ei = 16;
$libre_ai = 19;
$libre_ad = 26;
$libre_ed = 17;
$laboral_ei = 39;
$laboral_ai = 41;
$laboral_ad = 29;
$laboral_ed = 35;
$auto_ei = 16;
$auto_ai = 22;
$auto_ad = 35;
$auto_ed = 17;

class PDF extends FPDF
{
	// Page header
	function Header()
	{
		// Logo Unidad
		$this->Image('images/logo-spe.png',10,10,50);
		// Logo MinTrabajo
		$this->Image('images/logo-mintrabajo.png',119,10,80);
		// Line break
		$this->Ln(20);
	}

	// Page footer
	function Footer()
	{
		// Position at 1.5 cm from bottom
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Page number
		$this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
	}

	function drawTextBox($strText, $w, $h, $align='L', $valign='T', $border=true)
	{
		$xi=$this->GetX();
		$yi=$this->GetY();
		
		$hrow=$this->FontSize;
		$hrow=$hrow+1;
		$textrows=$this->drawRows($w,$hrow,$strText,0,$align,0,0,0);
		$maxrows=floor($h/$this->FontSize);
		$rows=min($textrows,$maxrows);

		$dy=0;
		if (strtoupper($valign)=='M')
			$dy=($h-$rows*$this->FontSize)/2;
		if (strtoupper($valign)=='B')
			$dy=$h-$rows*$this->FontSize;

		$this->SetY($yi+$dy);
		$this->SetX($xi);

		$this->drawRows($w,$hrow,$strText,0,$align,false,$rows,1);

		if ($border)
			$this->Rect($xi,$yi,$w,$h);
	}

	function drawRows($w, $h, $txt, $border=0, $align='J', $fill=false, $maxline=0, $prn=0)
	{
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 && $s[$nb-1]=="\n")
			$nb--;
		$b=0;
		if($border)
		{
			if($border==1)
			{
				$border='LTRB';
				$b='LRT';
				$b2='LR';
			}
			else
			{
				$b2='';
				if(is_int(strpos($border,'L')))
					$b2.='L';
				if(is_int(strpos($border,'R')))
					$b2.='R';
				$b=is_int(strpos($border,'T')) ? $b2.'T' : $b2;
			}
		}
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$ns=0;
		$nl=1;
		while($i<$nb)
		{
			//Get next character
			$c=$s[$i];
			if($c=="\n")
			{
				//Explicit line break
				if($this->ws>0)
				{
					$this->ws=0;
					if ($prn==1) $this->_out('0 Tw');
				}
				if ($prn==1) {
					$this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
				}
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$ns=0;
				$nl++;
				if($border && $nl==2)
					$b=$b2;
				if ( $maxline && $nl > $maxline )
					return substr($s,$i);
				continue;
			}
			if($c==' ')
			{
				$sep=$i;
				$ls=$l;
				$ns++;
			}
			$l+=$cw[$c];
			if($l>$wmax)
			{
				//Automatic line break
				if($sep==-1)
				{
					if($i==$j)
						$i++;
					if($this->ws>0)
					{
						$this->ws=0;
						if ($prn==1) $this->_out('0 Tw');
					}
					if ($prn==1) {
						$this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
					}
				}
				else
				{
					if($align=='J')
					{
						$this->ws=($ns>1) ? ($wmax-$ls)/1000*$this->FontSize/($ns-1) : 0;
						if ($prn==1) $this->_out(sprintf('%.3F Tw',$this->ws*$this->k));
					}
					if ($prn==1){
						$this->Cell($w,$h,substr($s,$j,$sep-$j),$b,2,$align,$fill);
					}
					$i=$sep+1;
				}
				$sep=-1;
				$j=$i;
				$l=0;
				$ns=0;
				$nl++;
				if($border && $nl==2)
					$b=$b2;
				if ( $maxline && $nl > $maxline )
					return substr($s,$i);
			}
			else
				$i++;
		}
		//Last chunk
		if($this->ws>0)
		{
			$this->ws=0;
			if ($prn==1) $this->_out('0 Tw');
		}
		if($border && is_int(strpos($border,'B')))
			$b.='B';
		if ($prn==1) {
			$this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
		}
		$this->x=$this->lMargin;
		return $nl;
	}

	function RoundedRect($x, $y, $w, $h, $r, $corners = '1234', $style = '')
    {
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
            $op='f';
        elseif($style=='FD' || $style=='DF')
            $op='B';
        else
            $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));

        $xc = $x+$w-$r;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));
        if (strpos($corners, '2')===false)
            $this->_out(sprintf('%.2F %.2F l', ($x+$w)*$k,($hp-$y)*$k ));
        else
            $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);

        $xc = $x+$w-$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
        if (strpos($corners, '3')===false)
            $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-($y+$h))*$k));
        else
            $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);

        $xc = $x+$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
        if (strpos($corners, '4')===false)
            $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-($y+$h))*$k));
        else
            $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);

        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
        if (strpos($corners, '1')===false)
        {
            $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$y)*$k ));
            $this->_out(sprintf('%.2F %.2F l',($x+$r)*$k,($hp-$y)*$k ));
        }
        else
            $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
            $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
    }

}

// Cuerpo
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFillColor(231,231,231);
$pdf->RoundedRect(10, 40, 188, 55, 1, '1234', 'F');

$pdf->SetXY(15,45);
$pdf->SetFont('helvetica','',10);
$pdf->drawTextBox($intro_SPE, 183, 37, '', '', false);

$pdf->SetFillColor(31,100,210);
$pdf->RoundedRect(10, 99, 188, 25, 1, '1234', 'F');

$pdf->SetXY(15,105);
$pdf->SetFont('helvetica','B',10);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(15,0,$resp_nombres,0,1);

$pdf->SetXY(15,109);
$pdf->SetFont('helvetica','',8);
$pdf->Cell(15,0,$resp_docu,0,1);

$pdf->SetXY(15,117);
$pdf->SetFont('helvetica','B',8);
$pdf->Cell(15,0,"Prestador:",0,1);

$pdf->SetXY(30,117);
$pdf->SetFont('helvetica','',8);
$pdf->Cell(15,0,$resp_prestador,0,1);

$pdf->SetXY(150,117);
$pdf->SetFont('helvetica','B',8);
$pdf->Cell(15,0,"Fecha de la prueba:",0,1);

$pdf->SetXY(178,117);
$pdf->SetFont('helvetica','',8);
$pdf->Cell(15,0,$resp_fech_prueba,0,1);

$pdf->SetFillColor(231,231,231);
$pdf->RoundedRect(10, 128, 188, 22, 1, '1234', 'F');

$pdf->SetXY(15,132);
$pdf->SetFont('helvetica','',10);
$pdf->SetTextColor(0,0,0);
$pdf->drawTextBox($intro_4B, 183, 37, '', '', false);

$pdf->SetXY(9,160);
$pdf->SetFont('helvetica','',12);
$pdf->SetTextColor(33,37,41);
$pdf->Cell(0,0,$titulo_01,0,1);

$pdf->SetXY(9,165);
$pdf->SetFont('helvetica','',10);
$pdf->drawTextBox($titulo_01_des_01, 183, 37, '', '', false);

$pdf->SetXY(9,190);
$pdf->SetFont('helvetica','',12);
$pdf->SetTextColor(33,37,41);
$pdf->Cell(0,0,$titulo_02,0,1);

$pdf->SetXY(9,195);
$pdf->SetFont('helvetica','',10);
$pdf->drawTextBox($titulo_02_des, 183, 37, '', '', false);

$pdf->AddPage(); //NUEVA PAGINA

$pdf->SetXY(9,40);
$pdf->SetFont('helvetica','',15);
$pdf->Cell(0,0,$titulo_01,0,1);

$pdf->SetXY(9,50);
$pdf->SetFont('helvetica','',10);
$pdf->drawTextBox($titulo_01_des_02, 183, 37, '', '', false);

//Imagen cerebro
$pdf->Image('images/cerebro_solo.png',80,83,50);

$pdf->SetXY(45,88);
$pdf->SetFont('helvetica','B',12);
$pdf->Cell(0,0,utf8_decode("Analítico"),0,1);

$pdf->SetXY(45,93);
$pdf->SetFont('helvetica','B',8);
$pdf->Cell(0,0,utf8_decode("Lógico"),0,1);

$pdf->SetXY(45,97);
$pdf->Cell(0,0,utf8_decode("Analítico"),0,1);

$pdf->SetXY(45,101);
$pdf->Cell(0,0,utf8_decode("Confrontador"),0,1);

$pdf->SetXY(45,105);
$pdf->Cell(0,0,utf8_decode("Toma de Decisiones"),0,1);

$pdf->SetXY(45,109);
$pdf->Cell(0,0,utf8_decode("Orientado a resultados"),0,1);

$pdf->SetXY(45,124);
$pdf->SetFont('helvetica','B',12);
$pdf->Cell(0,0,utf8_decode("Eficiente"),0,1);

$pdf->SetXY(45,129);
$pdf->SetFont('helvetica','B',8);
$pdf->Cell(0,0,utf8_decode("Ordenado"),0,1);

$pdf->SetXY(45,133);
$pdf->Cell(0,0,utf8_decode("Procedimental"),0,1);

$pdf->SetXY(45,137);
$pdf->Cell(0,0,utf8_decode("Productivo"),0,1);

$pdf->SetXY(45,141);
$pdf->Cell(0,0,utf8_decode("Cauteloso"),0,1);

$pdf->SetXY(45,145);
$pdf->Cell(0,0,utf8_decode("Eficiente"),0,1);

$pdf->SetXY(133,88);
$pdf->SetFont('helvetica','B',12);
$pdf->Cell(0,0,utf8_decode("Creativo"),0,1);

$pdf->SetXY(133,93);
$pdf->SetFont('helvetica','B',8);
$pdf->Cell(0,0,utf8_decode("Visionario"),0,1);

$pdf->SetXY(133,97);
$pdf->Cell(0,0,utf8_decode("Innovador"),0,1);

$pdf->SetXY(133,101);
$pdf->Cell(0,0,utf8_decode("Metafórico"),0,1);

$pdf->SetXY(133,105);
$pdf->Cell(0,0,utf8_decode("Toma Riesgos"),0,1);

$pdf->SetXY(133,124);
$pdf->SetFont('helvetica','B',12);
$pdf->Cell(0,0,utf8_decode("Empático"),0,1);

$pdf->SetXY(133,129);
$pdf->SetFont('helvetica','B',8);
$pdf->Cell(0,0,utf8_decode("Sentido de Pertenencia"),0,1);

$pdf->SetXY(133,133);
$pdf->Cell(0,0,utf8_decode("Armonizador"),0,1);

$pdf->SetXY(133,137);
$pdf->Cell(0,0,utf8_decode("Conciliador"),0,1);

$pdf->SetXY(133,141);
$pdf->Cell(0,0,utf8_decode("Sensitivo"),0,1);

$pdf->SetXY(133,145);
$pdf->Cell(0,0,utf8_decode("Empático"),0,1);

//Gráfico de barras
$img = file_get_contents($actual_link."respuesta_graf_barras.php?ei=$ei&ai=$ai&ad=$ad&ed=$ed");
$pic = 'data://text/plain;base64,' . base64_encode($img);
$pdf->Image($pic, 40, 151, 135, 72, 'jpg');

//Tabla de competencias
$pdf->SetFillColor(255,255,255); // Background color
$pdf->SetFont('helvetica','B',9);

$pdf->SetDrawColor(100,100,100);
$pdf->Line(40, 223, 168, 223);
$pdf->SetXY(40,223);
$pdf->Cell(26,8,utf8_decode("Competencias"),0,1,'C',true);
$pdf->SetXY(66,223);
$pdf->Cell(26,8,utf8_decode("Analítico EI"),0,1,'C',true);
$pdf->SetXY(92,223);
$pdf->Cell(26,8,utf8_decode("Eficiente AI"),0,1,'C',true);
$pdf->SetXY(118,223);
$pdf->Cell(26,8,utf8_decode("Empático AD"),0,1,'C',true);
$pdf->SetXY(144,223);
$pdf->Cell(25,8,utf8_decode("Creativo ED"),0,1,'C',true);

$pdf->SetFillColor(184,218,255); // Background color
$pdf->SetFont('helvetica','',9);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(40,231);
$pdf->Cell(26,8,utf8_decode("Joven"),0,1,'C',true);
$pdf->SetXY(66,231);
$pdf->Cell(26,8,utf8_decode($joven_ei),0,1,'C',true);
$pdf->SetXY(92,231);
$pdf->Cell(26,8,utf8_decode($joven_ai),0,1,'C',true);
$pdf->SetXY(118,231);        
$pdf->Cell(26,8,utf8_decode($joven_ad),0,1,'C',true);
$pdf->SetXY(144,231);        
$pdf->Cell(25,8,utf8_decode($joven_ed),0,1,'C',true);

$pdf->SetFillColor(184,218,255); // Background color
$pdf->SetFont('helvetica','',9);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(40,239);
$pdf->Cell(26,8,utf8_decode("Adulto"),0,1,'C',true);
$pdf->SetXY(66,239);
$pdf->Cell(26,8,utf8_decode($ei),0,1,'C',true);
$pdf->SetXY(92,239);
$pdf->Cell(26,8,utf8_decode($ai),0,1,'C',true);
$pdf->SetXY(118,239);
$pdf->Cell(26,8,utf8_decode($ad),0,1,'C',true);
$pdf->SetXY(144,239);
$pdf->Cell(25,8,utf8_decode($ed),0,1,'C',true);

$pdf->SetFillColor(0,123,255); // Background color
$pdf->SetFont('helvetica','',9);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(40,247);
$pdf->Cell(26,8,utf8_decode("Tiempo Libre"),0,1,'C',true);
$pdf->SetXY(66,247);
$pdf->Cell(26,8,utf8_decode($libre_ei),0,1,'C',true);
$pdf->SetXY(92,247);        
$pdf->Cell(26,8,utf8_decode($libre_ai),0,1,'C',true);
$pdf->SetXY(118,247);       
$pdf->Cell(26,8,utf8_decode($libre_ad),0,1,'C',true);
$pdf->SetXY(144,247);       
$pdf->Cell(25,8,utf8_decode($libre_ed),0,1,'C',true);

$pdf->SetFillColor(0,123,255); // Background color
$pdf->SetFont('helvetica','',9);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(40,255);
$pdf->Cell(26,8,utf8_decode("Laboral"),0,1,'C',true);
$pdf->SetXY(66,255);
$pdf->Cell(26,8,utf8_decode($laboral_ei),0,1,'C',true);
$pdf->SetXY(92,255);        
$pdf->Cell(26,8,utf8_decode($laboral_ai),0,1,'C',true);
$pdf->SetXY(118,255);       
$pdf->Cell(26,8,utf8_decode($laboral_ad),0,1,'C',true);
$pdf->SetXY(144,255);       
$pdf->Cell(25,8,utf8_decode($laboral_ed),0,1,'C',true);

$pdf->SetFillColor(0,123,255); // Background color
$pdf->SetFont('helvetica','',9);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(40,263);
$pdf->Cell(26,8,utf8_decode("Autopercepción"),0,1,'C',true);
$pdf->SetXY(66,263);
$pdf->Cell(26,8,utf8_decode($auto_ei),0,1,'C',true);
$pdf->SetXY(92,263);        
$pdf->Cell(26,8,utf8_decode($auto_ai),0,1,'C',true);
$pdf->SetXY(118,263);       
$pdf->Cell(26,8,utf8_decode($auto_ad),0,1,'C',true);
$pdf->SetXY(144,263);       
$pdf->Cell(25,8,utf8_decode($auto_ed),0,1,'C',true);

$pdf->AddPage(); //NUEVA PAGINA

$pdf->SetXY(9,40);
$pdf->SetFont('helvetica','',15);
$pdf->Cell(0,0,$titulo_02,0,1);

$pdf->SetFillColor(255,255,255);
$pdf->SetDrawColor(200,200,200);
$pdf->RoundedRect(10, 50, 188, 100, 1, '1234', 'DF');

$pdf->Image("images/estilo_$num_estilo.png",5,62,50);

$pdf->SetXY(50,40);
$pdf->SetFont('helvetica','B',8);
$pdf->Cell(15,35,"NEUROFORTALEZA: $estilo",0,1);

$pdf->SetXY(50,63);
$pdf->SetFont('helvetica','',9);
$pdf->SetTextColor(0,0,0);
$pdf->drawTextBox($estilo_desc, 145, 45, '', '', false);

$pdf->SetXY(22,123);
$pdf->SetFont('helvetica','B',8);
$pdf->Cell(0,0,"Descriptor General:",0,1);

$pdf->SetXY(50,121);
$pdf->SetFont('helvetica','',9);
$pdf->SetFont('helvetica','',9);
$pdf->drawTextBox($estilo_desc_general, 145, 2, '', '', false); 

$pdf->SetXY(11,131);
$pdf->SetFont('helvetica','B',8);
$pdf->Cell(0,0,"Adjetivos que lo describen:",0,1);

$pdf->SetXY(50,129);
$pdf->SetFont('helvetica','',9);
$pdf->drawTextBox($estilo_desc_adjetivo, 145, 2, '', '', false); 

$pdf->SetXY(23,139);
$pdf->SetFont('helvetica','B',8);
$pdf->Cell(0,0,utf8_decode("Toma de decisión:"),0,1);

$pdf->SetXY(50,137);
$pdf->SetFont('helvetica','',9);
$pdf->drawTextBox($estilo_desc_decision, 145, 2, '', '', false);

$pdf->SetFillColor(255,255,255);
$pdf->SetDrawColor(200,200,200);
$pdf->RoundedRect(10, 155, 188, 55, 1, '1234', 'DF');

$pdf->Image("images/opuesto_$num_opuesto.png",5,161,50);

$pdf->SetXY(50,150);
$pdf->SetFont('helvetica','B',8);
$pdf->Cell(15,25,"NEURODEBILIDAD: $opuesto",0,1);

$pdf->SetXY(50,167);
$pdf->SetFont('helvetica','',9);
$pdf->SetTextColor(0,0,0);
$pdf->drawTextBox($opuesto_desc, 145, 30, '', '', false);

$pdf->SetFillColor(255,255,255);
$pdf->SetDrawColor(200,200,200);
$pdf->RoundedRect(10, 215, 188, 62, 1, '1234', 'DF');

$pdf->Image("images/perfil_$num_perfil.png",5,222,50);

$pdf->SetXY(50,210);
$pdf->SetFont('helvetica','B',8);
$pdf->Cell(15,25,"PERFIL DE COMPETENCIAS: $perfil",0,1);

$pdf->SetXY(50,227);
$pdf->SetFont('helvetica','',9);
$pdf->SetTextColor(0,0,0);
$pdf->drawTextBox($perfil_desc, 145, 35, '', '', false);

$pdf->Output();
?>
