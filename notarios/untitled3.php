<?php
 /**
* @author ZEGARRA CORNE, Sergio
* @Instituto IDAT
*/ 
 $Archivo_q_se_crea = fopen("puerto en el cual se desea imprimir", "w");
$dato = "hola"; //recibo algunos datos de otra pagina

// aqui comienzo a crear o digamos llenar el archivos con algunos datos  fwrite($Archivo_q_se_crea,"================================="); fwrite($Archivo_q_se_crea,"TITULO"); fwrite($Archivo_q_se_crea,"CANTIDAD"); fwrite($Archivo_q_se_crea,"Nombre".$dato ); fwrite($Archivo_q_se_crea," :: AQUI VAN LOS COMANDOS DE LA IMPRESORA ::");
fwrite($Archivo_q_se_crea," :: ESTO DEPENDE DEL MODELO ::");
 fwrite($Archivo_q_se_crea," :: AQUI TAMBIEN PODEMOS PONER EL COMANDO QUE HABRE LA GABETA DE DINERO O EL CAJON ::");
 fwrite($Archivo_q_se_crea," Gracias por Comprar en VideosconVida.com");


// ahora cerramos el archivo creado fclose($Archivo_q_se_crea); // cierra el fichero

//y por ultimo mandamos todos los codigos almacenados en el archivo "$Archivo_q_se_crea",(IMPRIMIMOS)
shell_exec('lpr "puerto en el cual se desea imprimir"'); 
 ?>
