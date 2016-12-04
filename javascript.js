$(document).ready(function(){
	$("#review-btn").on("click", createReview);

	$('#loginForm').submit(function () {
		loginClientCheck();
		return false;
	});
	
	var loginClientCheck = function(){
		var username = document.getElementById("username").value;
		var password = document.getElementById("password").value;
		var error = false;

		var span1 = document.getElementById("span1");
		var span2 = document.getElementById("span2");
		var span3 = document.getElementById("span3");
		var span4 = document.getElementById("span4");
		
		span1.innerHTML = "";
		span2.innerHTML = "";
		span3.innerHTML = "";
		span4.innerHTML = "";
		
		if(username.length == 0 || username.length > 24){
			span1.innerHTML = "Username tidak sesuai format</br>";
			span2.innerHTML = "Username tidak boleh kosong dan memiliki panjang kurang dari 25";
			error = true;
		}
		if(password.length == 0){
			span3.innerHTML = "Password tidak sesuai format</br>";
			span4.innerHTML = "Password tidak boleh kosong";
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
		document.getElementById("loginForm").submit();
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