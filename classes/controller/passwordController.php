<?php
	
	namespace controller;
	use \views\renderizacao;

	class passwordController{

		public function index(){

			if(isset($_SESSION['login'])){
				\Metodos::redirecionamento(INCLUDE_PATH);
			}

			renderizacao::paginas('password.php',[],'paginas/principal/header.php');
		}
	}
?>