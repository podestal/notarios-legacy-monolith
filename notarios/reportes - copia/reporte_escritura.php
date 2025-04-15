 <?php 
      ob_start(); 
 ?> 
 <page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm"> 
      <page_header> 
        </page_header> 
      <page_footer> 
           Page footer
      </page_footer>
 
 </page> 
 <?php 
      $content = ob_get_clean(); 
      require_once('../html2pdf/html2pdf.class.php'); 
      $pdf = new HTML2PDF('l','A4','es', false, 'ISO-8859-15', array(0, 0, 0, 0)); 
      $pdf->WriteHTML($content); 
      $pdf->Output('Pend_firma.pdf'); 
 ?>
 