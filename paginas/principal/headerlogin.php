<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Telegram | <?php echo ucfirst($_SESSION['nome']); ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH; ?>css/tinder2.css">
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
		<div class="logout">
			<a href="<?php echo INCLUDE_PATH; ?>user?logout">
				<h3><i class="fas fa-sign-out-alt"></i></h3>
				<p>Sair</p>
				<div class="clear"></div>
			</a>
		</div>
		<div class="clear"></div>
	</header>