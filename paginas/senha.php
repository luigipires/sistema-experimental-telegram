<section>
	<div class="banners-login">
		<div class="cadastro">
			<form method="post">
				<div>
					<h2>Redefinição de senha:</h2>
				</div>
				<div>
					<h4>Insira seu e-mail abaixo:</h4>
				</div>
				<?php
					if(isset($_POST['acao'])){
						$email = $_POST['email'];
						$token = uniqid();
						$_SESSION['token'] = $token;

						if($email == '' || filter_var($email,FILTER_VALIDATE_EMAIL) == false){
							\Metodos::mensagem('erro','Insira um e-mail válido!');
						}else{
							$sql = \MySql::conexaobd()->prepare("SELECT * FROM `usuarios` WHERE email = ?");
							$sql->execute(array($email));

							if($sql->rowCount() == 1){
								$_SESSION['emailredefine'] = $email;

								echo '<div class="senharedefine"><h5>Te enviamos um e-mail. Clique no link para redefenir sua senha. <a href="'.INCLUDE_PATH.'passwordredefine?token='.$_SESSION['token'].'">Clique Aqui!</a></h5></div>';
							}else{
								\Metodos::redirecionamento(INCLUDE_PATH.'password?erro');
							}
						}
					}

					if(!isset($_POST['acao']) && isset($_GET['erro']))
						\Metodos::mensagem('erro','Esse e-mail não é cadastrado!');
				?>
				<div>
					<input type="text" name="email">
				</div>
				<div>
					<input type="submit" name="acao" value="Enviar">
				</div>
			</form>
		</div>
	</div>
</section>
