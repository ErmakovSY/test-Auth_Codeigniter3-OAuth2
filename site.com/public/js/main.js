//login-button click
function login() {
	var email = $(".main__form").children().children(".form__input--email").val();
	var password = $(".main__form").children().children(".form__input--password").val();
	if (email !='' && password != '') {
		$.ajax({
			url: 'login',
			type: 'POST',
			data: {
				"email": email,
				"password": password
			},
			success: function(res) {
				if(res == 'email incorrect' || res == 'password incorrect') {
					$(".main__form").children(".form__warning").text(res);
				}
				else if(res) {
					getCaptcha();
				}
			},
			error: function(error, txtStatus) {
				console.log(txtStatus);
				console.log('error');
			}
		});
	}
}

//register button click
function showRegistrationPage() {   
	$.ajax({
		url: 'regisrtation-form',
		type: 'POST',
		success: function(res) {
			$('.main__form').html(res);
		},
		error: function(error, txtStatus) {
			console.log(txtStatus);
			console.log('error');
		}
	});
}

//register submit click
function register() {   
	var email = $(".form__input--email").val();
	var password = $(".form__input--password").val();

	$.ajax({
		url: 'regisrtation-submit',
		type: 'POST',
		data: {
			"email": email,
			"password": password
		},
		success: function(res) {
			if(res == 'email already exist') {
				$(".main__form").children(".form__warning").text(res);
			}
			else {
				getCaptcha();
			}
		},
		error: function(error, txtStatus) {
			console.log(txtStatus);
			console.log('error');
		}
	});
}

//edit button click
function showEditPage() {   
		// show edit form
	$.ajax({
		url: 'edit-form',
		type: 'POST',
		success: function(res) {
			$('.main__form').html(res);
		},
		error: function(error, txtStatus) {
			console.log(txtStatus);
			console.log('error');
		}
	});
		//load data into form
	setTimeout(function() {
		$.ajax({
			url: 'edit-form-data',
			type: 'GET',
			dataType: 'JSON',
			success: function(content) {
				if (content != "nothing to show") {
					$.each(content, function(index, item) {
						$(".main__form").children().children(".form__input--nameF").val(item.first_name);
						$(".main__form").children().children(".form__input--nameS").val(item.last_name);
						$(".main__form").children().children(".form__input--email").val(item.email);
						$(".main__form").children().children(".form__input--password").val(item.password);
						$(".main__form").children().children(".form__input--password-repeat").val(item.password);
						$(".main__form").children().children(".form__input--birth").val(item.birth);
						$(".main__form").children().children(".form__input--phone").val(item.phone);
						$(".main__form").children().children(".form__input--country").val(item.country);
						$(".main__form").children().children(".form__input--city").val(item.city);
						$(".main__form").children().children(".form__input--adress").val(item.adress);
						$(".main__form").children().children(".form__input--post-index").val(item.post_index);
						if(item.image != '') {
							$(".main__form").children().children(".form__photo").attr('src', item.image);
						}
					});
				}
			},
			error: function(error, txtStatus) {
				console.log(txtStatus);
				console.log('error');
			}
		});
	}, 100);
}

//edit submit click
function update() { 
	var firstName = $(".main__form").children().children(".form__input--nameF").val();
	var secondName = $(".main__form").children().children(".form__input--nameS").val();
	var email = $(".main__form").children().children(".form__input--email").val();
	var password = $(".main__form").children().children(".form__input--password").val();
	var passwordRepeat = $(".main__form").children().children(".form__input--password-repeat").val();
	var birth = $(".main__form").children().children(".form__input--birth").val();
	var phone = $(".main__form").children().children(".form__input--phone").val();
	var country = $(".main__form").children().children(".form__input--country").val();
	var city = $(".main__form").children().children(".form__input--city").val();
	var adress = $(".main__form").children().children(".form__input--adress").val();
	var postIndex = $(".main__form").children().children(".form__input--post-index").val();

	if (password == passwordRepeat) {
		$.ajax({
			url: 'edit-submit',
			type: 'POST',
			data: {
				"first_name": firstName,
				"second_name": secondName,
				"email": email,
				"password": password,
				"birth": birth,
				"phone": phone,
				"country": country,
				"city": city,
				"adress": adress,
				"post_index": postIndex
			},
			success: function(res) {
				window.location.replace('');
			},
			error: function(error, txtStatus) {
				console.log(txtStatus);
				console.log('error');
			}
		});
	}
	else {
		alert("Password incorrect");
	}
}

//logout button click
function logout() {   
	$.ajax({
		url: 'logout',
		type: 'POST',
		success: function(res) {
			window.location.replace('home');
		},
		error: function(error, txtStatus) {
			console.log(txtStatus);
			console.log('error');
		}
	});
}

//back button click
function backToHome() {   
	window.location.replace('');
}

//check captcha button click
function checkCaptcha() {
	var inputCode = $(".main__form").children().children().children(".form__input--captcha").val();
	$.ajax({
		url: 'check-captcha',
		type: 'POST',
		data: {
			"inputCode": inputCode
		},
		success: function(res) {
			if(res == 'success') {
				window.location.replace('');
			}
			else {
				$(".main__form").children().children().children().children(".form__captcha-image").attr('src', 'data:image/png;base64, '+ res);
			}
		},
		error: function(error, txtStatus) {
			console.log(txtStatus);
			console.log('error');
		}
	});
}

//loading captcha
function getCaptcha() {
	setTimeout(function() {
		$(".main__form").children().children(".form__captcha-wrapper").show(200);
		$(".main__form").children().children(".form__wrapper").hide(200);
	}, 100);

	$.ajax({
		type: 'GET',
		url: 'get-captcha',
		success: function(img) {
			$(".main__form").children().children().children().children(".form__captcha-image").attr('src', 'data:image/png;base64, '+ img);
		},
		error: function(error, txtStatus) {
			console.log(txtStatus);
			console.log('error');
		}
	});
}
//photo button click
function uploadPhoto() {
	var fd = new FormData();
	var files = $('#input-file')[0].files[0];
	fd.append('file', files);

	$.ajax({
		url: 'upload-photo',
		type: 'POST',
		data: fd,
		contentType: false,
		processData: false,
		success: function(response){
			if(response != 0) {
				$(".form__photo").attr("src", response);
			}
			else {
				alert('file not uploaded');
			}
		},
	});
}
// login with google click
function loginGoogle() {
	$.ajax({
		url: 'login-google',
		type: 'GET',
		success: function(res) {
			if(res == true) {
				window.location.href = '';
			}
		},
		error: function(error, txtStatus) {
			console.log(txtStatus);
			console.log('error');
		}
	});
}
