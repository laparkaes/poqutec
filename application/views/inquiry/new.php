<div class="row">
	<div class="col-md-6 col-sm-12">
		<h4>New Inquiry</h4>
	</div>
	<div class="col-md-6 col-sm-12 text-right">
		<a type="button" class="btn btn-outline-primary" href="<?= base_url() ?>inquiry/list">Back to List</a>
	</div>
</div>
<div class="row mt-3">
	<div class="col-md-12">
		<div class="card mb-3">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h5 class="mb-0">Buyer</h5>
			</div>
			<div class="card-body">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label><strong>Company</strong></label>
						<div><?= $company->company ?></div>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Country</strong></label>
						<div><?= $company->country ?></div>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Type</strong></label>
						<div><?= $company->type ?></div>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Tel</strong></label>
						<div><?= $company->tel ?></div>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Fax</strong></label>
						<div><?= $company->fax ?></div>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Main Email</strong></label>
						<div><?= $company->main_email ?></div>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Web</strong></label>
						<div><?= $company->web ?></div>
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
					<input type="hidden" name="company_id" value="<?= $company->id ?>">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label><strong>Incoterm</strong></label>
							<div class="form-control">
								<?php foreach($incoterms as $item){ ?>
								<div class="custom-control custom-checkbox custom-control-inline">
									<input type="checkbox" id="rd_incoterm<?= $item->id ?>" name="incoterm[]" class="custom-control-input" value="<?= $item->id ?>">
									<label class="custom-control-label" for="rd_incoterm<?= $item->id ?>"><?= $item->incoterm_short ?></label>
								</div>
								<?php } ?>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label><strong>Arrival Port / Airport</strong></label>
							<input type="text" class="form-control" name="port">
						</div>
						<div class="form-group col-md-12">
							<label><strong>Person in Charge</strong></label>
							<table class="table">
								<thead>
									<tr>
										<th scope="col"></th>
										<th scope="col">Name</th>
										<th scope="col">Position</th>
										<th scope="col">Mobile</th>
										<th scope="col">Email</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($people as $item){ ?>
									<tr>
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" name="people[]" 
													id="customCheck<?= $item->id ?>" value="<?= $item->id ?>">
												<label class="custom-control-label" for="customCheck<?= $item->id ?>"></label>
											</div>
										</td>
										<td><?= $item->name ?></td>
										<td><?= $item->position ?></td>
										<td><?= $item->mobile ?></td>
										<td><?= $item->email ?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<div class="form-group col-md-12">
							<label><strong>Product List</strong></label>
							<table class="table">
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
						<label for="inp_add_inq_product_remark">Remark (Applicable machine, etc...)</label>
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