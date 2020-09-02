<?php

	if($_GET['token']){
		$token = $_GET['token'];

		if($token != $_SESSION['token']){
			die(\Metodos::mensagem('erro','O token não é válido! <a href="'.INCLUDE_PATH.'passwordredefine?token='.$_SESSION['token'].'">Clique Aqui para voltar à tela anterior.</a>'));
		}
	}
?>
<section>
	<div class="banners-login">
		<div class="cadastro">
			<form method="post">
				<div>
					<h2>Redefinição de senha:</h2>
				</div>
				<?php
					if(isset($_POST['redefenir'])){
						$senha = $_POST['senha'];

						if($senha == ''){
							\Metodos::mensagem('erro','A senha não foi inserida!');
						}else{
							$sql = \MySql::conexaobd()->prepare("UPDATE `usuarios` SET senha = ? WHERE email = ?");
							$sql->execute(array($senha,$_SESSION['emailredefine']));
							\Metodos::alertajavascript('Sua senha foi redefinida com sucesso!');
							\Metodos::redirecionamento(INCLUDE_PATH);
							unset($_SESSION['emailredefine']);
						}
					}
				?>
				<div class="mudasenha">
					<input id="senhainputredefine" type="password" name="senha">
					<h3 id="senharedefine"><i class="fas fa-eye"></i></h3>
				</div>
				<div>
					<input type="submit" name="redefenir" value="Enviar">
				</div>
			</form>
		</div>
	</div>
</section>