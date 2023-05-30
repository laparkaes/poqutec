function set_account_update_form(is_edit){
	if (is_edit == true){
		$("#form_account_update input").removeAttr("readonly");
		$("#form_account_update #in_username").attr("readonly", true);
		$("#btn_account_edit").addClass("d-none");
		$("#btn_account_edit_cancel").removeClass("d-none");
		$("#btn_account_update").removeClass("d-none");
	}else{
		$("#form_account_update input").attr("readonly", true);
		$("#btn_account_edit").removeClass("d-none");
		$("#btn_account_edit_cancel").addClass("d-none");
		$("#btn_account_update").addClass("d-none");
	}
}

function account_register(dom){
	ajax_form(dom, "account/register").done(function(res) {
		swal_redirection(res.type, res.msg, res.move_to);
	});
}

function account_update(dom){
	ajax_form(dom, "account/update").done(function(res) {
		swal(res.type, res.msg);
		if (res.type == "success") set_account_update_form(false);
	});
}

$(document).ready(function() {
	//register
	$("#form_account_register").submit(function(e) {e.preventDefault(); account_register(this);});
	
	//detail - company
	$("#form_account_update").submit(function(e) {e.preventDefault(); account_update(this);});
	$("#btn_account_edit").on('click',(function(e) {set_account_update_form(true);}));
	$("#btn_account_edit_cancel").on('click',(function(e) {set_account_update_form(false);}));
});