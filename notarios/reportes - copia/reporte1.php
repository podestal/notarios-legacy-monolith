<?php
/*
 * Commentarios   : Reporte 1
 * Fecha Creacion : 
 * Creado por     :
 * Actualización  :
 * Observación    : 
*/
//ob_start(); // Inicia la sesion
//require_once("../../includes/library/validSession.php");
//require_once("C:/inetpub/wwwroot/notarios/includes/fpdf.php");

include("../includes/fpdf.php");
include("../includes/font/courier.php");
include("../includes/font/helvetica.php");
include("../includes/font/times.php");
include("../conexion.php");


$fpdf = new FPDF();

//$tiprepor = $_POST["tiprepor"];
//$nomrepor = $_POST["nomrepor"];

$tiprepor = "INDICE CRONOLOGICO";
$nomrepor = "ESCRITURAS PUBLICAS";

$title1 = "INDICE CRONOLOGICO ESCRITURAS PUBLICAS"; 

$fecini = $_REQUEST["fecini"];
$fecfin = $_REQUEST["fecfin"];
$fecactual = "23/01/2013";

class PDF extends FPDF{
function Header(){
 //$this->Image('images/1.png',10,8,40);
  $this->SetFont('Arial','',8);
  $this->Cell(190,5,'Fecha: 17/01/2013',0,0,'R');
  $this->Ln(1);
  $this->Cell(80);//Movernos a la derecha
  $this->SetFont('Arial','B',10);
  $this->Cell(30,10,'INDICE CRONOLOGICO DE ESCRITURAS PUBLICAS',0,0,'C');// Titulo de acuerdo a los parametros
  $this->Cell(1,20,'Listado del'.$fecini.' al '.$fecfin,0,0,'R');// Titulo de acuerdo a los parametros

  $this->Ln(17);
  }
  function Footer(){
  $this->SetY(-15);//Posición: a 1,5 cm del final
  $this->SetFont('times','I',8);
  $this->Cell(0,11,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');//Número de página
  }

  function mysql_tabla($cabecera,$anchos,$data,$alineaciones){
    $altura=7;
    #cabecera
    for($u=0;$u<count($cabecera);$u++){
          $this->Cell($anchos[$u],$altura,$cabecera[$u],1,0,'C');
    }
    $this->ln();

    #data
    for($u=0;$u<count($data);$u++){
          $this->Cell($anchos[0],$altura,$data[$u][0],0,0,$alineaciones[0]);
          $this->Cell($anchos[1],$altura,$data[$u][1],0,0,$alineaciones[1]);
          $this->Cell($anchos[2],$altura,$data[$u][2],0,0,$alineaciones[2]);
		  $this->Cell($anchos[3],$altura,$data[$u][3],0,0,$alineaciones[3]);
		  $this->Cell($anchos[4],$altura,$data[$u][4],0,0,$alineaciones[4]);
		  $this->Cell($anchos[5],$altura,$data[$u][5],0,0,$alineaciones[5]);
		  $this->Cell($anchos[6],$altura,$data[$u][6],0,0,$alineaciones[6]);
          $this->ln();
    }
  }  
}
#==================================

$sql="SELECT DATE_FORMAT(kardex.fechaescritura,'%d/%m/%Y') AS fec_escritura, kardex.kardex,
UPPER((CASE WHEN (cliente2.tipper='N') THEN CONCAT(cliente2.apepat,' ',cliente2.apemat,' ',cliente2.prinom,' ',cliente2.segnom) ELSE cliente2.razonsocial END)) AS 'cliente',
kardex.contrato, kardex.numescritura, kardex.numminuta, kardex.folioini
FROM kardex
INNER JOIN contratantes ON contratantes.kardex = kardex.kardex AND contratantes.indice='1'
INNER  JOIN cliente2 ON cliente2.idcontratante = contratantes.idcontratante 
WHERE kardex.idtipkar='1'  
AND kardex.fechaescritura >= STR_TO_DATE('".$fecini."','%d/%m/%Y')
AND kardex.fechaescritura <= STR_TO_DATE('".$fecfin."','%d/%m/%Y')
ORDER BY kardex.fechaescritura, cliente2.idcontratante ASC";

$rpta = mysql_query($sql,$conn) or die(mysql_error());

	while($fila=mysql_fetch_row($rpta)){
	$data[]=$fila;    
}

$cabecera=array('Fecha Escr.','Kardex','Contratantes','Acto','N.Escritura','N.Minuta','N.Folio');
$anchos=array(15,11,50,70,15,15,15);
$alineaciones=array('L','L','L','L','L','L','L');

#===================================


$pdf=new PDF;
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',7);
$pdf->mysql_tabla($cabecera,$anchos,$data,$alineaciones);
$pdf->Output();


?>
