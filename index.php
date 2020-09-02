<?php
	include('config.php');

	$homeController = new controller\homeController();
	$userController = new controller\userController();
	$senhaController = new controller\senhaController();
	$passwordController = new controller\passwordController();

	Rotas::get('/',function() use ($homeController){
		$homeController->index();
	});

	//condições para ver existência de rotas, caso contrário irá redirecionar para a página inicial

	if(Rotas::get('/user',function() use ($userController){
		$userController->index();
	})){

	}else if(Rotas::get('/password',function() use ($senhaController){
		$senhaController->index();
	})){

	}else if(Rotas::get('/passwordredefine',function() use ($passwordController){
		$passwordController->index();
	})){

	}else{
		\Metodos::redirecionamento(INCLUDE_PATH);
	}

?>