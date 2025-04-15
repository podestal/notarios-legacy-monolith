<?php
ob_start();
 
 $fechade = $_POST['fechade'];
$fecha=explode("/",$fechade);
$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];

$fechaa  = $_POST['fechaa'];
$fecha2=explode("/",$fechaa);
$hasta=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];

$tipokar = $_GETS['tipokar'];
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

    <page_footer>
        <table align="center" class="page_footer">
            <tr>
                <td style="width: 100%; text-align: right">
                    Pagina :  [[page_cu]]/[[page_nb]]
                </td>
            </tr>
        </table>
    </page_footer>
    
    <?php include('IMPRE_crono_escri.PHP'); ?>
    
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
