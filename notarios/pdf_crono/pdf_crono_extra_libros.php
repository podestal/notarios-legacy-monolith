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
     <strong>REPORTE DE INDICES CRONOLOGICOS DE CERTIFICACION DE LIBROS</strong></p>
<p align="center"><strong>Listado del <?php echo $fechade ?> al <?php echo $fechaa ?></strong></p>

<table width='834' border='1' align="center" cellpadding='0' cellspacing='0' bordercolor='#000000' bgcolor="#003366">

		<tr height='19' bgcolor="#003366">
		  <td width='74' align='center'><span class='titulos'>N° Cronologico</span></td>
		  <td width='81' align='center'><span class='titulos'>Fecha </span></td>
		  <td width='140' align='center'><span class='titulos'>Empresa / Cliente</span></td>
		  <td width='100' align='center'><span class='titulos'>Tipo de Libro</span></td>
		  <td width='91' align='center'><span class='titulos'>N° de Libro</span></td>
		  <td width='68' align='center'><span class='titulos'>N° de Folio</span></td>
		  <td width='91' align='center'><span class='titulos'>Tipo de Folio</span></td>
		  <td width='113' align='center'><span class='titulos'>RUC</span></td>
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
	      include('IMPRE_crono_extralibros.PHP');
		
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
