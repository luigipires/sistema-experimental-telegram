<?php
	
	namespace controller;
	use \views\renderizacao;

	class homeController{

		public function index(){

			if(isset($_SESSION['login'])){
				\Metodos::redirecionamento(INCLUDE_PATH.'user');
			}

			renderizacao::paginas('home.php');
		}
	}
?>