$(function(){
	$('#senha').click(function(){
		var mostrasenha = $('#senhainput').attr('type');

		if(mostrasenha == 'password'){
			$('#senhainput').attr('type','text');
			$('#senha i').removeClass('fas fa-eye');
			$('#senha i').addClass('fas fa-eye-slash');
		}else{
			$('#senhainput').attr('type','password');			
			$('#senha i').removeClass('fas fa-eye-slash');
			$('#senha i').addClass('fas fa-eye');
		}
	})

	$('#senharedefine').click(function(){
		var mostrasenha = $('#senhainputredefine').attr('type');

		if(mostrasenha == 'password'){
			$('#senhainputredefine').attr('type','text');
			$('#senharedefine i').removeClass('fas fa-eye');
			$('#senharedefine i').addClass('fas fa-eye-slash');
		}else{
			$('#senhainputredefine').attr('type','password');			
			$('#senharedefine i').removeClass('fas fa-eye-slash');
			$('#senharedefine i').addClass('fas fa-eye');
		}
	})
})