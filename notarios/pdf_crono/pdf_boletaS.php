<?php
ob_start();
$id_regventas  = $_REQUEST['id_regventas'];
?>
<page format="150x80" style="font-size: 6pt; font:Verdana;">    
    <?php 
	//include('IMPRE_boleta.PHP'); 
	?>  
    <table width="589" height="240" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="65" height="19">&nbsp;</td>
    <td width="348">&nbsp;</td>
    <td width="83">&nbsp;</td>
    <td width="93">&nbsp;</td>
  </tr>
  <tr>
    <td height="45" colspan="4"><table width="584" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="65">&nbsp;</td>
        <td width="185">Jesus castro</td>
        <td width="89">&nbsp;</td>
        <td width="245">lima 25 diciembre del 2014</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>41345805</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="32">cant</td>
    <td>descripcion</td>
    <td>unitario</td>
    <td>importe</td>
  </tr>
  
  <tr>
    <td height="121" colspan="4" valign="top">
    <table width="589" height="28" border="0" cellpadding="0" cellspacing="0">
     <tr>
    <td width="66" height="28">1</td>
    <td width="346">pruebaaaaa</td>
    <td width="84">10.00</td>
    <td width="93">10.00</td>
  </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td height="23">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>25.00</td>
  </tr>
</table>
</page>

<?php 

$content_html = ob_get_clean();
require_once('../html2pdf/html2pdf.class.php'); 
	try
	{
		$html2pdf = new HTML2PDF('l','150x80','es', true, 'UTF-8', array(0, 0, 0, 0));
		$html2pdf->writeHTML($content_html, isset($_GET['vuehtml']));
		$html2pdf->Output('Pend_firma.pdf');
		
	}catch(HTML2PDF_exception $e) 
		{ 
			echo $e; 
		}
		
	$contenido_extra=file_get_contents();

?> 
