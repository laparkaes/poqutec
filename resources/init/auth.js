function login(dom){
	ajax_form(dom, "auth/login").done(function(res) {
		if (res.type == "success") location.href = "buyer/list";
		else swal(res.type, res.msg);
	});
}

function first_account(){
	var username = $("#inp_user").val();
	
	if (username != ""){
		const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		const validEmail = emailRegex.test(username);
		
		if (validEmail){
			ajax_simple_warning({username: username}, "auth/first_account", username + " will be created with<br/>Pasword: 123456").done(function(res) {
				swal_redirection(res.type, res.msg, "auth");
			});
		}else swal("error", "Enter valid email format.");
	}else swal("error", "Enter an email.");
}

$(document).ready(function() {
	$("#form_login").submit(function(e) {e.preventDefault(); login(this);});
	$("#btn_first_account").on('click',(function(e) {first_account();}));
});