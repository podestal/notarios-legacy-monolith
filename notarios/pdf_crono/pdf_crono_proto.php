<?php
ob_start();
 
 $fechade = $_GET['fechade'];
$fecha=explode("/",$fechade);
$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];

$fechaa  = $_GET['fechaa'];
$fecha2=explode("/",$fechaa);
$hasta=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];

$tipokar = $_GETS['tipokar'];

$fec_cons = $_REQUEST['fec_cons'];
$fec_not = $_REQUEST['fec_not'];
$fec_ing = $_REQUEST['fec_ing'];
?>
<style type="text/css">
<!--
    
   .titulos
    { 
	  font-size:10px;
	  color:#FFF
    }
.Estilo12{
	
	  font-size:9px;
	  color:#333;
	}
-->
</style>
<page backtop="30mm" backbottom="14mm" backleft="10mm" backright="10mm" style="font-size: 10pt; font:Arial;">
    <page_header>
        <p align="center">
     <strong>REPORTE DE INDICES CRONOLOGICOS DE PROTESTOS</strong></p>
<p align="center"><strong>Listado del <?php echo $fechade; ?> al <?php echo $fechaa; ?></strong></p>

<table width='870' border='1' align="center" cellpadding='0' cellspacing='0' bordercolor='#000000'>
		 <tr class="titulos">
			<td width='48' bgcolor='#003366' align='center'><span class='Estilo14'>No Tit. Valor</span></td>
			<td width='64' bgcolor='#003366' align='center'><span class='Estilo14'>No. Acta</span></td>
			<td width='51' bgcolor='#003366' align='center'><span class='Estilo14'>Fec. Ingreso</span></td>
			<td width='69' bgcolor='#003366' align='center'><span class='Estilo14'>Fec, Notific.</span></td>
			<td width='172' bgcolor='#003366' align='center'><span class='Estilo14'>Solicitante</span></td>
			<td width='203' bgcolor='#003366' align='center'><span class='Estilo14'>Participantes</span></td>
			<td width='89' bgcolor='#003366' align='center'><span class='Estilo14'>Fec. Constancia</span></td>
			<td width='83' bgcolor='#003366' align='center'><span class='Estilo14'>Tipo Moneda</span></td>
			<td width='71' bgcolor='#003366' align='center'><span class='Estilo14'>Importe</span></td>
         </tr></TABLE>
    </page_header>
    <page_footer>
        <table align="center" class="page_footer">
            <tr>
                <td style="width: 100%; text-align: right">
                    Pagina :  [[page_cu]]/[[page_nb]]
                </td>
            </tr>
        </table>
    </page_footer>
    
    <?php include('IMPRE_crono_proto.PHP'); ?>
    
</page>

  


<?php 

$content_html = ob_get_clean();
require_once('../html2pdf/html2pdf.class.php'); 
	try
	{
		$html2pdf = new HTML2PDF('l','A4','es', true, 'UTF-8', array(0, 0, 0, 0));
		$html2pdf->writeHTML($content_html, isset($_GET['vuehtml']));
		$html2pdf->Output('Pend_firma.pdf');
		
	}catch(HTML2PDF_exception $e) 
		{ 
			echo $e; 
		}
		
	$contenido_extra=file_get_contents();

?> 
