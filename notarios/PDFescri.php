<?php
ob_start();
$fechade = $_REQUEST['fecini'];
$fechaa  = $_REQUEST['fecfin'];;
$nomnotaria = " ";

?>
<style type="text/css">
.titulocromoescri {
	
	font-size: 12px;
}
.titulocromoescri td {
	font-weight: bold;
}
</style>

<?php 
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
                    <strong>INDICE CRONOLOGICO DE ESCRITURAS PUBLICAS asdfdsf</strong></p>
                    <p align="center">
                      
                      <strong>Listado del <?php echo $fechade ?> al <?php echo $fechaa ?></strong></p>
                    
        <table width="850" bordercolor="#333333"  BORDER=1 align="center" CELLPADDING=0 CELLSPACING=0>
                    <TR class="titulocromoescri">
                <TD width="77" height="37" align="center">Fecha<br /> 
                Instrumento</td>
                <TD width="70" align="center">Kardex</td>
                <TD width="280" align="center">Contratantes</td>
                <TD width="224" align="center">Acto</td>
                <TD width="79" align="center">Instrumento</td>
                <TD width="53" align="center">Minuta</td>
                <TD width="51" align="center">Folio</td>
              </TR>
                    </table>
		
        
<?php     include('SALON12.PHP');  ?>
        
<?php


//aqui pones el nombre del archivo que quieres convertir
$content_html = ob_get_clean();
// initialization  HTML2PDF
//Ruta de la clase
require_once('html2pdf/html2pdf.class.php');  // la ruta de la libreria, en este caso yo la tengo en wamp/www y dentro de www hice una carpeta que se llama html2pdf y pegue todo , y asi maneje la instruccion de ruta..... tal y como esta con los puntos
try
	{
		///configurar tipo de hora, formato, etc...
		$html2pdf = new HTML2PDF('l','A4','es', false, 'ISO-8859-15', array(0, 0, 0, 0));
		//$html2pdf = new HTML2PDF();
		$html2pdf->writeHTML($content_html, isset($_GET['vuehtml']));
		//$html2pdf->createIndex('', 25, 12, false, true, 1);
		 
		///Nombre del archivo pdf      
		$html2pdf->Output('icronoEEPP.pdf');
	}
//para que lo descargue 
 
catch(HTML2PDF_exception $e) { echo $e; }
$contenido_extra=file_get_contents();
?>