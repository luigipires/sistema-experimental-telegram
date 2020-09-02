<?php
	
	session_start();

	date_default_timezone_set('America/Sao_Paulo');

	define('INCLUDE_PATH','http://localhost/PHP_aulas/tinder/');
	define('INCLUDE_PATH_PAGES',INCLUDE_PATH.'user/');
	define('IMAGEM',__DIR__.'/imagens/');
	
	define('DATABASE','tinder');
	define('PASSWORD','');
	define('HOST','localhost');
	define('USER','root');

	$autoload = function($classe){
		include('classes/'.$classe.'.php');
	};

	spl_autoload_register($autoload);
?>