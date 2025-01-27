<?php 
	//clase para conectarse a la base de dato y ejecutar consultas
	class Base{
		private $host = DB_HOST;
		private $usuario = DB_USUARIO;
		private $password = DB_PASSWORD;
		private $nombre_base = DB_NOMBRE;
		//Data base handerl
		private $dbh ;
		private $stmt;
		private $error;

		public function __construct(){
			//configuramos conexion
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->nombre_base;
			$opciones = array(
				PDO::ATTR_PERSISTENT => true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			);


			//Crear una instancia para PDO
			try{
				$this->dbh = new PDO($dsn, $this->usuario,$this->password,$opciones);
				//Para que reconosca todos los caracteres
				$this->dbh->exec('set names utf8');

			}catch(PDOException $e){
				$this->error = $e->getMessage();
				echo $this->error;
			}
		}
		//Preparamos la consulta
		public function query($sql){
			$this->stmt = $this->dbh->prepare($sql);
		}
		//Vinculamos la consulta con bind
		public function bind($parametro,$valor,$tipo = null){
			if (is_null($tipo)) {
				switch (true) {
					case is_int($valor):
							$tipo = PDO::PARAM_INT;
						break;
					case is_bool($valor):
							$tipo = PDO::PARAM_BOOL;
						break;
					case is_null($valor):
							$tipo = PDO::PARAM_NULL;
						break;
					default:
						$tipo = PDO::PARAM_STR;
					break;	
				}
			}
			$this->stmt->bindValue($parametro,$valor,$tipo);		
		}
		//Ejecuta la consulta
		public function execute(){
			return $this->stmt->execute();
		}

		//Obtener los registros
		public function registros(){
			$this->execute();
			return $this->stmt->fetchAll(PDO::FETCH_OBJ);
		}

		//Obtener los registro
		public function registro(){
			$this->execute();
			return $this->stmt->fetch(PDO::FETCH_OBJ);
		}

		//Obtener cantidad de filas con el metodo rowCount
		public function rowCount(){
			return $this->stmt->rowCount();
		}
	}