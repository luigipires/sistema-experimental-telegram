<?php
	$fotousuario = \model\userModel::infouser($_SESSION['id']);
?>
<section>
	<div class="user">
		<aside>
			<div class="info-user">
				<div class="foto-usuario">
				<?php
					if(isset($fotousuario['fotos'])){
				?>
				<div class="foto-user">
					<img src="<?php echo INCLUDE_PATH; ?>imagens/usuarios/<?php echo $fotousuario['fotos']?>">
				</div>
				<?php
					}else{
				?>
				<div class="no-foto-user">
					<h3><i class="fas fa-user"></i></h3>
				</div>
				<?php
					}
				?>
				<div class="clear"></div>
				</div>
				<div class="infos-user">
					<p><?php echo ucfirst($_SESSION['nome']); ?></p>
					<p>Sexo: </p>
					<?php
						if($_SESSION['sexo'] == 'feminino'){
					?>
					<h3><i class="fas fa-venus"></i></h3>
					<?php
						}else if($_SESSION['sexo'] == 'masculino'){
					?>
					<h3><i class="fas fa-mars"></i></h3>
					<?php
						}else if($_SESSION['sexo'] == 'transexual'){
					?>
					<h3><i class="fas fa-transgender"></i></h3>
					<?php
						}
					?>
				</div>
				<div class="clear"></div>
			</div>
			<?php
				if($_SESSION['latitude'] == '0' && $_SESSION['longitude'] == '0'){
			?>
			<div class="botaolocalizacao">
				<button onClick="getLocation()">Ativar localização</button>
			</div>
			<?php
				}else{
			?>
			<div class="botaolocalizacao">
				<button onClick="getLocation()">Atualizar localização</button>
			</div>
			<?php
				}
			?>
			<div style="padding-bottom: 5px;" class="localizacao">
				<p style="padding: 0;">Localização: <?php echo ucfirst($_SESSION['localizacao']); ?></p>
			</div>
			<div style="padding-top: 0;" id="localizacao" class="localizacao">
				<p id="latitude">Latitude: <?php echo $_SESSION['latitude']; ?></p>
				<p id="longitude">Longitude: <?php echo $_SESSION['longitude']; ?></p>
			</div>
			<div class="likes-user">
				<h4>Likes recebidos</h4>
					<?php
						$crush = \model\userModel::crush();

						foreach ($crush as $key => $value){
							$fotocrush = \MySql::conexaobd()->prepare("SELECT fotos FROM `fotousuarios` WHERE usuario_id = ? LIMIT 1");
							$fotocrush->execute(array($value['id']));
							$fotocrush = $fotocrush->fetch()['fotos'];
					?>
					<div>
						<?php
							if($fotocrush != ''){
						?>
						<div class="foto-like">
							<img src="<?php echo INCLUDE_PATH; ?>imagens/usuarios/<?php echo $fotocrush;?>">
						</div>
						<?php
							}else{
						?>
						<div class="no-foto-like">
							<h3><i class="fas fa-user"></i></h3>
						</div>
						<?php
							}
						?>
						<div class="name-like">
							<p><?php echo $value['nome']; ?></p>
							<p>Distância: </p>
							<p id="latitudecrush" style="display: none;"><?php echo $value['latitude'];?></p>
							<p id="longitudecrush" style="display: none;"><?php echo $value['longitude'];?></p>
						</div>
					</div>
						<?php
							}
						?>

			</div>
		</aside>
	</div>
	<div class="painel">
		<?php
			if(isset($_GET['action'])){
				if($_GET['action'] == 1){
					\model\userModel::acoesusuario($_GET['action'],$_GET['id']);
				}else if($_GET['action'] == 0){
					\model\userModel::acoesusuario($_GET['action'],$_GET['id']);
				}
			}

			$mostra = \model\userModel::usuariossite();

			$fotomatch = \MySql::conexaobd()->prepare("SELECT * FROM `fotousuarios` WHERE usuario_id = ?");
			$fotomatch->execute(array($mostra['id']));
			$fotomatch = $fotomatch->fetch();
		?>
		<div class="match">
			<div class="sessao-foto">
				<?php
					if($fotomatch['fotos'] != ''){
				?>
				<div class="foto-match">
					<img src="<?php echo INCLUDE_PATH; ?>imagens/usuarios/<?php echo $fotomatch['fotos']; ?>">
				</div>
				<?php
					}else{
				?>
				<div class="no-foto-match">
					<h3><i class="fas fa-user"></i></h3>
				</div>
				<?php
					}
				?>
				<p><?php echo ucfirst($mostra['nome']); ?></p>
			</div>
			<div class="options-user">
				<a href="?action=1&id=<?php echo $mostra['id']; ?>">
					<h3><i class="fas fa-heart"></i></h3>
				</a>
				<div></div>
				<a href="?action=0&id=<?php echo $mostra['id']; ?>">
					<h3><i class="fas fa-times-circle"></i></h3>
				</a>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</section>