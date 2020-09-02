<?php
	
	namespace views;

	class renderizacao{

		public static function paginas($php,$controller = [],$header = 'paginas/principal/header.php',$footer = 'paginas/principal/footer.php'){
			include($header);
			include('paginas/'.$php);
			include($footer);
			die();
		}
	}
?>