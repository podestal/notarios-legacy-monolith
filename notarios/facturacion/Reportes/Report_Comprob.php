<?php
 /*
 * Commentarios   : Reporte de Comprobantes Emitidos.
 * Fecha Creacion : 
 * Creado por     :
 * Actualización  :
 * Observación    : 
*/
//ob_start(); // Inicia la sesion
//require_once("../../includes/library/validSession.php");
//require_once("C:/inetpub/wwwroot/notarios/includes/fpdf.php");

include("../../includes/fpdf.php");
include("../../includes/font/courier.php");
include("../../includes/font/helvetica.php");
include("../../includes/font/times.php");
include("../../conexion.php");

$fpdf = new FPDF();

//$tiprepor = $_POST["tiprepor"];
//$nomrepor = $_POST["nomrepor"];

$tiprepor = "COMPROBANTES EMITIDOS";
$nomrepor = "COMPROBANTES EMITIDOS";

$title1 = "COMPROBANTES EMITIDOS"; 

$fecini = $_REQUEST["fecini"];
$fecfin = $_REQUEST["fecfin"];
$fecactual = "23/01/2013";

class PDF extends FPDF{
function Header(){
 //$this->Image('images/1.png',10,8,40);
  $this->SetFont('Arial','',8);
  //$this->Cell(190,5,'Fecha: 17/01/2013',0,0,'R');
  $this->Ln(1);
  $this->Cell(80);//Movernos a la derecha
  $this->SetFont('Arial','B',10);
  $this->Cell(30,10,'COMPROBANTES EMITIDOS',0,0,'C');// Titulo de acuerdo a los parametros
  //$this->Cell(1,20,'Listado del'.$fecini.' al '.$fecfin,0,0,'R');// Titulo de acuerdo a los parametros

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
		  $this->Cell($anchos[7],$altura,$data[$u][7],0,0,$alineaciones[7]);
		  $this->Cell($anchos[8],$altura,$data[$u][8],0,0,$alineaciones[8]);

          $this->ln();
    }
  }  
}
#==================================

$sql="SELECT DATE_FORMAT(m_cteventas.fecha,'%d/%m/%Y') AS 'Fec.Emision', (CASE WHEN ISNULL(m_regpagos.fec_pago) THEN 'NO PAGADO' ELSE DATE_FORMAT(m_regpagos.fec_pago,'%d/%m/%Y') END) AS 'Fec.Pago', tip_documen.des_docum AS 'Tipo', m_cteventas.serie AS 'Serie',
m_cteventas.documento AS 'N.Documen.', (CASE WHEN (cliente.tipper='N') THEN cliente.nombre ELSE cliente.razonsocial END) AS 'Cliente',
m_regventas.subtotal AS 'Base Imp.', m_regventas.impuesto AS 'I.G.V.', m_regventas.imp_total AS 'Imp. Total'
FROM m_cteventas
LEFT OUTER JOIN m_regpagos ON m_cteventas.tipo_docu = m_regpagos.tipo_docu  AND m_cteventas.serie = m_regpagos.serie AND m_cteventas.documento = m_regpagos.numero
INNER JOIN m_regventas ON m_cteventas.tipo_docu = m_regventas.tipo_docu  AND m_cteventas.serie = m_regventas.serie  AND m_cteventas.documento = m_regventas.factura
INNER JOIN cliente ON cliente.numdoc = m_cteventas.num_docu_cli
INNER JOIN tip_documen ON m_cteventas.tipo_docu = tip_documen.id_documen
WHERE m_cteventas.fecha >= STR_TO_DATE('".$fecini."','%d/%m/%Y') AND m_cteventas.fecha <= STR_TO_DATE('".$fecfin."','%d/%m/%Y')
ORDER BY m_cteventas.fecha ASC";

$rpta = mysql_query($sql,$conn) or die(mysql_error());

	while($fila=mysql_fetch_row($rpta)){
	$data[]=$fila;    
}

/*
Fec.Emision
Fec.Pago
Tipo
Serie
N.Documen.
Cliente
Base Imp.
I.G.V.
Imp.Total
*/

$cabecera=array('Fec.Emision','Fec.Pago','Tipo','Serie','N.Documen.','Cliente','Base Imp.','I.G.V.','Imp.Total');
$anchos=array(15,11,50,70,15,15,15,15,15);
$alineaciones=array('L','L','L','L','L','L','L'.'L','L');

#===================================


$pdf=new PDF;
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',7);
$pdf->mysql_tabla($cabecera,$anchos,$data,$alineaciones);
$pdf->Output();


?>
