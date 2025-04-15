<?php
ob_start();
$fechade = $_REQUEST['fecini'];
$fechaa  = $_REQUEST['fecfin'];
//$nomnotaria = "Nombre de la Notaria";
$nomnotaria = " ";
//$fechade = '01/01/2013';
//$fechaa = '31/01/2013';
$nocorre = $_REQUEST['nocorre'];
echo '<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm">
 		<page_footer>		
		<table width="200" border="0" cellspacing="0" align="center"  cellpadding="0">
		  <tr>
			<td height="45">Pagina : [[page_cu]]/[[page_nb]]</td>
		  </tr>
		</table>       
        </page_footer>
		</page>
		';
?>
    
                    <p align="center">
                         <strong>INDICE CRONOLOGICO DE PERSONA INCAPAZ</strong></p>
                    <p align="center"><strong>Listado del <?php echo $fechade ?> al <?php echo $fechaa ?></strong></p>

<TABLE  BORDER=1 CELLSPACING=0 CELLPADDING=0 align="center">
            
       <!--<TR><TD width="70" height="19">Numero</TD><TD width="86">Fec. Ingr.</TD><TD width="86">Fec. Dilig.</TD><TD width="93">Zona</TD><TD width="171">&nbsp; Remitente</TD><TD width="275">&nbsp; Destinatario</TD></TR>-->
       
       		  <TR>
                <TD width="113" height="19">Cronologico</td>
                <TD width="136">Fecha</td>
                <TD width="260">Nombre</td>
                <TD width="196">Direcci&oacute;n</td>
               
              </TR>
       
       
</TABLE>

        
<?php     include('IMPREcertipincapaz.PHP');  ?>
      
<?php 
 
$content_html = ob_get_clean();
require_once('html2pdf/html2pdf.class.php'); 
try
{
	$html2pdf = new HTML2PDF('l','A4','es', false, 'ISO-8859-15', array(0, 0, 0, 0));
	$html2pdf->writeHTML($content_html, isset($_GET['vuehtml']));
	$html2pdf->Output('personaincapaz.pdf');
}
catch(HTML2PDF_exception $e) { echo $e; }
$contenido_extra=file_get_contents();
?>