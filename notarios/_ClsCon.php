<?php
 /*
 * Commentarios   : Clase de Transacciones Generales v. 2.0
 * Fecha Creacion : 18/01/2013
 * Creador por    : Carlos Lontop
 * Actualización  :
 * Observación    :
*/
class _ClsCon
{
	public $mysql = null;
	private $oCon  = null;
	private $rs    = null;
	private $srv   = "";
	public  $db    = "";
	private $usr   = "";
	private $pwd   = "";

	public function __construct()
		{
			$this->srv   = "localhost";
			$this->db    = "notarios";
			$this->usr   = "root";
			$this->pwd   = "12345";
			$this->mysql = new MySQLi();
		}
		
	public function __destruct()
		{
			
		}

	function _connect()
		{
			try
				{
					$this->oCon = $this->mysql->connect($this->srv,$this->usr,$this->pwd );
				}
			catch(Exception $ex)
				{
					printf("Error :".$ex->getMessage());
					exit();
				}
		}
			
	public function _trans($sp)
		{
			$this->_connect();
			$query = null;
			
				$this->mysql->select_db($this->db);
				$query = $this->mysql->query($sp) or die ("error al ejecutar sentencia :".$sp."<br/>".$this->mysql->error);

			return $query;
		}
	
	// excepciones
	public function _rs($sp) {
        $this->_connect();
        $this->mysql->select_db($this->db);
        $query = null;
        try {
            $query = $this->mysql->query($sp);
        } catch (Exception $ex) {
            printf("Error :" . $ex->getMessage());
            exit();
        }
        return $query;
    }
	
	
	// devuelve JSON
	public function _rsData($sp)
		{
			$this->_connect();
			$this->mysql->select_db($this->db);
			$query = null;
			$data = array();
			$i=0;
			try
			{
				$query = $this->mysql->query($sp);
				while($row = $query->fetch_assoc())
					{
						$data[] = $row;
					}
			}
			catch(Exception $ex)
			{
				printf("Error :".$ex->getMessage());
				exit();
			}
			return json_encode($data);
		}
	
	// devuelve datos separados por "|"	
	public function _rsArrayDatos($sp)
		{
			$this->_connect();
			$this->mysql->select_db($this->db);
			$query = null;
			$data = "";
			try
			{
				$query = $this->mysql->query($sp);
				while($row = $query->fetch_array())
					{
						$data = $data ."|".$row[0];
					}
			}
			catch(Exception $ex)
			{
				printf("Error :".$ex->getMessage());
				exit();
			}
			return $data;
		}
		

}
?>