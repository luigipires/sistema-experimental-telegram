<?php

	include('../config.php');
	
	if(!isset($_SESSION['login'])){
		\Metodos::redirecionamento(INCLUDE_PATH);
		die();
	}

	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];

	$sql = \MySql::conexaobd()->prepare("UPDATE `usuarios` SET latitude = ?,longitude = ? WHERE id = ?");
	$sql->execute(array($latitude,$longitude,$_SESSION['id']));
?>