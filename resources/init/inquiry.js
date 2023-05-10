function set_product_update_form(is_edit){
	if (is_edit == true){
		$("#form_product_update input").removeAttr("readonly");
		$("#form_product_update textarea").removeAttr("readonly");
		$("#form_product_update select").prop("disabled", false);
		$("#btn_product_edit").addClass("d-none");
		$("#btn_product_edit_cancel").removeClass("d-none");
		$("#btn_product_update").removeClass("d-none");
	}else{
		$("#form_product_update input").attr("readonly", true);
		$("#form_product_update textarea").attr("readonly", true);
		$("#form_product_update select").prop("disabled", true);
		$("#btn_product_edit").removeClass("d-none");
		$("#btn_product_edit_cancel").addClass("d-none");
		$("#btn_product_update").addClass("d-none");
	}
}

function set_inc_product_edit_btns(is_edit){
	if (is_edit == true){
		$(".inc_product_edit_elem").removeClass("d-none");
		$("#btn_inc_product_edit").addClass("d-none");
	}else{
		$(".inc_product_edit_elem").addClass("d-none");
		$("#btn_inc_product_edit").removeClass("d-none");
	}
}

function product_update(dom){
	ajax_form(dom, "product/update").done(function(res) {
		swal(res.type, res.msg);
		if (res.type == "success") set_product_update_form(false);
	});
}

var prod_counter = 1;
function add_inc_product(product_id){
	if (product_id == "") swal("error", "You should choose a product.");
	else{
		$("#tb_inc_products").append('<tr id="tr_inc_product_' + product_id + '"><td class="align-middle">' + $("#sl_inc_product_id option[value=" + product_id + "]").text() + '<input type="hidden" name="p_inc[' + prod_counter + '][product_id]" value="' + product_id + '"></td><td class="align-middle"><input type="number" class="form-control" value="1" min="1" style="max-width:100px;" name="p_inc[' + prod_counter + '][qty]"></td><td class="align-middle text-right "><button type="button" class="btn btn-outline-danger btn-sm" id="btn_remove_inc_prod_' + product_id + '" value="' + product_id + '"><i class="fas fa-trash"></i></button></td></tr>');
		$("#btn_remove_inc_prod_" + product_id).on('click',(function(e) {$("#tr_inc_product_" + product_id).remove();}));
		prod_counter++;
		swal("success", "Product has been added to the list.");
	}
}

function set_inc_product_list(products){
	$("#tb_inc_products").html("");
	$.each(products, function(index, item) {
		$("#tb_inc_products").append('<tr><td class="align-middle">' + item.product + '</td><td class="align-middle">' + item.qty + '</td><td class="align-middle text-right inc_product_edit_elem"><button type="button" class="btn btn-outline-danger btn-sm btn_delete_inc_product" value="' + item.id + '"><i class="fas fa-trash"></i></button></td></tr>');
	});
	$(".btn_delete_inc_product").on('click',(function(e) {delete_inc_product($(this).val());}));
}

function add_inc_product_form(dom){
	ajax_form(dom, "product/add_inc_product").done(function(res) {
		swal(res.type, res.msg);
		if (res.type == "success") set_inc_product_list(res.products);
	});
}

function delete_inc_product(inc_product_id){
	var warning_msg = "Are you sure you want to delete the selected product?";
	ajax_simple_warning({id: inc_product_id}, "product/delete_inc_product", warning_msg).done(function(res) {
		swal(res.type, res.msg);
		if (res.type == "success") set_inc_product_list(res.products);
	});
}

/////////////////////////////////////////////////

function load_products(category_id){
	ajax_simple({category_id:category_id}, "product/load_products").done(function(res) {
		$("#sl_add_inq_product_id").html("");
		$("#sl_add_inq_product_id").append('<option value="">Choose...</option>');
		$.each(res.products, function(index, item) {
			$("#sl_add_inq_product_id").append('<option value="' + item.id + '">' + item.product + '</option>');
		});
	});
}

