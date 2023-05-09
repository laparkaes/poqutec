<div class="row">
	<div class="col">
		<h4>Products</h4>
	</div>
</div>
<div class="row mt-3">
	<div class="col d-md-flex justify-content-between">
		<div class="btn-group mb-2" role="group" aria-label="product_options">
			<a type="button" class="btn btn-primary" href="<?= base_url() ?>product/new">New</a>
			<button type="button" class="btn btn-outline-primary">Export to Excel</button>
		</div>
		<form class="form-inline">
			<input type="hidden" value="1" name="page">
			<label class="sr-only" for="sl_category">Category</label>
			<select class="custom-select mb-2 mr-sm-2" id="sl_category" name="category">
				<option value="">Category</option>
				<?php foreach($categories as $item){ if ($item->id == $filter_url["category"]) $s = "selected"; else $s = "";  ?>
				<option value="<?= $item->id ?>" <?= $s ?>><?= $item->category ?></option>
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
						<th scope="col">Category</th>
						<th scope="col">Product</th>
						<th scope="col">Price</th>
						<th scope="col">Updated</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($products as $i => $item){ ?>
					<tr>
						<th scope="row"><?= number_format(($page-1)*25 + 1 + $i) ?></th>
						<td><?= $categories_arr[$item->category_id] ?></td>
						<td><?= $item->product ?></td>
						<td>USD <?= number_format($item->price, 2) ?></td>
						<td><?= $item->updated_at ?></td>
						<td>
							<a href="<?= base_url() ?>product/detail/<?= $item->id ?>">
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
			<a href="<?= base_url() ?>product/list?<?= http_build_query($filter_url) ?>" class="btn btn-<?= $p[2] ?>">
				<?= $p[1] ?>
			</a>
			<?php } ?>
		</div>
	</div>
</div>