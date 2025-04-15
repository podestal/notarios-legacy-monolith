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
     <strong>REPORTE DE CONTRATOS PENDIENTES DE CONCLUSION DE FIRMAS</strong></p>
<p align="center"><strong>Listado del <?php echo $fechade ?> al <?php echo $fechaa ?></strong></p>

<TABLE  BORDER=1 bordercolor="#000000" CELLSPACING=0 CELLPADDING=0 align="center" bgcolor="#003366">
            
       <!--<TR><TD width="70" height="19">Numero</TD><TD width="86">Fec. Ingr.</TD><TD width="86">Fec. Dilig.</TD><TD width="93">Zona</TD><TD width="171">&nbsp; Remitente</TD><TD width="275">&nbsp; Destinatario</TD></TR>-->
       
       		  <TR>
                <TD width="100" height="19" align='CENTER' class="titulos">Tipo</td>
                <TD width="50" align='CENTER' class="titulos">Kardex</td>
                <TD width="70" align='CENTER' class="titulos">Fec.Escri.</td>
                <TD width="93" align='CENTER' class="titulos">N°.Escri/ Acta</td>
                <TD width="171" align='CENTER' class="titulos">Contrato</td>
                <TD width="275" align='CENTER' class="titulos">Contratantes</td>
              </TR>
       
       
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
    
    <?php include('IMPRE_pendfirma.PHP'); ?>
    
</page>

  


<?php 

$content_html = ob_get_clean();
require_once('../html2pdf/html2pdf.class.php'); 
	try
	{
		$html2pdf = new HTML2PDF('l','A4','es', false, 'ISO-8859-15', array(0, 0, 0, 0));
		$html2pdf->writeHTML($content_html, isset($_GET['vuehtml']));
		$html2pdf->Output('Pend_firma.pdf');
		
	}catch(HTML2PDF_exception $e) 
		{ 
			echo $e; 
		}
		
	$contenido_extra=file_get_contents();

?>