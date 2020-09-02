	<section>
		<div class="banners-login">
			<div class="cadastro">
				<form method="post" enctype="multipart/form-data">
					<div>
						<h2>Cadastre-se</h2>
					</div>
					<?php
						 if(isset($_POST['acao'])){
						 	$nome = $_POST['nome'];
						 	$sexo = $_POST['sexo'];
						 	$email = $_POST['email'];
						 	$senha = $_POST['senha'];
						 	$foto = [];
						 	$fotousuario = count($_FILES['fotos']['name']);
						 	$funcionamento = true;

						 	if($nome == ''){
						 		\Metodos::mensagem('erro','O nome não foi inserido!');
						 	}else if($sexo == ''){
						 		\Metodos::mensagem('erro','O sexo não foi escolhido!');
						 	}else if($email == '' || filter_var($email,FILTER_VALIDATE_EMAIL) == false){
						 		\Metodos::mensagem('erro','Insira um e-mail válido!');
						 	}else if($senha == ''){
						 		\Metodos::mensagem('erro','A senha não foi inserida!');
						 	}else if($_FILES['fotos']['name'][0] != ''){
						 		for($i = 0; $i < $fotousuario; $i++){
						 			$fotoadicionada = ['type'=>$_FILES['fotos']['type'][$i],'size'=>$_FILES['fotos']['size'][$i]];
						 			if(\Metodos::validacaoimagem($fotoadicionada) == false){
						 				\Metodos::mensagem('erro','Adicione imagens válidas!');
						 				$funcionamento = false;
						 				break;
						 			}else{
						 				$verificacao = \MySql::conexaobd()->prepare("SELECT email FROM `usuarios` WHERE email = ?");
						 				$verificacao->execute(array($email));

						 				if($verificacao->rowCount() == 0){
						 					for($i = 0; $i < $fotousuario; $i++){
							 					$fotoadicionada = ['tmp_name'=>$_FILES['fotos']['tmp_name'][$i],'name'=>$_FILES['fotos']['name'][$i]];
							 					$foto[] = Metodos::uparimagemusuarios($fotoadicionada);
							 					$sql = \MySql::conexaobd()->prepare("INSERT INTO `usuarios` VALUES (null,?,?,?,?,?,?,?)");
							 					$sql->execute(array($nome,$sexo,$email,$senha,0,0,0));

							 					$idusuario = \MySql::conexaobd()->lastInsertId();

							 					foreach ($foto as $key => $value){
							 						$sql = \MySql::conexaobd()->prepare("INSERT INTO `fotousuarios` VALUES (null,?,?)");
							 						$sql->execute(array($idusuario,$value));
							 					}

							 					\Metodos::redirecionamento(INCLUDE_PATH.'?sucesso');
							 				}
						 				}else{
							 				\Metodos::mensagem('erro','Já existe um e-mail cadastrado!');
							 			}
						 			}
						 		}
						 	}else{
						 		$verificacao = \MySql::conexaobd()->prepare("SELECT email FROM `usuarios` WHERE email = ?");
						 		$verificacao->execute(array($email));

						 		if($verificacao->rowCount() == 0){
							 		$sql = \MySql::conexaobd()->prepare("INSERT INTO `usuarios` VALUES (null,?,?,?,?,?,?,?)");
								 	$sql->execute(array($nome,$sexo,$email,$senha,0,0,0));

								 	\Metodos::redirecionamento(INCLUDE_PATH.'?sucesso');
								 }else{
								 	\Metodos::mensagem('erro','Já existe um e-mail cadastrado!');
								 }
						 	}
						 }
						 	if(!isset($_POST['acao']) && isset($_GET['sucesso'])){
						 		\Metodos::alertajavascript('Usuário cadastrado com sucesso!');
						 		\Metodos::redirecionamento(INCLUDE_PATH);
						 	}
					?>
					<div>
						<p>Nome:</p>
						<input type="text" name="nome" value="<?php echo \Metodos::recuperarcampopreenchido('nome'); ?>">
					</div>
					<div>
						<p>Sexo:</p>
						<select name="sexo">
							<option value="feminino">Feminino</option>
							<option value="masculino">Masculino</option>
							<option value="transexual">Transexual</option>
						</select>
					</div>
					<div>
						<p>E-mail:</p>
						<input type="text" name="email" value="<?php echo \Metodos::recuperarcampopreenchido('email'); ?>">
					</div>
					<div>
						<p>Senha:</p>
						<input type="password" name="senha">
					</div>
					<div>
						<p>Adicionar fotos:</p>
						<input multiple type="file" name="fotos[]">
					</div>
					<div>
						<input type="submit" name="acao" value="Cadastrar">
					</div>
				</form>
			</div>
		</div>
	</section>

	