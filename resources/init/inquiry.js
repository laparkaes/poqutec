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

function update_inquiry(dom){
	ajax_form(dom, "inquiry/update_inquiry").done(function(res) {
		 swal(res.type, res.msg);
	});
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

$(document).ready(function() {
	//new
	$("#form_add_inquiry").submit(function(e) {e.preventDefault(); add_inquiry(this);});
	$("#sl_add_inq_category").change(function() {load_products($(this).val());});
	$("#btn_add_product").on('click',(function(e) {add_product_to_list();}));
	
	//detail
	$("#form_update_inquiry").submit(function(e) {e.preventDefault(); update_inquiry(this);});
	$("#form_update_price").submit(function(e) {e.preventDefault(); update_price(this);});
	$(".prod_uprice").on("focus", function() {load_price_history(this);});
	$(".prod_uprice").on("keyup", function() {set_subtotal(this);});
	$(".prod_uprice").change(function() {set_subtotal(this);});
	$("#btn_make_proforma").on('click',(function(e) {make_proforma($(this).val());}));
	$("#btn_confirm_sale").on('click',(function(e) {confirm_sale($(this).val());}));
});