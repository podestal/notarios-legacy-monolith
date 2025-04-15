<?php
ob_start();
$fechade = $_REQUEST['fecini'];
$fechaa = $_REQUEST['fecfin'];

?>
<style type="text/css">
.dsd {
	font-size: 12px;
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
          <strong>INDICE CRONOLOGICO DE LIBROS</strong></p>
 <p align="center"><strong>Listado del <?php echo $fechade ?> al <?php echo $fechaa ?></strong></p>
                    
  <TABLE width="1000" bordercolor="#333333"  BORDER=1 align="center" CELLPADDING=0 CELLSPACING=0>
            
       <TR class="dsd">
         <td width="80" align="center">Cronologico</td>
              <td width="76" align="center">Fecha </td>
              <td width="254" align="center">Empresa / Cliente</td>
              <td width="199" align="center">Objeto</td>
              <td width="107" align="center">Nro de Libro</td>
              <td width="76" align="center">Nro de Folio</td>
              <td width="99" align="center">Tipo de Folio</td>
              <td width="91" align="center">DNI / RUC</td></TR>
</TABLE>
  <?php     include('IMPRElibro.PHP');  ?>
<?php 
$content_html = ob_get_clean();
require_once('html2pdf/html2pdf.class.php'); 
try
{
$html2pdf = new HTML2PDF('l','A4','es', false, 'ISO-8859-15', array(0, 0, 0, 0));
$html2pdf->writeHTML($content_html, isset($_GET['vuehtml']));
$html2pdf->Output('imprelibro.pdf');
}
catch(HTML2PDF_exception $e) { echo $e; }
$contenido_extra=file_get_contents();
?>
                    