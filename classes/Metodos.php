<?php
	
	class Metodos{

		public static function redirecionamento($url){
			echo '<script>location.href="'.$url.'"</script>';
			die();
		}

		public static function validacaoimagem($imagem){
			if($imagem['type'] == 'image/jpg' || $imagem['type'] == 'image/png' || $imagem['type'] == 'image/jpeg'){
				$tamanhoimagem = intval($imagem['size']/2048);

				if ($tamanhoimagem < 700)
					return true;
				else
					return false;
			}else{
				return false;
			}
		}

		public static function uparimagemusuarios($imagem){
			$formatoimagem = explode('.',$imagem['name']);
			$imagemnome = uniqid().'.'.$formatoimagem[count($formatoimagem) - 1];

			if(move_uploaded_file($imagem['tmp_name'],IMAGEM.'usuarios/'.$imagemnome))
				return $imagemnome;
			else
				return false;
		}

		public static function apagarimagemusuarios($imagem){
			@unlink('imagens/usuarios/'.$imagem);
		}

		public static function mensagem($tipomensagem,$mensagem){
			if($tipomensagem == 'sucesso'){
				echo '<div class="sucesso"><i class="fas fa-check-circle"></i><p>'.$mensagem.'</p></div>';
			}else if($tipomensagem == 'erro'){
				echo '<div class="erro"><i class="fas fa-exclamation-triangle"></i><p>'.$mensagem.'</p></div>';
			}
		}

		public static function alertajavascript($mensagem){
			echo '<script>alert("'.$mensagem.'");</script>';
		}

		public static function inseririnformacoes($info){
			$certo = true;
			$tabela = $info['insert'];
			$query = "INSERT INTO `$tabela` VALUES(null,";

			foreach ($info as $key => $value){
				$nome = $key;

				if($nome == 'acao' || $nome == 'insert'){
					continue;
				}
				if($value == ''){
					$certo = false;
					break;
				}
				$query.=",?";
				$valores[] = $value;
			}

			$query.=")";
			if($certo == true){
				$sql = \MySql::conexaobd()->prepare($query);
				$sql->execute($valores);
			}

			return $certo;
		}

		public static function recuperarcampopreenchido($post){
			if(isset($_POST[$post])){
				echo $_POST[$post];
			}
		}

		public static function carregarjavascript($arquivos,$paginas){
			$url = explode('/',@$_GET['url'])[0];

			if($paginas == $url){
				foreach ($arquivos as $key => $value){
					echo '<script src="'.INCLUDE_PATH.'javascript/'.$value.'"></script>';
				}
			}
		}
	}
?>