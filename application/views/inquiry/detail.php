<div class="row">
	<div class="col-md-6 col-sm-12">
		<h4>Inquiry Detail</h4>
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
					<div class="form-group col-md-12 mb-0">
						<label><strong>Person in Charge</strong></label>
						<table class="table mb-0">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Name</th>
									<th scope="col">Position</th>
									<th scope="col">Mobile</th>
									<th scope="col">Email</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($people as $i => $item){ ?>
								<tr>
									<th scope="row"><?= $i + 1 ?></th>
									<td><?= $item->name ?></td>
									<td><?= $item->position ?></td>
									<td><?= $item->mobile ?></td>
									<td><?= $item->email ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row mt-3">
	<div class="col-md-12">
		<div class="card mb-3">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h5 class="mb-0">General Information</h5>
			</div>
			<div class="card-body">
				<div class="form-row">
					<input type="hidden" name="id" value="<?= $inquiry->id ?>">
					<div class="form-group col-md-3">
						<label><strong>Issue Date</strong></label>
						<div><?= date("Y-m-d", strtotime($inquiry->registed_at)) ?></div>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Last Update</strong></label>
						<div><?= date("Y-m-d", strtotime($inquiry->updated_at)) ?></div>
					</div>
					<div class="form-group col-md-6">
						<label><strong>Destination Port / Airport</strong></label>
						<div><?= $company->country." - ".$inquiry->port ?></div>
					</div>
				</div>
				<form id="form_update_inquiry">
					<input type="hidden" name="id" value="<?= $inquiry->id ?>">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label><strong>Incoterm</strong></label>
							<select class="custom-select" name="incoterm_id">
								<option value="">Choose...</option>
								<?php foreach($inquiry->incoterms as $item){
								if($item->id == $inquiry->incoterm_id) $s = "selected"; else $s = ""; ?>
								<option value="<?= $item->id ?>" <?= $s ?>><?= $item->incoterm_short." - ".$item->incoterm ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label><strong>Payment Term</strong></label>
							<select class="custom-select" name="payment_term_id">
								<option value="">Choose...</option>
								<?php foreach($payment_terms as $item){
									if($item->id == $inquiry->payment_term_id) $s = "selected"; else $s = ""; ?>
								<option value="<?= $item->id ?>" <?= $s ?>><?= $item->payment_term ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label><strong>Handling Cost, USD</strong></label>
							<input type="text" class="form-control" name="handling_cost" value="<?= $inquiry->handling_cost ?>">
						</div>
						<div class="form-group col-md-6">
							<label><strong>Insurance & Freight Cost, USD</strong></label>
							<input type="text" class="form-control" name="freight_insurance_cost" value="<?= $inquiry->freight_insurance_cost ?>">
						</div>
						<div class="form-group col-md-12 pt-3">
							<button class="btn btn-primary" type="submit">Save Inquiry Data</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row mt-3">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h5 class="mb-0">Products</h5>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-8 col-sm-12">
						<form id="form_update_price">
							<input type="hidden" name="inquiry_id" value="<?= $inquiry->id ?>">
							<table class="table mb-0">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Product</th>
										<th scope="col">Remark</th>
										<th scope="col">Qty</th>
										<th scope="col"><small>USD</small><br/>Price</th>
										<th scope="col"><small>USD</small><br/>Subtotal</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($products as $i => $item){ ?>
									<tr>
										<td class="align-middle"><?= number_format($i + 1) ?></td>
										<td class="align-middle"><?= $item->product->product ?></td>
										<td class="align-middle"><?= $item->remark ?></td>
										<td class="align-middle"><?= number_format($item->qty) ?></td>
										<td class="align-middle">
											<input type="hidden" class="inq_prod_qty" value="<?= $item->qty ?>">
											<input type="hidden" class="inq_prod_id" value="<?= $item->id ?>" name="prod[<?= $item->id ?>][id]">
											<input type="text" class="form-control prod_uprice" value="<?= $item->unit_price ?>" 
												name="prod[<?= $item->id ?>][unit_price]" style="width: 100px;">
										</td>
										<td class="align-middle" id="subtotal_<?= $item->id ?>">
											<?= number_format($item->unit_price * $item->qty, 2) ?>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
							<button class="btn btn-primary" type="submit">Save Price</button>
						</form>
					</div>
					<div class="col-md-4 col-sm-12">
						<h5 id="price_history_model">Price History</h5>
						<ul class="list-group" id="price_history_list">
							<li class="list-group-item text-info">Select price textbox to see price history.</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row mt-5">
	<div class="col-md-12 text-center">
		<button type="button" class="btn btn-primary btn-lg" id="btn_make_proforma" value="<?= $inquiry->id ?>">Make Proforma</button>
		<button type="button" class="btn btn-success btn-lg" id="btn_confirm_sale" value="<?= $inquiry->id ?>">Confirm Sale</button>
	</div>
</div>
<input type="hidden" id="inquiry_id" value="<?= $inquiry->id ?>">