<?php


	/*
	Traer la URL ingresada en el navegador
	1.- controlador
	2.- metodo
	3.- Parametro

	Ejem: /articulo/actualizar/4
		Controlador/Metodo/Parametro
	*/

	class Core{
		protected $controladorActual = 'paginas';
		protected $metodoActual = 'index';
		protected $parametros = [];	

		public function __construct(){
			//print_r(); -> es para mandar datos a la pantalla
			$url = $this->getUrl();

			//Buscar en controladores si el controlador existe
			if (file_exists('../app/controladores/' . ucwords($url[0]) .'.php')) {
				//Si existe se setea como controlador por defecto
				$this->controladorActual = ucwords($url[0]);

				//unset indice
				unset($url[0]);//controlador

			}

			//Requerir el controlador
			//una buena practica es poner concatenado el .php
			require_once '../app/controladores/'. $this->controladorActual.'.php';
			$this->controladorActual = new $this->controladorActual;


			//chequear la segunda parte de la url que seria el metodo
			if (isset($url)) {
				if (method_exists($this->controladorActual,$url[1])) {
					//Si se carga chequiamos el metodo
					$this->metodoActual = $url[1];
					//unset indice
					unset($url[1]);	//metodo
				}

			}

			$this->parametros = $url ? array_values($url) : []; //parametro

			//Llamar una funcion de callback con parametros array
			call_user_func_array([$this->controladorActual,$this->metodoActual],$this->parametros);
		}


		public function getUrl(){
			//echo $_GET['url'];
			if (isset($_GET['url'])) {
				$url = rtrim($_GET['url'], '/' );
				$url = filter_var($url,FILTER_SANITIZE_URL);
				$url = explode('/' , $url);
				return $url;

				
			}
		}
	}






 