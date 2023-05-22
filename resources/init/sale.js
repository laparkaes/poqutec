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
	if (freight_insurance == "0") swal("error", "Enter freight & insurance cost.");
	else{
		var data = {id: $("#inquiry_id").val(), freight_insurance_cost: freight_insurance};
		ajax_simple(data, "inquiry/freight_insurance_save").done(function(res) {
			 swal(res.type, res.msg);
		});
	}
}

function handling_save(){
	var handling = $("#handling").val();
	if (handling == "0") swal("error", "Enter handling cost.");
	else{
		var data = {id: $("#inquiry_id").val(), handling_cost: handling};
		ajax_simple(data, "inquiry/handling_save").done(function(res) {
			 swal(res.type, res.msg);
		});
	}
}

function load_price_history(dom){
	var data = {inq_prod_id: $(dom).parent().find(".inq_prod_id").val()};
	ajax_simple(data, "inquiry/load_price_history").done(function(res) {
		$("#price_history_model").html(res.product.product);
		$("#price_history_list").html("");
		
		$("#price_history_list").append('<li class="list-group-item d-flex justify-content-between list-group-item-primary"><span>Formal Price</span><span>USD ' + res.product.price + '</span></li>');
		
		if (res.products.length > 0){
			$.each(res.products, function(index, item) {
				$("#price_history_list").append('<li class="list-group-item d-flex justify-content-between"><div>' + item.registed_at + '</div><div class="text-right"><span>USD ' + item.unit_price + '</span><br/><small>' + item.qty + ' Units<small></div></li>');
			});
		}else{
			$("#price_history_list").append('<li class="list-group-item text-danger">No price history.</li>');
		}
	});
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

function make_proforma(){
	swal("warning", "To be developed.<br/>This will make a PDF Proforma to be downloaded.");
}

function confirm_sale(inquiry_id){
	var msg = "Are you sure you want to create a sales record based on this inquiry?";
	ajax_simple_warning({id: inquiry_id}, "inquiry/confirm_sale", msg).done(function(res) {
		swal_redirection(res.type, res.msg, res.move_to);
	});
}

//////////////////////////////////////////// start from here

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