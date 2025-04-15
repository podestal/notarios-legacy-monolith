<?php
ob_start();
$fechade = $_REQUEST['fecini'];
$fechaa  = $_REQUEST['fecfin'];
//$nomnotaria = "Nombre de la Notaria";
$nomnotaria = " ";
//$fechade = '01/01/2013';
//$fechaa = '31/01/2013';
$nocorre = $_REQUEST['nocorre'];
?>
<page backtop="40mm" backbottom="7mm" backleft="10mm" backright="10mm">
  <page_header>
                       
                <p align="center">
                     <strong>INDICE CRONOLOGICO DE CARTAS</strong></p>
                <p align="center"><strong>Listado del <?php echo $fechade ?> al <?php echo $fechaa ?></strong></p>
                 <TABLE width="850" bordercolor="#333333"  BORDER=1 align="center" CELLPADDING=0 CELLSPACING=0>    
               <TR class="crono_cartas">
               <TD width="74" height="19" align="center">Numero</TD>
               <TD width="73" align="center">Fecha <br /> Ingreso</TD>
               <TD width="85" align="center">Fecha<br /> Diligencia</TD>
               <TD width="125" align="center">Zona</TD>
               <TD width="182" align="center">&nbsp; Remitente</TD>
               <TD width="297" align="center">&nbsp; Destinatario</TD>
               </TR>
        </TABLE>
	</page_header>

<?php     include('IMPREcarta.PHP');     ?>
</page>        

<?php
$content_html = ob_get_clean();
require_once('html2pdf/html2pdf.class.php'); 
try
{
	$html2pdf = new HTML2PDF('l','A4','es', false, 'ISO-8859-15', array(0, 0, 0, 0));
	$html2pdf->writeHTML($content_html, isset($_GET['vuehtml']));
	$html2pdf->Output('icronoCarta.pdf');
}
catch(HTML2PDF_exception $e) { echo $e; }
$contenido_extra=file_get_contents();
?>