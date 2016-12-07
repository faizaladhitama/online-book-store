$(document).ready(function(){
			
	$("#review-btn").on("click", createReview);

	$('#loginFormAction').submit(function () {
		loginClientCheck();
		return false;
	});
	
	var loginClientCheck = function(){
		var username = document.getElementById("username").value;
		var password = document.getElementById("password").value;
		var error = false;

		var span1 = document.getElementById("span1");
		var span2 = document.getElementById("span2");
		
		span1.innerHTML = "";
		span2.innerHTML = "";
		
		if(username.length >= 20){
			span1.innerHTML = "Username tidak sesuai format";
			error = true;
		}
		if(password.length >= 12){
			span2.innerHTML = "Password tidak sesuai format";
			error = true;
		}

		if(!error){
			loginServerCheck();
		}
		else{
			return false;
		}
	}

	var loginServerCheck = function(){
		document.getElementById("loginFormAction").submit();
	}

	function createReview(){
		var val = document.getElementById("review-box").value;	
		var thisid = document.getElementById("hiddenid").value;
		$.ajax ({
			type: "GET",
			url:"service.php",
			data:{command:"submit_review",value:val,id:thisid},
		}).done(function(data){
			location.reload();
		});
	} 
});