<div class="row">
	<div class="col-md-6 col-sm-12">
		<h4>Sale Detail</h4>
	</div>
	<div class="col-md-6 col-sm-12 text-right">
		<a type="button" class="btn btn-outline-primary" href="<?= base_url() ?>sale/list">Back to List</a>
	</div>
</div>
<div class="row mt-3">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h5 class="mb-0">Sale Data</h5>
			</div>
			<div class="card-body">
				<form id="form_save_sale_data">
					<input type="hidden" name="id" value="<?= $sale->id ?>">
					<div class="form-row">
						<div class="form-group col-md-3">
							<label for="inp_etd">ETD, Estimated Time of Departure</label>
							<input type="text" class="form-control" id="inp_etd" name="etd" value="<?= $sale->etd ?>">
						</div>
						<div class="form-group col-md-3">
							<label for="inp_eta">ETA, Estimated Time of Arrival</label>
							<input type="text" class="form-control" id="inp_eta" name="eta" value="<?= $sale->eta ?>">
						</div>
						<div class="form-group col-md-6">
							<label for="inp_bl">BL / AWB Number</label>
							<input type="text" class="form-control" id="inp_bl" name="bl_awb" value="<?= $sale->bl_awb ?>">
						</div>
						<div class="form-group col-md-12 pt-3">
							<button class="btn btn-primary" type="submit">Save Sale Data</button>
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
				<h5 class="mb-0">Packing</h5>
				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_add_package">
					<i class="fas fa-plus mr-2"></i>Add Package
				</button>
			</div>
			<div class="card-body">
				<div class="form-row">
					<div class="form-group col-md-12 mb-0">
						<table class="table mb-0">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Name</th>
									<th scope="col">Items</th>
									<th scope="col"><small>KGS</small><br/>Net Weight</th>
									<th scope="col"><small>KGS</small><br/>Gross Weight</th>
									<th scope="col"><small>L x W x H, MM</small><br/>Dimension</th>
									<th scope="col"><small>CBM</small><br/>Volume</th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($packages as $i => $item){ ?>
								<tr>
									<th scope="row"><?= number_format($i + 1) ?></th>
									<td><?= $item->name ?></td>
									<td>
										<?php foreach($item->products as $j => $pr){ ?>
										<div class="mb-1">
											<div><?= $pr->category ?></div>
											<div><?= $pr->product ?></div>
											<div><?= $pr->qty." units" ?></div>
										</div>
										<?php } ?>
									</td>
									<td><?= number_format($item->net_weight, 2) ?></td>
									<td><?= number_format($item->gross_weight, 2) ?></td>
									<td>
										<?= number_format($item->length)." x ".number_format($item->width)." x ".number_format($item->height) ?>
									</td>
									<td><?= number_format($item->volume, 2) ?></td>
									<td class="text-right">
										<button type="button" class="btn btn-danger btn-sm btn_delete_package" value="<?= $item->id ?>">
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
						<div><?= $buyer->company ?></div>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Country</strong></label>
						<div><?= $buyer->country ?></div>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Type</strong></label>
						<div><?= $buyer->type ?></div>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Tel</strong></label>
						<div><?= $buyer->tel ?></div>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Fax</strong></label>
						<div><?= $buyer->fax ?></div>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Main Email</strong></label>
						<div><?= $buyer->main_email ?></div>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Web</strong></label>
						<div><?= $buyer->web ?></div>
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
								<?php foreach($buyer->people as $i => $item){ ?>
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
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h5 class="mb-0">Inquiry</h5>
				<span>Last Updated at <?= $inquiry->updated_at ?></span>
			</div>
			<div class="card-body">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label><strong>Payment Term</strong></label>
						<div><?= $inquiry->payment_term ?></div>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Incoterm</strong></label>
						<div><?= $inquiry->incoterm ?></div>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Destination Port / Airport</strong></label>
						<div><?= $buyer->country." - ".$inquiry->port ?></div>
					</div>
					<div class="form-group col-md-12 mb-0">
						<label><strong>Products</strong></label>
						<table class="table mb-0">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Product</th>
									<th scope="col">Quantity</th>
									<th scope="col"><small>USD</small><br/>Unit Price</th>
									<th scope="col"><small>USD</small><br/>Subtotal</th>
								</tr>
							</thead>
							<tbody>
								<?php $total = 0; foreach($inquiry->products as $i => $item){
									$subtotal = $item->unit_price * $item->qty; $total += $subtotal; ?>
								<tr>
									<th scope="row"><?= $i + 1 ?></th>
									<td>
										<?= $item->product ?>
										<?php if ($item->remark){ ?><br/><small><?= $item->remark ?></small><?php } ?>
									</td>
									<td><?= number_format($item->qty) ?></td>
									<td><?= number_format($item->unit_price, 2) ?></td>
									<td><?= number_format($subtotal, 2) ?></td>
								</tr>
								<?php } if ($inquiry->handling_cost){ $i++;  $total += $inquiry->handling_cost; ?>
								<tr>
									<th scope="row"><?= $i + 1 ?></th>
									<td>Handling Cost</td>
									<td>-</td>
									<td>-</td>
									<td><?= number_format($inquiry->handling_cost, 2) ?></td>
								</tr>	
								<?php } if ($inquiry->freight_insurance_cost){ $i++;  $total += $inquiry->freight_insurance_cost; ?>
								<tr>
									<th scope="row"><?= $i + 1 ?></th>
									<td>Freight</td>
									<td>-</td>
									<td>-</td>
									<td><?= number_format($inquiry->freight_insurance_cost, 2) ?></td>
								</tr>
								<?php } ?>
								<tr>
									<th scope="row" colspan="4" class="text-right">Total</th>
									<th><?= number_format($total, 2) ?></th>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row mt-5">
	<div class="col-md-12 text-center">
		<button type="button" class="btn btn-primary btn-lg" id="btn_packing_list" value="<?= $sale->id ?>">Packing List</button>
		<button type="button" class="btn btn-primary btn-lg" id="btn_commercial_invoice" value="<?= $sale->id ?>">Commercial Invoice</button>
	</div>
</div>

<!-- add package modal -->
<div class="modal fade" id="modal_add_package" tabindex="-1" role="dialog" aria-labelledby="packageLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="packageLabel">Add Package</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-row" id="form_add_package">
					<input type="hidden" name="pack[sale_id]" value="<?= $sale->id ?>" readonly>
					<div class="form-group col-md-12">
						<label for="inp_name"><strong>Name</strong></label>
						<input type="text" class="form-control" id="inp_name" name="pack[name]" required>
					</div>
					<div class="form-group col-md-6">
						<label for="inp_net_weight"><strong>Net Weight, KGS</strong></label>
						<input type="text" class="form-control" id="inp_net_weight" name="pack[net_weight]" required>
					</div>
					<div class="form-group col-md-6">
						<label for="inp_net_weight"><strong>Gross Weight, KGS</strong></label>
						<input type="text" class="form-control" id="inp_gross_weight" name="pack[gross_weight]" required>
					</div>
					<div class="form-group col-md-3">
						<label for="inp_length"><strong>Length, MM</strong></label>
						<input type="text" class="form-control c_vol" id="inp_length" name="pack[length]" required>
					</div>
					<div class="form-group col-md-3">
						<label for="inp_width"><strong>Width, MM</strong></label>
						<input type="text" class="form-control c_vol" id="inp_width" name="pack[width]" required>
					</div>
					<div class="form-group col-md-3">
						<label for="inp_height"><strong>Height, MM</strong></label>
						<input type="text" class="form-control c_vol" id="inp_height" name="pack[height]" required>
					</div>
					<div class="form-group col-md-3">
						<label for="inp_volume"><strong>Volume, CBM</strong></label>
						<input type="text" class="form-control" id="inp_volume" name="pack[volume]" required readonly>
					</div>
					<div class="form-group col-md-12">
						<label for="tb_products"><strong>Products</strong></label>
						<table class="table mb-0">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Product</th>
									<th scope="col">Qty</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($inquiry->products as $i => $item){ 
								if (array_key_exists($item->product_id, $packed_products)) $item_qty = $item->qty - $packed_products[$item->product_id]; else $item_qty = $item->qty ?>
								<tr>
									<th scope="row">
										<?= number_format($i + 1); ?>
									</th>
									<td><?= $item->product ?></td>
									<td>
										<?php if ($item_qty){ ?>
										<div class="input-group">
											<input type="hidden" name="products[<?= $item->product_id ?>][product_id]" value="<?= $item->product_id ?>">
											<input type="number" class="form-control" max="<?= $item_qty ?>" min="0" style="width: 50px;" value="0" name="products[<?= $item->product_id ?>][qty]">
											<div class="input-group-append">
												<span class="input-group-text">/ <?= $item_qty ?></span>
											</div>
										</div>
										<?php }else{ ?>
										<div class="text-success">Finished</div>
										<?php } ?>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="form-group col-md-12 pt-3">
						<button class="btn btn-primary" type="submit">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>