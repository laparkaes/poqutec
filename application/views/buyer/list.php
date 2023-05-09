<div class="row">
	<div class="col">
		<h4>Buyers</h4>
	</div>
</div>
<div class="row mt-3">
	<div class="col d-md-flex justify-content-between">
		<div class="btn-group mb-2" role="group" aria-label="buyer_options">
			<a type="button" class="btn btn-primary" href="<?= base_url() ?>buyer/new">New</a>
			<button type="button" class="btn btn-outline-primary">Export to Excel</button>
		</div>
		<form class="form-inline">
			<input type="hidden" value="1" name="page">
			<label class="sr-only" for="sl_country">Country</label>
			<select class="custom-select mb-2 mr-sm-2" id="sl_country" name="country">
				<option value="">Country</option>
				<?php foreach($countries as $item){ if ($item->id == $filter_url["country"]) $s = "selected"; else $s = "";  ?>
				<option value="<?= $item->id ?>" <?= $s ?>><?= $item->country ?></option>
				<?php } ?>
			</select>
			<label class="sr-only" for="sl_type">Type</label>
			<select class="custom-select mb-2 mr-sm-2" id="sl_type" name="type">
				<option value="">Type</option>
				<?php foreach($types as $item){ if ($item->id == $filter_url["type"]) $s = "selected"; else $s = ""; ?>
				<option value="<?= $item->id ?>" <?= $s ?>><?= $item->type ?></option>
				<?php } ?>
			</select>
			<label class="sr-only" for="inp_keyword">Keyword</label>
			<input type="text" class="form-control mb-2 mr-sm-2" id="inp_keyword" name="keyword" placeholder="Search Keyword" value="<?= $filter_url["keyword"] ?>">
			<button type="submit" class="btn btn-primary mb-2">Submit</button>
		</form>
	</div>
</div>
<div class="row">
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
						<th scope="col">Updated</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($buyers as $i => $item){ ?>
					<tr>
						<th scope="row"><?= number_format(($page-1)*25 + 1 + $i) ?></th>
						<td><?= $countries_arr[$item->country_id] ?></td>
						<td><?= $item->company ?></td>
						<td><?= $types_arr[$item->type_id] ?></td>
						<td><?= $item->main_email ?></td>
						<td><?= $item->web ?></td>
						<td><?= $item->tel ?></td>
						<td><?= $item->updated_at ?></td>
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
			<?php foreach($pages as $p){
			$filter_url["page"] = $p[0]; ?>
			<a href="<?= base_url() ?>buyer/list?<?= http_build_query($filter_url) ?>" class="btn btn-<?= $p[2] ?>">
				<?= $p[1] ?>
			</a>
			<?php } ?>
		</div>
	</div>
</div>