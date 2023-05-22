<div class="row">
	<div class="col">
		<h4>Products</h4>
	</div>
</div>
<div class="row mt-3">
	<div class="col d-md-flex justify-content-between">
		<div class="btn-group mb-2" role="group" aria-label="product_options">
			<button type="button" class="btn btn-outline-primary">Export to Excel</button>
		</div>
		<form class="form-inline">
			<input type="hidden" value="1" name="page">
			<label class="sr-only" for="inp_keyword">Buyer</label>
			<input type="text" class="form-control mb-2 mr-sm-2" id="inp_buyer" name="buyer" placeholder="Search Buyer" value="<?= $filter_url["buyer"] ?>">
			<button type="submit" class="btn btn-primary mb-2">Submit</button>
		</form>
	</div>
</div>
<div class="row">
	<div class="col">
		<?php if ($inquiries){ ?>
		<div class="table-responsive-sm">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Country</th>
						<th scope="col">Buyer</th>
						<th scope="col">Item Qty</th>
						<th scope="col">Sale</th>
						<th scope="col">Updated</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($inquiries as $i => $item){ ?>
					<tr>
						<th scope="row"><?= number_format(($page-1)*25 + 1 + $i) ?></th>
						<td><?= $item->country ?></td>
						<td><?= $item->buyer ?></td>
						<td><?= number_format($item->item_qty) ?></td>
						<td><i class="fas fa-circle text-<?= $item->sale ?>"></i></td>
						<td><?= $item->updated_at ?></td>
						<td>
							<a href="<?= base_url() ?>inquiry/detail/<?= $item->id ?>">
								>>
							</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<?php }else{ ?>
		<p class="text-center text-muted mt-3">No result with keyword.</p>
		<?php } ?>
		<div class="btn-group" role="group" aria-label="paging">
			<?php foreach($pages as $p){
			$filter_url["page"] = $p[0]; ?>
			<a href="<?= base_url() ?>inquiry/list?<?= http_build_query($filter_url) ?>" class="btn btn-<?= $p[2] ?>">
				<?= $p[1] ?>
			</a>
			<?php } ?>
		</div>
	</div>
</div>