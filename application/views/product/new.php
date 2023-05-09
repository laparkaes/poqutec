<div class="row">
	<div class="col-md-6 col-sm-12">
		<h4>New Product</h4>
	</div>
	<div class="col-md-6 col-sm-12 text-right">
		<a type="button" class="btn btn-outline-primary" href="<?= base_url() ?>product/list">Back to List</a>
	</div>
</div>
<form id="form_product_register" class="row mt-3">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<h5 class="mb-0">Product Information</h5>
			</div>
			<div class="card-body">
				<div class="form-row">
					<div class="form-group col-md-6 col-sm-12">
						<label for="sl_category">Category</label>
						<select id="sl_category" class="form-control" name="p[category_id]" required>
							<option value="" selected>Choose...</option>
							<?php foreach($categories as $item){ ?>
							<option value="<?= $item->id ?>"><?= $item->category ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group col-md-6 col-sm-12">
						<label for="in_price">Price</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-in_price">USD</span>
							</div>
							<input type="number" class="form-control" id="in_price" name="p[price]" required>
						</div>
					</div>
					<div class="form-group col-md-12">
						<label for="in_product">Product</label>
						<input type="text" class="form-control" id="in_product" name="p[product]" required>
					</div>
					<div class="form-group col-md-12">
						<label for="in_remark">Remark</label>
						<textarea class="form-control" id="in_remark" rows="3" name="p[remark]"></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<h5 class="mb-0">Included Products</h5>
			</div>
			<div class="card-body">
				<table class="table table-sm">
					<thead>
						<tr>
							<th scope="col">Product</th>
							<th scope="col">Qty</th>
							<th scope="col" class="text-right">
								<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_products">
									<i class="fas fa-plus"></i>
								</button>
							</th>
						</tr>
					</thead>
					<tbody id="tb_inc_products">
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<button type="submit" class="btn btn-primary mt-3">Register</button>
	</div>
</form>

<!-- Product select modal -->
<div class="modal fade" id="modal_products" tabindex="-1" role="dialog" aria-labelledby="productsLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="productsLabel">Product Selection</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="sl_inc_category">Category</label>
						<select id="sl_inc_category" class="form-control">
							<option value="" selected>Choose...</option>
							<?php foreach($categories as $item){ ?>
							<option value="<?= $item->id ?>"><?= $item->category ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group col-md-12">
						<label for="sl_inc_product_id">Product</label>
						<select class="form-control" id="sl_inc_product_id">
							<option value="">Choose...</option>
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="btn_inc_product">Select</button>
			</div>
		</div>
	</div>
</div>