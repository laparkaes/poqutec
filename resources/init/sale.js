function save_sale_data(dom){
	ajax_form(dom, "sale/save_sale_data").done(function(res) {
		swal(res.type, res.msg);
	});
}

function add_package(dom){
	ajax_form(dom, "sale/add_package").done(function(res) {
		swal_redirection(res.type, res.msg, window.location.href);
	});
}

function delete_package(pack_id){
	ajax_simple_warning({id: pack_id}, "sale/delete_package", "Are you sure to delete selected package?").done(function(res) {
		swal_redirection(res.type, res.msg, window.location.href);
	});
}

function calculate_volume(){
	var l = parseFloat($("#inp_length").val());
	var w = parseFloat($("#inp_width").val());
	var h = parseFloat($("#inp_height").val());
	
	if (isNaN(l) || isNaN(w) || isNaN(h)) return;
	else{
		var vol = (l/1000) * (w/1000) * (h/1000); //MM then calculate CBM
		$("#inp_volume").val(vol.toFixed(2));
	}
	
}

$(document).ready(function() {
	//detail
	datepicker_min("inp_etd");
	datepicker_min("inp_eta");
	$("#form_save_sale_data").submit(function(e) {e.preventDefault(); save_sale_data(this);});
	$("#form_add_package").submit(function(e) {e.preventDefault(); add_package(this);});
	$(".btn_delete_package").on('click',(function(e) {delete_package($(this).val());}));
	$(".c_vol").on("keyup", function() {calculate_volume();});
});