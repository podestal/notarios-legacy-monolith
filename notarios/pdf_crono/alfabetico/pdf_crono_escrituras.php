<?php
ob_start();
 
 $fechade = $_GET['fechade'];
$fecha=explode("/",$fechade);
$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];

$fechaa  = $_GET['fechaa'];
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
    <page_header>
        <p align="center">
     <strong>REPORTE DE INDICES ALFABETICOS DE ESCRITURAS PUBLICAS</strong></p>
<p align="center"><strong>Listado del <?php echo $fechade ?> al <?php echo $fechaa ?></strong></p>

<table width='834' border='1' align="center" cellpadding='0' cellspacing='0' bordercolor='#000000' bgcolor="#003366">

		<tr class="titulos">
              <td width='273' height='19' align="center"><span class='Estilo14'>Contratantes</span></td>
              <td width='68' align="center"><span class='Estilo14'>Fecha Escr.</span></td>
              <td width='75' align="center"><span class='Estilo14'>Kardex</span></td>
              <td width='262' align="center"><span class='Estilo14'>Acto</span></td>
              <td width='70' align="center"><span class='Estilo14'>Nro. Acta</span></td>
              <td width='72' align="center"><span class='Estilo14'>Nro Folio</span></td>
            </tr>
       
</TABLE>
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
    
    <?php include('IMPRE_crono_escrituras.PHP'); ?>
    
</page>

  


<?php 

$content_html = ob_get_clean();
require_once('../../html2pdf/html2pdf.class.php'); 
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