function add_product_to_list(){
	var product_id = $("#sl_add_inq_product_id").val();
	var product_name = $("#sl_add_inq_product_id").val();
	var qty = $("#inp_add_inq_product_qty").val();
	var remark = $("#inp_add_inq_product_remark").val();
	
	if ($(".inq_prod_row_" + product_id).length > 0) swal("error", "product already added to list.");
	else{
		if (product_id != ""){
			$("#tb_add_inq_products").append('<tr class="inq_prod_row_' + product_id + '"><input type="hidden" name=prods[' + product_id + '][product_id] value="' + product_id + '"><input type="hidden" name="prods[' + product_id + '][qty]" value="' + qty + '"><input type="hidden" name="prods[' + product_id + '][remark]" value="' + remark + '"><td>' + $("#sl_add_inq_category option:selected").text() + '</td><td>' + $("#sl_add_inq_product_id option:selected").text() + '</td><td>' + qty + '</td><td>' + remark + '</td><td class="text-right"><button type="button" class="btn btn-outline-danger btn-sm" id="btn_remove_prod_inq_' + product_id + '" value="' + product_id + '"><i class="fas fa-trash"></i></button></td></tr>');
			
			//initial form
			$("#sl_add_inq_category").val("");
			$("#sl_add_inq_product_id").val("");
			$("#inp_add_inq_product_qty").val("1");
			$("#inp_add_inq_product_remark").val("");
			
			//remove from list
			$("#btn_remove_prod_inq_" + product_id).on('click',(function(e) {$(".inq_prod_row_" + product_id).remove();}));
			
			//close modal
			$('#modal_products').modal('hide');
		}else swal("error", "Choose a product.");
	}
}

function add_inquiry(dom){
	ajax_form(dom, "inquiry/register").done(function(res) {
		swal_redirection(res.type, res.msg, res.move_to);
	});
}

function payment_term_save(){
	var payment_term_id = $("#sl_payment_term_id").val();
	if (payment_term_id == "") swal("error", "Choose a payment term.");
	else{
		var data = {id: $("#inquiry_id").val(), payment_term_id: payment_term_id};
		ajax_simple(data, "inquiry/payment_term_save").done(function(res) {
			 swal(res.type, res.msg);
		});
	}
}

function freight_insurance_save(){
	var freight_insurance = $("#inp_freight_insurance").val();
	if (freight_insurance == "") swal("error", "Enter freight & insurance cost.");
	else{
		var data = {id: $("#inquiry_id").val(), freight_insurance_cost: freight_insurance};
		ajax_simple(data, "inquiry/freight_insurance_save").done(function(res) {
			 swal(res.type, res.msg);
		});
	}
}

function load_price_history(dom){
	var data = {inq_prod_id: $(dom).parent().find(".inq_prod_id").val()};
	ajax_simple(data, "inquiry/load_price_history").done(function(res) {
		$("#his_tbody").html("");
		$("#his_tbody").append('<tr class="bg-dark text-light"><td class="align-middle">Normal Price</td><td class="align-middle">-</td><td class="align-middle">' + res.product.price + '</td></tr>');
		$.each(res.products, function(index, item) {
			$("#his_tbody").append('<tr><td class="align-middle">' + item.registed_at + '</td><td class="align-middle">' + item.qty + '</td><td class="align-middle">' + item.unit_price + '</td></tr>');
		});
		$("#his_prod_name").html(res.product.product);
	});
}

function nf(num){//number format
	return parseFloat(num).toLocaleString('es-US', {maximumFractionDigits: 2, minimumFractionDigits: 2});
}

function set_subtotal(dom){
	var id = $(dom).parent().find(".inq_prod_id").val();
	var qty = $(dom).parent().find(".inq_prod_qty").val();
	var price = $(dom).val();
	
	$("#subtotal_" + id).html(nf(qty * price));
}

function update_price(dom){
	ajax_form(dom, "inquiry/update_price").done(function(res) {
		swal_redirection(res.type, res.msg, window.location.href);
	});
}

$(document).ready(function() {
	//new
	$("#form_add_inquiry").submit(function(e) {e.preventDefault(); add_inquiry(this);});
	$("#sl_add_inq_category").change(function() {load_products($(this).val());});
	$("#btn_add_product").on('click',(function(e) {add_product_to_list();}));
	
	//detail
	$("#form_update_price").submit(function(e) {e.preventDefault(); update_price(this);});
	$("#btn_payment_term_save").on('click',(function(e) {payment_term_save();}));
	$("#btn_freight_insurance_save").on('click',(function(e) {freight_insurance_save();}));
	$(".prod_uprice").on("focus", function() {load_price_history(this);});
	$(".prod_uprice").on("keyup", function() {set_subtotal(this);});
	$(".prod_uprice").change(function() {set_subtotal(this);});
	
	
	
	
	
	//detail - company
	$("#form_product_update").submit(function(e) {e.preventDefault(); product_update(this);});
	$("#btn_product_edit").on('click',(function(e) {set_product_update_form(true);}));
	$("#btn_product_edit_cancel").on('click',(function(e) {set_product_update_form(false);}));
	
	//detail - included product
	$("#form_add_inc_product").submit(function(e) {e.preventDefault(); add_inc_product_form(this);});
	$(".btn_delete_inc_product").on('click',(function(e) {delete_inc_product($(this).val());}));
	$("#btn_inc_product_edit").on('click',(function(e) {set_inc_product_edit_btns(true);}));
	$("#btn_inc_product_finish").on('click',(function(e) {set_inc_product_edit_btns(false);}));
});