function set_buyer_update_form(is_edit){
	if (is_edit == true){
		$("#form_buyer_update input").removeAttr("readonly");
		$("#form_buyer_update select").prop("disabled", false);
		$("#btn_buyer_edit").addClass("d-none");
		$("#btn_buyer_edit_cancel").removeClass("d-none");
		$("#btn_buyer_update").removeClass("d-none");
	}else{
		$("#form_buyer_update input").attr("readonly", true);
		$("#form_buyer_update select").prop("disabled", true);
		$("#btn_buyer_edit").removeClass("d-none");
		$("#btn_buyer_edit_cancel").addClass("d-none");
		$("#btn_buyer_update").addClass("d-none");
	}
}

function person_reload(company_id){
	ajax_simple({company_id:company_id}, "buyer/load_people").done(function(res) {
		var dom_set;
		$("#ul_people_list").html("");
		$.each(res, function(index, item) {
			dom_set = '<li class="list-group-item"><div class="d-flex justify-content-between align-items-start"><h5 class="mb-0">' + item.name + '</h5><button type="button" class="btn btn-danger btn-sm btn_person_delete" value="' + item.id + '"><i class="fas fa-trash-alt"></i></button></div>';
			if (item.position != "") dom_set += '<p class="mb-1">' + item.position + '</p>';
			if (item.mobile != "") dom_set += '<p class="mb-1"><i class="fas fa-phone fa-fw"></i> ' + item.mobile + '</p>';
			if (item.email != "") dom_set += '<p class="mb-1"><i class="fas fa-envelope fa-fw"></i> ' + item.email + '</p>';
			dom_set += '<small class="text-muted">' + item.registed_at + '</small></li>';
			$("#ul_people_list").append(dom_set);
		});
		$(".btn_person_delete").on('click',(function(e) {person_delete($(this).val());}));
	});
}

function buyer_register(dom){
	ajax_form(dom, "buyer/register").done(function(res) {
		swal_redirection(res.type, res.msg, res.move_to);
	});
}

function buyer_update(dom){
	ajax_form(dom, "buyer/update").done(function(res) {
		swal(res.type, res.msg);
		if (res.type == "success") set_buyer_update_form(false);
	});
}

function person_register(dom){
	ajax_form(dom, "buyer/person_register").done(function(res) {
		if (res.type == "success"){
			person_reload($("#company_id").val());
			document.getElementById("form_person_register").reset();
			$('#md_person_add').modal('hide');
		}
	});
}

function person_delete(person_id){
	var warning_msg = "Are you sure you want to delete the selected person?";
	ajax_simple_warning({id: person_id}, "buyer/person_delete", warning_msg).done(function(res) {
		swal(res.type, res.msg);
		if (res.type == "success") person_reload($("#company_id").val());
	});
}

$(document).ready(function() {
	//register
	$("#form_buyer_register").submit(function(e) {e.preventDefault(); buyer_register(this);});
	
	//detail - company
	$("#form_buyer_update").submit(function(e) {e.preventDefault(); buyer_update(this);});
	$("#btn_buyer_edit").on('click',(function(e) {set_buyer_update_form(true);}));
	$("#btn_buyer_edit_cancel").on('click',(function(e) {set_buyer_update_form(false);}));
	
	//detail - person
	$("#form_person_register").submit(function(e) {e.preventDefault(); person_register(this);});
	$("#btn_person_add").on('click',(function(e) {$("#form_person_register").submit();}));
	$(".btn_person_delete").on('click',(function(e) {person_delete($(this).val());}));
});