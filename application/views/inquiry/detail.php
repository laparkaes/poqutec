<div class="row">
	<div class="col-md-6 col-sm-12">
		<h4>Inquiry Detail</h4>
	</div>
	<div class="col-md-6 col-sm-12 text-right">
		<a type="button" class="btn btn-outline-primary" href="<?= base_url() ?>inquiry/list">Back to List</a>
	</div>
</div>
<div class="row mt-3">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h5 class="mb-0">Buyer</h5>
			</div>
			<div class="card-body" style="height: 400px; overflow-y: auto;">
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="in_inquiry">Company</label>
						<input type="text" class="form-control" value="<?= $company->company ?>" readonly>
					</div>
					<div class="form-group col-md-6">
						<label for="in_inquiry">Country</label>
						<input type="text" class="form-control" value="<?= $company->country ?>" readonly>
					</div>
					<div class="form-group col-md-6">
						<label for="in_inquiry">Type</label>
						<input type="text" class="form-control" value="<?= $company->type ?>" readonly>
					</div>
					<div class="form-group col-md-12">
						<label for="in_inquiry">Person in Charge</label>
						<table class="table table-sm mb-0">
							<thead>
								<tr>
									<th scope="col">Name</th>
									<th scope="col">Mobile</th>
									<th scope="col">Email</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($people as $item){ ?>
								<tr>
									<td class="align-middle"><?= $item->name ?><br/><small><?= $item->position ?></small></td>
									<td class="align-middle"><?= $item->mobile ?></td>
									<td class="align-middle"><?= $item->email ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h5 class="mb-0">General Information</h5>
			</div>
			<div class="card-body" style="height: 400px; overflow-y: auto;">
				<div class="form-row" id="form_inquiry_update">
					<input type="hidden" name="id" value="<?= $inquiry->id ?>">
					<div class="form-group col-md-6">
						<label for="inp_date">Date</label>
						<input type="text" class="form-control" value="<?= $inquiry->registed_at ?>" id="inp_date" readonly>
					</div>
					<div class="form-group col-md-6">
						<label for="inp_updated">Last Update</label>
						<input type="text" class="form-control" value="<?= $inquiry->updated_at ?>" id="inp_updated" readonly>
					</div>
					<div class="form-group col-md-6 col-sm-12">
						<label for="inp_incoterms">Incoterms</label>
						<input type="text" class="form-control" value="<?= $inquiry->incoterms ?>" id="inp_incoterms" readonly>
					</div>
					<div class="form-group col-md-6 col-sm-12">
						<label for="inp_port">Port</label>
						<input type="text" class="form-control" value="<?= $inquiry->port ?>" id="inp_port" readonly>
					</div>
					<div class="form-group col-md-6 col-sm-12">
						<label for="inp_handling_cost">Handling Cost, USD</label>
						<div class="input-group">
							<input type="text" class="form-control" id="inp_handling_cost" value="<?= $inquiry->handling_cost ?>">
							<div class="input-group-append">
								<button class="btn btn-primary" id="btn_handling_save" type="button">Save</button>
							</div>
						</div>
					</div>
					<div class="form-group col-md-6 col-sm-12">
						<label for="inp_freight_insurance">Freight & Insurance Cost, USD</label>
						<div class="input-group">
							<input type="text" class="form-control" id="inp_freight_insurance" value="<?= $inquiry->freight_insurance_cost ?>">
							<div class="input-group-append">
								<button class="btn btn-primary" id="btn_freight_insurance_save" type="button">Save</button>
							</div>
						</div>
					</div>
					<div class="form-group col-md-12 col-sm-12">
						<label for="sl_payment_term_id">Payment Term</label>
						<div class="input-group">
							<select class="custom-select" id="sl_payment_term_id">
								<option value="">Choose...</option>
								<?php foreach($payment_terms as $item){
									if($item->id == $inquiry->payment_term_id) $s = "selected"; else $s = ""; ?>
								<option value="<?= $item->id ?>" <?= $s ?>><?= $item->payment_term ?></option>
								<?php } ?>
							</select>
							<div class="input-group-append">
								<button class="btn btn-primary" id="btn_payment_term_save" type="button">Save</button>
							</div>
						</div>
					</div>
				</div>
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
						<h5 class="d-flex justify-content-between">
							<span>Price History</span><span id="price_history_model"></span>
						</h5>
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