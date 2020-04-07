<?php
header('Content-Type: application/pdf');

require('fpdf/fpdf.php');

$actual_link = dirname((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")."/";

$resp_nombres = utf8_decode("Nathalia Barrios Barrera");
$resp_docu = utf8_decode("C.C. 52898176");
$resp_fech_prueba = utf8_decode("2017-12-11");
$resp_prestador = utf8_decode("SPE Coordinación Diseño");
$num_perfil = utf8_decode("07");
$desc_perfil = utf8_decode("Este perfil de competencia se caracteriza por: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.");
$perfil = utf8_decode("Práctico (AI-AD)");
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

$titulo_01 = utf8_decode("Estilos de pensamiento - Neuro fortaleza y Neuro debilidad");
$titulo_02 = utf8_decode("Perfil de competencia");
$titulo_03 = utf8_decode("Competencias desarrolladas");

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

}

// Cuerpo
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('helvetica','B',10);
$pdf->Cell(0,30,$resp_nombres,0,1);
$pdf->SetFont('helvetica','',10);
$pdf->Cell(0,-18,$resp_docu,0,1);
$pdf->Cell(0,35,"Fecha de la prueba: ".$resp_fech_prueba,0,1);
$pdf->Cell(0,-23,"Prestador: ".$resp_prestador,0,1);

$pdf->SetFont('helvetica','',13);
$pdf->SetTextColor(33,37,41);
$pdf->Cell(0,55,$titulo_01,0,1);

//Imagen cerebro
$pdf->Image('images/cerebro_solo.png',80,95,50);

$pdf->SetFont('helvetica','B',12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(79,-23,utf8_decode("Analítico"),0,1,'C',false);
$pdf->SetFont('helvetica','B',8);
$pdf->Cell(71,32,utf8_decode("Lógico"),0,1,'C',false);
$pdf->Cell(74,-23,utf8_decode("Analítico"),0,1,'C',false);
$pdf->Cell(80,32,utf8_decode("Confrontador"),0,1,'C',false);
$pdf->Cell(89,-23,utf8_decode("Toma de Decisiones"),0,1,'C',false);
$pdf->Cell(92.5,32,utf8_decode("Orientado a resultados"),0,1,'C',false);

$pdf->SetFont('helvetica','B',12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(79,-4,utf8_decode("Eficiente"),0,1,'C',false);
$pdf->SetFont('helvetica','B',8);
$pdf->Cell(75,13,utf8_decode("Ordenado"),0,1,'C',false);
$pdf->Cell(81,-4,utf8_decode("Procedimental"),0,1,'C',false);
$pdf->Cell(76,13,utf8_decode("Productivo"),0,1,'C',false);
$pdf->Cell(75,-4,utf8_decode("Cauteloso"),0,1,'C',false);
$pdf->Cell(73,13,utf8_decode("Eficiente"),0,1,'C',false);

$pdf->SetFont('helvetica','B',12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(279,-130,utf8_decode("Creativo"),0,1,'C',false);
$pdf->SetFont('helvetica','B',8);
$pdf->Cell(277,139,utf8_decode("Visionario"),0,1,'C',false);
$pdf->Cell(277,-130,utf8_decode("Innovador"),0,1,'C',false);
$pdf->Cell(277.5,139,utf8_decode("Metafórico"),0,1,'C',false);
$pdf->Cell(282.5,-130,utf8_decode("Toma Riesgos"),0,1,'C',false);

$pdf->SetFont('helvetica','B',12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(282,166,utf8_decode("Empático"),0,1,'C',false);
$pdf->SetFont('helvetica','B',8);
$pdf->Cell(294,-157,utf8_decode("Sentido de Pertenencia"),0,1,'C',false);
$pdf->Cell(281,166,utf8_decode("Armonizador"),0,1,'C',false);
$pdf->Cell(279,-157,utf8_decode("Conciliador"),0,1,'C',false);
$pdf->Cell(276,166,utf8_decode("Sensitivo"),0,1,'C',false);
$pdf->Cell(276.5,-157,utf8_decode("Empático"),0,1,'C',false);

$pdf->SetFont('helvetica','',13);
$pdf->SetTextColor(33,37,41);
$pdf->Cell(0,190,$titulo_02,0,1);

$pdf->Image("images/perfil_$num_perfil.png",40,190,50);
$pdf->SetFont('helvetica','B',10);
$pdf->Cell(210,-157,$perfil,0,1,'C',false);
$pdf->SetFont('helvetica','',10);
$pdf->SetXY(100.5,196);
$pdf->drawTextBox($desc_perfil, 85, 50, '', '', false);

$pdf->AddPage();

$pdf->SetFont('helvetica','',13);
$pdf->SetTextColor(33,37,41);
$pdf->Cell(0,30,$titulo_03,0,1);

/*Gráfico de barras*/
$img = file_get_contents($actual_link."respuesta_graf_barras.php?ei=$ei&ai=$ai&ad=$ad&ed=$ed");
$pic = 'data://text/plain;base64,' . base64_encode($img);
$pdf->Image($pic, 40, 55, 135, 72, 'jpg');

/*Tabla de competencias*/
$pdf->Ln(80);
$pdf->SetFillColor(193,229,252); // Background color
$pdf->SetFont('helvetica','B',9);
$pdf->SetTextColor(12,84,96);
$pdf->SetXY(40,130);
$pdf->Cell(26,10,utf8_decode("Competencias"),0,1,'C',true);
$pdf->SetXY(66,130);
$pdf->Cell(26,10,utf8_decode("Analítico EI"),0,1,'C',true);
$pdf->SetXY(92,130);
$pdf->Cell(26,10,utf8_decode("Eficiente AI"),0,1,'C',true);
$pdf->SetXY(118,130);
$pdf->Cell(26,10,utf8_decode("Empático AD"),0,1,'C',true);
$pdf->SetXY(144,130);
$pdf->Cell(25,10,utf8_decode("Creativo ED"),0,1,'C',true);

$pdf->SetFillColor(242,242,242); // Background color
$pdf->SetFont('helvetica','',9);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(40,140);
$pdf->Cell(26,10,utf8_decode("Joven"),0,1,'C',true);
$pdf->SetXY(66,140);
$pdf->Cell(26,10,utf8_decode($joven_ei),0,1,'C',true);
$pdf->SetXY(92,140);
$pdf->Cell(26,10,utf8_decode($joven_ai),0,1,'C',true);
$pdf->SetXY(118,140);        
$pdf->Cell(26,10,utf8_decode($joven_ad),0,1,'C',true);
$pdf->SetXY(144,140);        
$pdf->Cell(25,10,utf8_decode($joven_ed),0,1,'C',true);

$pdf->SetFillColor(255,255,255); // Background color
$pdf->SetFont('helvetica','',9);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(40,150);
$pdf->Cell(26,10,utf8_decode("Adulto"),0,1,'C',true);
$pdf->SetXY(66,150);
$pdf->Cell(26,10,utf8_decode($ei),0,1,'C',true);
$pdf->SetXY(92,150);
$pdf->Cell(26,10,utf8_decode($ai),0,1,'C',true);
$pdf->SetXY(118,150);
$pdf->Cell(26,10,utf8_decode($ad),0,1,'C',true);
$pdf->SetXY(144,150);
$pdf->Cell(25,10,utf8_decode($ed),0,1,'C',true);

$pdf->SetFillColor(242,242,242); // Background color
$pdf->SetFont('helvetica','',9);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(40,160);
$pdf->Cell(26,10,utf8_decode("Tiempo Libre"),0,1,'C',true);
$pdf->SetXY(66,160);
$pdf->Cell(26,10,utf8_decode($libre_ei),0,1,'C',true);
$pdf->SetXY(92,160);        
$pdf->Cell(26,10,utf8_decode($libre_ai),0,1,'C',true);
$pdf->SetXY(118,160);       
$pdf->Cell(26,10,utf8_decode($libre_ad),0,1,'C',true);
$pdf->SetXY(144,160);       
$pdf->Cell(25,10,utf8_decode($libre_ed),0,1,'C',true);

$pdf->SetFillColor(255,255,255); // Background color
$pdf->SetFont('helvetica','',9);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(40,170);
$pdf->Cell(26,10,utf8_decode("Laboral"),0,1,'C',true);
$pdf->SetXY(66,170);
$pdf->Cell(26,10,utf8_decode($laboral_ei),0,1,'C',true);
$pdf->SetXY(92,170);        
$pdf->Cell(26,10,utf8_decode($laboral_ai),0,1,'C',true);
$pdf->SetXY(118,170);       
$pdf->Cell(26,10,utf8_decode($laboral_ad),0,1,'C',true);
$pdf->SetXY(144,170);       
$pdf->Cell(25,10,utf8_decode($laboral_ed),0,1,'C',true);

$pdf->SetFillColor(242,242,242); // Background color
$pdf->SetFont('helvetica','',9);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(40,180);
$pdf->Cell(26,10,utf8_decode("Autopercepción"),0,1,'C',true);
$pdf->SetXY(66,180);
$pdf->Cell(26,10,utf8_decode($auto_ei),0,1,'C',true);
$pdf->SetXY(92,180);        
$pdf->Cell(26,10,utf8_decode($auto_ai),0,1,'C',true);
$pdf->SetXY(118,180);       
$pdf->Cell(26,10,utf8_decode($auto_ad),0,1,'C',true);
$pdf->SetXY(144,180);       
$pdf->Cell(25,10,utf8_decode($auto_ed),0,1,'C',true);


$pdf->Output();
?>
