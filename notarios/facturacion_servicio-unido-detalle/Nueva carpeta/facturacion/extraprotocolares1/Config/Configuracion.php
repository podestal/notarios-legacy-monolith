<?php
#### Archivo de configuración ####
class AsignaPath
{
	public $ruta_plantillas   		= "";  
	public $ruta_archivos     		= ""; 
	
	public $cambio_caracteristicas  = "";
	public $certifi_domiciliario    = "";
	public $libro					= "";
	public $permiviaje				= "";
	public $certificado_persona		= "";
	public $poderes					= "";
	
	public $protocolar_kardex		= "";
	public $protocolar_vehicular	= "";
	public $cartas					= "";
	public $protestos				= "";
	public $facturas				= "";
	
	public $anexo5				    = "";
	
	public $tip_extension			= "";
	
	public $notario			        = "";
	
#################################################################################################################################################	
	public function __construct()
		{			
			$this->ruta_plantillas        = "C:/templates/";      						 ## Ruta donde se encuentran las plantillas.
			
			## EXTRA PROTOCOLARES
			# Opcion por Defecto
			$this->ruta_archivos          = "C:/Doc_Generados/";  						 ## Ruta donde se ubicaran los archivos generados.
			
			# Opcion Separapados - En cada carpeta
			$this->cambio_caracteristicas = "C:/Doc_Generados/cambio_caracteristicas/";  ## Ruta archivos - generados Cambio de caracteristicas.
			$this->certifi_domiciliario   = "C:/Doc_Generados/certifi_domiciliario/";    ## Ruta archivos - generados Certificados Domiciliarios.
			$this->libro				  = "C:/Doc_Generados/libros/";  				 ## Ruta archivos - generados Libros.
			$this->permiviaje			  = "C:/Doc_Generados/permiviaje/";  			 ## Ruta archivos - generados Permisos de viaje.
			$this->certificado_persona    = "C:/Doc_Generados/certificado_persona/";  	 ## Ruta archivos - generados Certificados de supervivencia.
			$this->poderes				  = "C:/Doc_Generados/poderes/";  				 ## Ruta archivos - generados Poderes.
			$this->cartas				  = "C:/Doc_Generados/cartas/";  				 ## Ruta archivos - generados Cartas.
			$this->protestos			  = "C:/Doc_Generados/protestos/";  
			
			$this->protocolar_kardex	  = "C:/Doc_Generados/";  						 ## Ruta archivos - generados Protocolares.
			$this->protocolar_vehicular	  = "C:/Doc_Generados/";  						 ## Ruta archivos - generados Vehiculares.
			
			$this->anexo5	  			  = "C:/Anexo5/";  						         ## Ruta archivos del anexo 5
			
			## FACTURAS
			$this->facturas				  = "C:/facturas/";  				             ## Ruta archivos - Facturas generadas.
			
			## CONFIGURACIÓN TIPO DOCUMENTOS - EXTRAPROTOCOLARES		
			$this->tip_extension_ep		  = ".odt";										 ## Extension de los Generadores Extraptrotocolares (.odt ó .docx)
			
		}
#################################################################################################################################################	
	
	
	
	
	public function __set_path_template()
	{
		return($this->ruta_plantillas);
	}
	
	
	public function __set_tip_output_ep()
	{
		return($this->tip_extension_ep);
	}
		
	public function __set_path_exit($_eval)
	{
		switch($_eval){
			
				# EXTRA PROTOCOLARES
				case 'cambio_caracteristicas':
				
					return($this->cambio_caracteristicas); break;
					
				case 'certifi_domiciliario':
				
					return($this->certifi_domiciliario); break;
					
				case 'libro':
				
					return($this->libro); break;
					
				case 'permiviaje':
				
					return($this->permiviaje); break;
					
				case 'certificado_persona':
				
					return($this->certificado_persona); break;
					
				case 'poderes':
				
					return($this->poderes); break;
					
				case 'cartas':
				
					return($this->cartas); break;	
				
				case 'protestos':
				
					return($this->protestos); break;
				
				# PROTOCOLARES	
				case 'protocolar_kardex':
				
					return($this->protocolar_kardex); break;
					
				case 'protocolar_vehicular':
				
					return($this->protocolar_vehicular); break;
				
				# FACTURAS	
				case 'facturas':
				
					return($this->facturas); break;	
					
				# ANEXO 5	
				case 'anexo5':
				
					return($this->anexo5); break;
										
						
				default : 	
					return($this->ruta_archivos); break;

			          }

	}

}
##################################

?>