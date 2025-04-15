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
                         <strong>INDICE CRONOLOGICO DE PERMISOS DE VIAJE</strong></p>
                    <p align="center"><strong>Listado del <?php echo $fechade ?> al <?php echo $fechaa ?></strong></p>
                    
                    
                    <TABLE  BORDER=1 CELLSPACING=0 CELLPADDING=0 align="center">
       		  <TR>
                <TD width="37" height="19">Nro Control</td>
                <TD width="80">Cronologico</td>
                <TD width="400">Participantes</td>
                <TD width="86">Fecha Crono.</td>
                <TD width="150">Tip.Permiso</td>
                <TD width="86">Fec. Ingreso</td>
                <td width="86">Estado</td>
              </TR>
       
       
</TABLE>
		
        
<?php     include('IMPREviaje.PHP');  ?>
       
<?php
 

$content_html = ob_get_clean();
require_once('html2pdf/html2pdf.class.php'); 
try
{
	$html2pdf = new HTML2PDF('l','A4','es', false, 'ISO-8859-15', array(0, 0, 0, 0));
	$html2pdf->writeHTML($content_html, isset($_GET['vuehtml']));
	$html2pdf->Output('icronoPViaje.pdf');
}
catch(HTML2PDF_exception $e) { echo $e; }
$contenido_extra=file_get_contents();
?>