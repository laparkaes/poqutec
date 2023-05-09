<div class="row">
	<div class="col-md-6 col-sm-12">
		<h4>New Inquiry</h4>
	</div>
	<div class="col-md-6 col-sm-12 text-right">
		<a type="button" class="btn btn-outline-primary" href="<?= base_url() ?>inquiry/list">Back to List</a>
	</div>
</div>
<div class="row mt-3">
	<div class="col">
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h5 class="mb-0">Buyer Information</h5>
			</div>
			<div class="card-body">
				<div class="form-row">
					<div class="form-group col-md-3">
						<label>Country</label>
						<input type="text" class="form-control bg-white" value="<?= $company->country ?>" readonly>
					</div>
					<div class="form-group col-md-3">
						<label>Type</label>
						<input type="text" class="form-control bg-white" value="<?= $company->type ?>" readonly>
					</div>
					<div class="form-group col-md-6">
						<label>Buyer</label>
						<input type="text" class="form-control bg-white" value="<?= $company->company ?>" readonly>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row mt-3">
	<div class="col">
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h5 class="mb-0">Inquiry Information</h5>
			</div>
			<div class="card-body">
				<form id="form_add_inquiry">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label class="mr-5">Incoterm</label>
							<?php foreach($incoterms as $item){ ?>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" id="rd_incoterm<?= $item->id ?>" name="incoterm[]" class="custom-control-input" value="<?= $item->id ?>">
								<label class="custom-control-label" for="rd_incoterm<?= $item->id ?>"><?= $item->incoterm_short ?></label>
							</div>
							<?php } ?>
						</div>
						<div class="form-group col-md-12">
							<label>Products</label>
							<table class="table table-sm">
								<thead>
									<tr>
										<th scope="col">Category</th>
										<th scope="col">Product</th>
										<th scope="col">Qty</th>
										<th scope="col">Remark</th>
										<th scope="col" class="text-right">
											<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_products">
												<i class="fas fa-plus"></i>
											</button>
										</th>
									</tr>
								</thead>
								<tbody id="tb_add_inq_products"></tbody>
							</table>
						</div>
						<div class="form-group col-md-12">
							<button type="submit" class="btn btn-primary mt-3">Register</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

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
						<label for="sl_add_inq_category">Category</label>
						<select id="sl_add_inq_category" class="form-control">
							<option value="" selected>Choose...</option>
							<?php foreach($categories as $item){ ?>
							<option value="<?= $item->id ?>"><?= $item->category ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group col-md-12">
						<label for="sl_add_inq_product_id">Product</label>
						<select id="sl_add_inq_product_id" class="form-control">
							<option value="">Choose...</option>
						</select>
					</div>
					<div class="form-group col-md-6">
						<label for="inp_add_inq_product_qty">Quantity</label>
						<input type="number" class="form-control" id="inp_add_inq_product_qty" value="1">
					</div>
					<div class="form-group col-md-12">
						<label for="inp_add_inq_product_remark">Remark</label>
						<input type="text" class="form-control" id="inp_add_inq_product_remark">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="btn_add_product">Add</button>
			</div>
		</div>
	</div>
</div>