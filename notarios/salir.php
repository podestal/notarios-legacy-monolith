<?php 
  session_start();
  unset($_SESSION["apepat_usu"]); 
  unset($_SESSION["apemat_usu"]); 
  unset($_SESSION["nom1_usu"]); 
  unset($_SESSION["nom2_usu"]); 
  unset($_SESSION["id_usu"]); 
      
  session_destroy(); 
  ?>
		<script type="text/javascript">window.location="index.php"; </script> 
<?php   
  exit;  ?>

