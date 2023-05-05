<div class="row">
	<div class="col-md-6 col-sm-12">
		<h4>Buyers</h4>
	</div>
	<div class="col-md-6 col-sm-12 text-right">
		<div class="btn-group" role="group" aria-label="Basic example">
			<a type="button" class="btn btn-primary" href="<?= base_url() ?>buyer/new">New</a>
			<button type="button" class="btn btn-outline-primary">Export to Excel</button>
		</div>
	</div>
</div>
<div class="row mt-3">
	<div class="col">
		<div class="table-responsive-sm">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Country</th>
						<th scope="col">Buyer</th>
						<th scope="col">Type</th>
						<th scope="col">Email</th>
						<th scope="col">Web</th>
						<th scope="col">Tel</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($buyers as $i => $item){ ?>
					<tr>
						<th scope="row"><?= ($page-1)*50 + 1 + $i ?></th>
						<td><?= $countries_arr[$item->country_id] ?></td>
						<td><?= $item->company ?></td>
						<td><?= $types_arr[$item->type_id] ?></td>
						<td><?= $item->main_email ?></td>
						<td><?= $item->web ?></td>
						<td><?= $item->tel ?></td>
						<td>
							<a href="<?= base_url() ?>buyer/detail/<?= $item->id ?>">
								>>
							</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="btn-group" role="group" aria-label="paging">
			<?php foreach($pages as $p){ ?>
			<a href="<?= base_url() ?>buyer/list?page=<?= $p[0] ?>" class="btn btn-secondary"><?= $p[1] ?></a>
			<?php } ?>
		</div>
	</div>
</div>