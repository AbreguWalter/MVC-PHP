<?php  

	class Paginas extends Controlador{
		
		public function __construct(){

			$this->articuloModelo = $this->modelo('Articulo');
			
		}

		public function index(){

			$articulos = $this->articuloModelo->obtenerArticulos();

			$datos = [
				'titulo' => 'Bienvenido a PHP MVC',
				'articulos' => $articulos		
			];

			$this->vista('paginas/inicio',$datos);
		}

		public function articulos(){
			//$this->vista('paginas/inicio');
		}

		public function actualizar($num_registros){
			echo $num_registros;

		}


}

