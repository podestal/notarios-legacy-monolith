<?php
ob_start();
 
$fechade = $_REQUEST['fechade'];
$fechaa  = $_REQUEST['fechaa'];

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
     <strong>REPORTE DE INDICES CRONOLOGICOS CARTAS NOTARIALES</strong></p>
<p align="center"><strong>Listado del <?php echo $fechade ?> al <?php echo $fechaa ?></strong></p>

<table width='834' border='1' align="center" cellpadding='0' cellspacing='0' bordercolor='#000000' bgcolor="#003366">

		<tr height='19' class="titulos">
              <td width='70' height='19' bgcolor="#003366"><span class='Estilo14'>Numero</span></td>
              <td width='86' bgcolor='#003366'><span class='Estilo14'>Fec. Ingr.</span></td>
              <td width='86' bgcolor='#003366'><span class='Estilo14'>Fec. Dilig.</span></td>
              <td width='93' bgcolor='#003366'><span class='Estilo14'>Zona</span></td>
              <td width='171' bgcolor='#003366'><span class='Estilo14'>Remitente</span></td>
              <td width='275' bgcolor='#003366'><span class='Estilo14'>Destinatario</span></td>
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
    
    <?php 
	      include('IMPRE_crono_extracartas.PHP');
		
		?>
    
</page>

  


<?php 

$content_html = ob_get_clean();
require_once('../html2pdf/html2pdf.class.php'); 
	try
	{
		$html2pdf = new HTML2PDF('l','A4','es', true, 'UTF-8', array(0, 0, 0, 0));
		$html2pdf->writeHTML($content_html, isset($_GET['vuehtml']));
		$html2pdf->Output('Cartas_notariales.pdf');
		
	}catch(HTML2PDF_exception $e) 
		{ 
			echo $e; 
		}
		
	$contenido_extra=file_get_contents();

?> 
