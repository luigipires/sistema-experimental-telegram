<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Telegram</title>
	<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH; ?>css/tinder.css">
	<link  rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH; ?>css/fontawesome.css">
	<link  rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH; ?>css/brands.css">
	<link  rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH; ?>css/solid.css">
</head>
<body>
	<header>
		<div class="logo">
			<a href="<?php echo INCLUDE_PATH; ?>">
				<div class="logo-header">
					<img src="<?php echo INCLUDE_PATH;?>imagens/logo.png">
				</div>
				<div class="logo-name">
					<p>Telegram</p>
				</div>
				<div class="clear"></div>
			</a>
		</div>
		<div class="login">
			<form method="post">
				<?php
					if(isset($_POST['login'])){
						$emaillogin = $_POST['emaillogin'];
						$senhalogin = $_POST['senhalogin'];

						$sql = \MySql::conexaobd()->prepare("SELECT * FROM `usuarios` WHERE email = ? AND senha = ?");
						$sql->execute(array($emaillogin,$senhalogin));

						if($sql->rowCount() == 1){
							$sql = $sql->fetch();
							$_SESSION['login'] = $emaillogin;
							$_SESSION['id'] = $sql['id'];
							$_SESSION['email'] = $sql['email'];
							$_SESSION['nome'] = $sql['nome'];
							$_SESSION['sexo'] = $sql['sexo'];
							$_SESSION['localizacao'] = $sql['localizacao'];
							$_SESSION['latitude'] = $sql['latitude'];
							$_SESSION['longitude'] = $sql['longitude'];
							unset($_SESSION['emailredefine']);

							sleep(1);
							\Metodos::redirecionamento(INCLUDE_PATH.'user');
						}else{
							\Metodos::alertajavascript('E-mail ou senha incorretos!');
						}
					}
				?>
				<div>
					<p>E-mail:</p>
					<input type="text" name="emaillogin" value="<?php echo \Metodos::recuperarcampopreenchido('emaillogin'); ?>">
				</div>
				<div class="senha">
					<p>Senha:</p>
					<input id="senhainput" type="password" name="senhalogin">
					<h3 id="senha"><i class="fas fa-eye"></i></h3>
				</div>
				<div>
					<input type="submit" name="login" value="Entrar">
				</div>
				<div>
					<a href="<?php echo INCLUDE_PATH; ?>password">Esqueci a senha</a>
				</div>
			</form>
		</div>
		<div class="clear"></div>
	</header>
		