<?php
header('Content-Type: application/pdf');

require('fpdf/fpdf.php');

$actual_link = dirname((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")."/";

if(isset($_POST["intro_SPE"])){ $intro_SPE = utf8_decode($_POST["intro_SPE"]); }else{ $intro_SPE = ""; }
$intro_SPE = str_replace("<br><br>", "\n", $intro_SPE); 
if(isset($_POST["intro_4B"])){ $intro_4B = utf8_decode($_POST["intro_4B"]); }else{ $intro_4B = ""; }
if(isset($_POST["titulo_01"])){ $titulo_01 = utf8_decode($_POST["titulo_01"]); }else{ $titulo_01 = ""; }
if(isset($_POST["titulo_01_des_01"])){ $titulo_01_des_01 = utf8_decode($_POST["titulo_01_des_01"]); }else{ $titulo_01_des_01 = ""; }
if(isset($_POST["titulo_01_des_02"])){ $titulo_01_des_02 = utf8_decode($_POST["titulo_01_des_02"]); }else{ $titulo_01_des_02 = ""; }
$titulo_01_des_02 = str_replace("<br><br>", "\n", $titulo_01_des_02); 
if(isset($_POST["titulo_02"])){ $titulo_02 = utf8_decode($_POST["titulo_02"]); }else{ $titulo_02 = ""; }
if(isset($_POST["titulo_02_des"])){ $titulo_02_des = utf8_decode($_POST["titulo_02_des"]); }else{ $titulo_02_des = ""; }

if(isset($_POST["resp_nombres"])){ $resp_nombres = utf8_decode(strtoupper($_POST["resp_nombres"])); }else{ $resp_nombres = ""; }
if(isset($_POST["resp_docu"])){ $resp_docu = utf8_decode($_POST["resp_docu"]); }else{ $resp_docu = ""; }
if(isset($_POST["resp_fech_prueba"])){ $resp_fech_prueba = utf8_decode($_POST["resp_fech_prueba"]); }else{ $resp_fech_prueba = ""; }
if(isset($_POST["resp_prestador"])){ $resp_prestador = utf8_decode($_POST["resp_prestador"]); }else{ $resp_prestador = ""; }

if(isset($_POST["num_estilo"])){ $num_estilo = utf8_decode($_POST["num_estilo"]); }else{ $num_estilo = ""; }
if(isset($_POST["estilo"])){ $estilo = utf8_decode($_POST["estilo"]); }else{ $estilo = ""; }
if(isset($_POST["estilo_desc"])){ $estilo_desc = utf8_decode($_POST["estilo_desc"]); }else{ $estilo_desc = ""; }
if(isset($_POST["estilo_desc_general"])){ $estilo_desc_general = utf8_decode($_POST["estilo_desc_general"]); }else{ $estilo_desc_general = ""; }
if(isset($_POST["estilo_desc_adjetivo"])){ $estilo_desc_adjetivo = utf8_decode($_POST["estilo_desc_adjetivo"]); }else{ $estilo_desc_adjetivo = ""; }
if(isset($_POST["estilo_desc_decision"])){ $estilo_desc_decision = utf8_decode($_POST["estilo_desc_decision"]); }else{ $estilo_desc_decision = ""; }
if(isset($_POST["num_opuesto"])){ $num_opuesto = utf8_decode($_POST["num_opuesto"]); }else{ $num_opuesto = ""; }
if(isset($_POST["opuesto"])){ $opuesto = utf8_decode($_POST["opuesto"]); }else{ $opuesto = ""; }
if(isset($_POST["opuesto_desc"])){ $opuesto_desc = utf8_decode($_POST["opuesto_desc"]); }else{ $opuesto_desc = ""; }
if(isset($_POST["num_perfil"])){ $num_perfil = utf8_decode($_POST["num_perfil"]); }else{ $num_perfil = ""; }
if(isset($_POST["perfil"])){ $perfil = utf8_decode($_POST["perfil"]); }else{ $perfil = ""; }
if(isset($_POST["perfil_desc"])){ $perfil_desc = utf8_decode($_POST["perfil_desc"]); }else{ $perfil_desc = ""; }
if(isset($_POST["ei"])){ $ei = utf8_decode($_POST["ei"]); }else{ $ei = ""; }
if(isset($_POST["ai"])){ $ai = utf8_decode($_POST["ai"]); }else{ $ai = ""; }
if(isset($_POST["ad"])){ $ad = utf8_decode($_POST["ad"]); }else{ $ad = ""; }
if(isset($_POST["ed"])){ $ed = utf8_decode($_POST["ed"]); }else{ $ed = ""; }
if(isset($_POST["joven_ei"])){ $joven_ei = utf8_decode($_POST["joven_ei"]); }else{ $joven_ei = ""; }
if(isset($_POST["joven_ai"])){ $joven_ai = utf8_decode($_POST["joven_ai"]); }else{ $joven_ai = ""; }
if(isset($_POST["joven_ad"])){ $joven_ad = utf8_decode($_POST["joven_ad"]); }else{ $joven_ad = ""; }
if(isset($_POST["joven_ed"])){ $joven_ed = utf8_decode($_POST["joven_ed"]); }else{ $joven_ed = ""; }
if(isset($_POST["libre_ei"])){ $libre_ei = utf8_decode($_POST["libre_ei"]); }else{ $libre_ei = ""; }
if(isset($_POST["libre_ai"])){ $libre_ai = utf8_decode($_POST["libre_ai"]); }else{ $libre_ai = ""; }
if(isset($_POST["libre_ad"])){ $libre_ad = utf8_decode($_POST["libre_ad"]); }else{ $libre_ad = ""; }
if(isset($_POST["libre_ed"])){ $libre_ed = utf8_decode($_POST["libre_ed"]); }else{ $libre_ed = ""; }
if(isset($_POST["laboral_ei"])){ $laboral_ei = utf8_decode($_POST["laboral_ei"]); }else{ $laboral_ei = ""; }
if(isset($_POST["laboral_ai"])){ $laboral_ai = utf8_decode($_POST["laboral_ai"]); }else{ $laboral_ai = ""; }
if(isset($_POST["laboral_ad"])){ $laboral_ad = utf8_decode($_POST["laboral_ad"]); }else{ $laboral_ad = ""; }
if(isset($_POST["laboral_ed"])){ $laboral_ed = utf8_decode($_POST["laboral_ed"]); }else{ $laboral_ed = ""; }
if(isset($_POST["auto_ei"])){ $auto_ei = utf8_decode($_POST["auto_ei"]); }else{ $auto_ei = ""; }
if(isset($_POST["auto_ai"])){ $auto_ai = utf8_decode($_POST["auto_ai"]); }else{ $auto_ai = ""; }
if(isset($_POST["auto_ad"])){ $auto_ad = utf8_decode($_POST["auto_ad"]); }else{ $auto_ad = ""; }
if(isset($_POST["auto_ed"])){ $auto_ed = utf8_decode($_POST["auto_ed"]); }else{ $auto_ed = ""; }

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

$dir = "C:/xampp/htdocs/prueba_performance/archivos/";
$pdf->Output($dir.$resp_docu.".pdf",'F');

?>
