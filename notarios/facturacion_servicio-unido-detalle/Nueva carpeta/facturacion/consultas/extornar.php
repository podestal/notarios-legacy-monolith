
	<?php
    
    include("../../extraprotocolares/view/funciones.php");
        
    $conexion = Conectar();
    
    $a_tipodocu = $_REQUEST['a_t'];
    $a_serie = $_REQUEST['a_s'];
    $a_doic = $_REQUEST['a_d'];

    $id_ctaventas = $_REQUEST['id'];

    $sql_imp_a = "select importe from m_cteventas where id_ctaventas=$id_ctaventas";

    $exe_imp_a = mysql_query($sql_imp_a, $conexion);

    $row_importe = mysql_fetch_array($exe_imp_a);
    
    $importe = $row_importe[0];

    echo $sql_up_c = "update m_cteventas set saldo=saldo+$importe where tipo_docu=$a_tipodocu and serie=$a_serie and documento=$a_doic and tipo_movi='C'";

    $exe_up_c = mysql_query($sql_up_c, $conexion);    

    $sql_delete_a = "delete from m_cteventas where id_ctaventas=$id_ctaventas";

    $exe_delete_a = mysql_query($sql_delete_a, $conexion);

    
    ?>