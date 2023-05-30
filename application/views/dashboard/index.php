<div class="row">
	<div class="col-md-12">
		<div class="card mb-3">
			<div class="card-header">
				<h4 class="mb-0">Sales</h4>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-sm mb-0">
						<thead>
							<tr>
								<th scope="col">Updated</th>
								<th scope="col">Country</th>
								<th scope="col">Buyer</th>
								<th scope="col">Amount</th>
								<th scope="col">Payment Term</th>
								<th scope="col">Incoterm</th>
								<th scope="col">ETD / ETA</th>
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($sales as $item){ ?>
							<tr>
								<td><?= date("Y-m-d", strtotime($item->updated_at)) ?></td>
								<td><?= $item->country ?></td>
								<td><?= $item->buyer ?></td>
								<td class="text-nowrap">USD <?= number_format($item->amount, 2) ?></td>
								<td><?= $item->payment_term ?></td>
								<td><?= $item->incoterm ?></td>
								<td><?= $item->etd ?><br/><?= $item->eta ?></td>
								<td class="text-right">
									<a href="<?= base_url() ?>sale/detail/<?= $item->id ?>">
										<i class="fas fa-search"></i>
									</a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>		
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-12">
		<div class="card mb-3">
			<div class="card-header">
				<h4 class="mb-0">Buyers</h4>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-sm mb-0">
						<thead>
							<tr>
								<th scope="col">Updated</th>
								<th scope="col">Country</th>
								<th scope="col">Company</th>
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($buyers as $item){ ?>
							<tr>
								<td><?= date("Y-m-d", strtotime($item->updated_at)) ?></td>
								<td><?= $item->country ?></td>
								<td class="text-truncate"><?= $item->company ?></td>
								<td class="text-right">
									<a href="<?= base_url() ?>buyer/detail/<?= $item->id ?>">
										<i class="fas fa-search"></i>
									</a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-12">
		<div class="card mb-3">
			<div class="card-header">
				<h4 class="mb-0">Inquiries</h4>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-sm mb-0">
						<thead>
							<tr>
								<th scope="col">Updated</th>
								<th scope="col">Country</th>
								<th scope="col">Company</th>
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($inquiries as $item){ ?>
							<tr>
								<td><?= date("Y-m-d", strtotime($item->updated_at)) ?></td>
								<td><?= $item->country ?></td>
								<td class="text-truncate"><?= $item->company ?></td>
								<td class="text-right">
									<a href="<?= base_url() ?>inquiry/detail/<?= $item->id ?>">
										<i class="fas fa-search"></i>
									</a>
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