<?php

	namespace model;

	Class userModel{

		public static function infouser($id){
			$sql = \MySql::conexaobd()->prepare("SELECT * FROM `fotousuarios` WHERE usuario_id = ? LIMIT 1");
			$sql->execute(array($id));
			return $sql->fetch();
		}

		public static function usuariossite(){
			if($_SESSION['sexo'] == 'masculino'){
				$sql = \MySql::conexaobd()->prepare("SELECT * FROM `usuarios` WHERE sexo != 'masculino' ORDER BY RAND() LIMIT 1");
				$sql->execute();
				return $sql->fetch();
			}else if($_SESSION['sexo'] == 'feminino'){
				$sql = \MySql::conexaobd()->prepare("SELECT * FROM `usuarios` WHERE sexo != 'feminino' ORDER BY RAND() LIMIT 1");
				$sql->execute();
				return $sql->fetch();
			}else if($_SESSION['sexo'] == 'transexual'){
				$sql = \MySql::conexaobd()->prepare("SELECT * FROM `usuarios` WHERE sexo != 'transexual' ORDER BY RAND() LIMIT 1");
				$sql->execute();
				return $sql->fetch();
			}
		}

		public static function acoesusuario($acao,$usuarioid){
			$sql = \MySql::conexaobd()->prepare("SELECT * FROM `likes` WHERE usuario_from = ? AND usuario_to = ?");
			$sql->execute(array($_SESSION['id'],$usuarioid));

			if($sql->rowCount() >= 1){
				return true;
			}else{
				$action = \MySql::conexaobd()->prepare("INSERT INTO `likes` VALUES (null,?,?,?)");
				$action->execute(array($_SESSION['id'],$usuarioid,$acao));
			}
		}

		public static function crush(){
			$crush = [];
			$sql = \MySql::conexaobd()->prepare("SELECT * FROM `likes` WHERE usuario_from = ?");
			$sql->execute(array($_SESSION['id']));
			$sql = $sql->fetchAll();

			foreach ($sql as $key => $value){
				$like = \MySql::conexaobd()->prepare("SELECT * FROM `likes` WHERE usuario_to = ? AND usuario_from = ? AND acao = 1");
				$like->execute(array($_SESSION['id'],$value['usuario_to']));

				if($like->rowCount() == 1){

					$info = \MySql::conexaobd()->prepare("SELECT* FROM `usuarios` WHERE id = ?");
					$info->execute(array($value['usuario_to']));
					$crush[] = $info->fetch();
				}
			}

			return $crush;
		}
	}
?>