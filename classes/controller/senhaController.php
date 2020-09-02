<?php
	
	namespace controller;
	use \views\renderizacao;

	class senhaController{

		public function index(){

			if(isset($_SESSION['login'])){
				\Metodos::redirecionamento(INCLUDE_PATH);
			}

			renderizacao::paginas('senha.php',[],'paginas/principal/header.php');
		}
	}
?>