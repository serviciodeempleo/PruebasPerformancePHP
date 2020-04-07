<?php
header('Content-type: image/jpeg');

require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');
require_once ('jpgraph/jpgraph_plotline.php');

if(isset($_REQUEST["ei"])){ $ei = $_REQUEST["ei"]; }else{ $ei = 10; }
if(isset($_REQUEST["ai"])){ $ai = $_REQUEST["ai"]; }else{ $ai = 20; }
if(isset($_REQUEST["ad"])){ $ad = $_REQUEST["ad"]; }else{ $ad = 30; }
if(isset($_REQUEST["ed"])){ $ed = $_REQUEST["ed"]; }else{ $ed = 40; }

$datay=array($ei,$ai,$ad,$ed);
$barcolors = array("dodgerblue3","limegreen","brown3","gold");
 
// Size of graph
$width=600;
$height=320;
 
// Set the basic parameters of the graph
$graph = new Graph($width,$height);
$graph->img->SetImgFormat('jpeg');
$graph->SetScale('textlin',0,120);
$graph->yscale->ticks->Set(20,1); 
 
$top = 30;
$bottom = 30;
$left = 90;
$right = 30;
$graph->Set90AndMargin($left,$right,$top,$bottom);
 
// Nice shadow
$graph->SetShadow();
 
// Setup labels
$lbl = array("Analítico EI","Eficiente AI","Empático AD","Creativo ED");
$graph->xaxis->SetTickLabels($lbl);
 
// Label align for X-axis
$graph->xaxis->SetLabelAlign('right','center','right');
 
// Label align for Y-axis
$graph->yaxis->SetLabelAlign('center','bottom');

// Plot line
$sline = new PlotLine(HORIZONTAL,80,'dodgerblue1'); 
$graph->Add($sline);

// Create a bar pot
$bplot = new BarPlot($datay); 
$graph->Add($bplot);
$bplot->value->Show();

$bplot->SetFillColor($barcolors);
 
$graph->Stroke();
?>
