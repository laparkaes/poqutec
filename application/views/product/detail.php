<div class="row">
	<div class="col-md-6 col-sm-12">
		<h4>Product Detail</h4>
	</div>
	<div class="col-md-6 col-sm-12 text-right">
		<a type="button" class="btn btn-outline-primary" href="<?= base_url() ?>product/list">Back to List</a>
	</div>
</div>
<div class="row mt-3">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h5 class="mb-0">Product Information</h5>
				<div>
					<button type="button" class="btn btn-primary" id="btn_product_edit">Edit</button>
					<button type="button" class="btn btn-outline-danger d-none" id="btn_product_edit_cancel">Cancel</button>
				</div>
			</div>
			<div class="card-body">
				<form class="form-row" id="form_product_update">
					<input type="hidden" name="id" value="<?= $product->id ?>">
					<div class="form-group col-md-6 col-sm-12">
						<label for="sl_category">Category</label>
						<select id="sl_category" class="form-control" name="category_id" required disabled>
							<option value="" selected>Choose...</option>
							<?php foreach($categories as $item){
								if ($item->id == $product->category_id) $s = "selected"; else $s = ""; ?>
							<option value="<?= $item->id ?>" <?= $s ?>><?= $item->category ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group col-md-6 col-sm-12">
						<label for="in_price">Price</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-in_price">USD</span>
							</div>
							<input type="number" class="form-control" id="in_price" name="price" 
								value="<?= $product->price ?>" required readonly>
						</div>
					</div>
					<div class="form-group col-md-12">
						<label for="in_product">Product</label>
						<input type="text" class="form-control" id="in_product" name="product" 
							value="<?= $product->product ?>" required readonly>
					</div>
					<div class="form-group col-md-12">
						<label for="in_remark">Remark</label>
						<textarea class="form-control" id="in_remark" rows="3" name="remark" readonly><?= $product->remark ?></textarea>
					</div>
					<div class="form-group col-md-12">
						<button type="submit" class="btn btn-primary d-none mt-3" id="btn_product_update">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-12">
		<div class="card mb-3">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h5 class="mb-0">Included Products</h5>
				<div>
					<button type="button" class="btn btn-primary" id="btn_inc_product_edit">Edit</button>
					<button type="button" class="btn btn-outline-info inc_product_edit_elem d-none" id="btn_inc_product_finish">Finish</button>
				</div>
			</div>
			<div class="card-body" style="height: 300px; overflow-y: auto;">
				<table class="table mb-0">
					<thead>
						<tr>
							<th scope="col">Product</th>
							<th scope="col">Qty</th>
							<th scope="col" class="text-right inc_product_edit_elem d-none">
								<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_inc_products">
									<i class="fas fa-plus"></i>
								</button>
							</th>
						</tr>
					</thead>
					<tbody id="tb_inc_products">
						<?php foreach($inc_products as $item){ ?>
						<tr>
							<td class="align-middle">
								<?= $item->product ?>
							</td>
							<td class="align-middle">
								<?= number_format($item->qty) ?>
							</td>
							<td class="align-middle text-right d-none inc_product_edit_elem">
								<button type="button" class="btn btn-outline-danger btn-sm btn_delete_inc_product" value="<?= $item->id ?>">
									<i class="fas fa-trash"></i>
								</button>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Product select modal -->
<div class="modal fade" id="modal_inc_products" tabindex="-1" role="dialog" aria-labelledby="productsLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="productsLabel">Add Included Product</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-row" id="form_add_inc_product">
					<input type="hidden" name="parent_id" value="<?= $product->id ?>" readonly>
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
						<select class="form-control" id="sl_inc_product_id" name="product_id" required>
							<option value="">Choose...</option>
						</select>
					</div>
					<div class="form-group col-md-6">
						<label for="sl_inc_product_qty">Quantity</label>
						<input type="number" class="form-control" id="sl_inc_product_qty" value="1" name="qty" required>
					</div>
					<div class="form-group col-md-12 text-right pt-3">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>