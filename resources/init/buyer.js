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
		$("#tb_people").html("");
		$.each(res, function(index, item) {
			$("#tb_people").append('<tr><th scope="row">' + (index + 1) + '</th><td>' + item.name + '</td><td>' + item.position + '</td><td>' + item.mobile + '</td><td>' + item.email + '</td><td>' + item.registed_at + '</td><td class="text-right"><button type="button" class="btn btn-danger btn-sm btn_person_delete" value="' + item.id + '"><i class="fas fa-trash-alt"></i></button></td></tr>');
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

function note_load(company_id, page){
	ajax_simple({company_id:company_id, page:page, keyword: $("#ip_note_keyword").val()}, "buyer/note_load").done(function(res) {
		$("#tb_notes_body").html(res);
		$(".btn_note_page").on('click',(function(e) {note_load($("#company_id").val(), $(this).val());}));
		$("#btn_search_note").on('click',(function(e) {note_load($("#company_id").val(), 1);}));
		$('#ip_note_keyword').keyup(function(event) {
			if (event.keyCode === 13 || event.which === 13) note_load($("#company_id").val(), 1);
		});
		
		$(".btn_note_delete").on('click',(function(e) {note_delete($(this).val());}));
	});
}

function note_add(dom){
	ajax_form(dom, "buyer/note_add").done(function(res) {
		swal(res.type, res.msg);
		if (res.type == "success"){
			$('#ip_note_keyword').val("");
			note_load($("#company_id").val(), 1);
			document.getElementById("form_note_add").reset();
			$('#md_note_add').modal('hide');
		}
	});
}

function note_delete(id){
	ajax_simple_warning({id:id}, "buyer/note_delete", "Are you sure to delete?").done(function(res) {
		swal(res.type, res.msg);
		$('#ip_note_keyword').val("");
		note_load($("#company_id").val(), 1);
	});
}

$(document).ready(function() {
	//register
	$("#form_buyer_register").submit(function(e) {e.preventDefault(); buyer_register(this);});
	
	//detail - company
	$("#form_buyer_update").submit(function(e) {e.preventDefault(); buyer_update(this);});
	$("#btn_buyer_edit").on('click',(function(e) {set_buyer_update_form(true);}));
	$("#btn_buyer_edit_cancel").on('click',(function(e) {set_buyer_update_form(false);}));
	
	//detail - note
	$("#form_note_add").submit(function(e) {e.preventDefault(); note_add(this);});
	note_load($("#company_id").val(), 1);
	
	//detail - person
	$("#form_person_register").submit(function(e) {e.preventDefault(); person_register(this);});
	$("#btn_person_add").on('click',(function(e) {$("#form_person_register").submit();}));
	$(".btn_person_delete").on('click',(function(e) {person_delete($(this).val());}));
});