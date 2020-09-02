<?php
	
	namespace controller;
	use \views\renderizacao;

	class userController{

		public function index(){
			
			if(!isset($_SESSION['login'])){
				\Metodos::redirecionamento(INCLUDE_PATH);
			}

			if(isset($_GET['logout'])){
				session_unset();
				session_destroy();
				\Metodos::redirecionamento(INCLUDE_PATH);
			}

			renderizacao::paginas('user.php',[],'paginas/principal/headerlogin.php');
		}
	}
?>