<?php


	//Clase controlador principal
	//se encarga de poder cargar los modelos y vistas
	class Controlador{

		//cargar modelo
		public function modelo($modelo){
			//carga modelo
			//en el require_one se pone entre comillas simples dos puntos (..) 
			//para retroceder una carpeta y poder entrar en otra como en ../app
			require_once '../app/modelos/'.$modelo.'.php';
			//instanciar el modelo
			return new $modelo;
		}

		//cargar vista
		public function vista($vista,$datos = []){
			if (file_exists('../app/vistas/'.$vista.'.php')) {
					require_once '../app/vistas/'.$vista.'.php';
			}else{
				//si el arhivo no existe , que mande una advertencia
				die('La vista no existe');
			}	
		}
	}