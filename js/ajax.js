$(document).ready(function(){
	//Shows loading icon on search and hides the search results
	$('#foodSearch').bind("enterKey",function(e){
		$('.foodContainer').hide();
		$('#start').hide();
		$('#food').fadeOut();
		$('#loading').delay(100).fadeIn();
		$('#error').hide();

		$(document).ajaxStop(function(){
			$('#loading').fadeOut(function(){
				$('.foodContainer').show();
				$('#food').fadeIn(1000);
			});
		});
	});

	$('#foodSearch').keyup(function(e){
		if(e.keyCode == 13)
		{
			$(this).trigger("enterKey");
		}	
	});

	//Call username php script to see if username exists
	$("#username").on('blur', function(event){
		event.preventDefault();
		var user = $(this).serialize();
		$.post('username.php', user, function(data){
			$("#userError").html(data);
		});
	});

	//Call password php script to see if password is valid
	$("#password").on('blur', function(event){
		event.preventDefault();
		var pass = $(this).serialize();
		$.post('password.php', pass, function(data){
			$("#passError").html(data);
		});
	});

	//Call signup php script to see if parameters are valid
	$("#signup").on('submit', function(event){
		event.preventDefault();
		var signup = $(this).serialize();
		$.post('signup.php', signup, function(data){
			$("#signError").html(data);
			var result = $.trim(data);
			if(result == "success"){
				$("#signup").fadeOut(1500);
				$(".signup").fadeOut(1500);
				$(".loginNow").fadeOut(1500);
				$("#success").delay(1500).fadeIn(1500);
			}
			else{
				Materialize.toast('<b>Invalid fields</b>', 4000, 'red');
				console.log(result);
			}
		});
	});

	//Call login php script to see if username/password matches
	$("#login").on('submit', function(event){
		event.preventDefault();
		var login = $(this).serialize();
		$.post('login.php', login, function(data){
			var result = $.trim(data);
			if(result != "Invalid login credentials."){
				window.location.href = "index.php";
			}
			else{
				Materialize.toast('<b>Invalid login credentials</b>', 4000, 'red');
			}
		});
	});

	//Call delete php script to delete a recipe from favorites
	$("#favorites").delegate(".delete", "click", function(){
		var id = $(this).parent().find("img").attr("alt");
		$.post('delete.php', 'id='+id, function(data){
			var result = $.trim(data);
			if(result != "error"){
				Materialize.toast('<b>Recipe has been deleted</b>', 4000, 'green');
				$("#favorites").fadeOut();
				$("#favorites").empty();
				$("#favorites").html(result);
				$("#favorites").fadeIn();
			}
			else{
				Materialize.toast('<b>Error deleting recipe</b>', 4000, 'red');
			}
		});
	});
});