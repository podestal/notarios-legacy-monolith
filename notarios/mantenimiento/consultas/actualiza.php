<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	
	
	"update m_regpagos 
	 join m_regventas
	 on m_regpagos.tipo_docu=m_regventas.tipo_docu and  m_regpagos.serie=m_regventas.serie and  m_regpagos.numero=m_regventas.factura
	 set  m_regpagos.id_regventas=m_regventas.id_regventas"
				  
     //$res_macto = mysql_query($sql_macto, $conexion);
	
	?>