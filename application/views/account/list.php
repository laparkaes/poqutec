<div class="row">
	<div class="col">
		<h4>Accounts</h4>
	</div>
</div>
<div class="row mt-3">
	<div class="col d-md-flex justify-content-between">
		<div class="btn-group mb-2" role="group" aria-label="account_options">
			<a type="button" class="btn btn-primary" href="<?= base_url() ?>account/new">New</a>
			<button type="button" class="btn btn-outline-primary">Export to Excel</button>
		</div>
		<form class="form-inline">
			<input type="hidden" value="1" name="page">
			<label class="sr-only" for="inp_keyword">Keyword</label>
			<input type="text" class="form-control mb-2 mr-sm-2" id="inp_keyword" name="keyword" placeholder="Search Keyword" value="<?= $filter_url["keyword"] ?>">
			<button type="submit" class="btn btn-primary mb-2">Submit</button>
		</form>
	</div>
</div>
<div class="row">
	<div class="col">
		<?php if ($accounts){ ?>
		<div class="table-responsive-sm">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Username</th>
						<th scope="col">Name</th>
						<th scope="col">Position</th>
						<th scope="col">Mobile</th>
						<th scope="col">Registed</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($accounts as $i => $item){ ?>
					<tr>
						<th scope="row"><?= number_format(($page-1)*25 + 1 + $i) ?></th>
						<td><?= $item->username ?></td>
						<td><?= $item->person->name ?></td>
						<td><?= $item->person->position ?></td>
						<td><?= $item->person->mobile ?></td>
						<td><?= $item->registed_at ?></td>
						<td>
							<a href="<?= base_url() ?>account/detail/<?= $item->id ?>">
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
			<a href="<?= base_url() ?>account/list?<?= http_build_query($filter_url) ?>" class="btn btn-<?= $p[2] ?>">
				<?= $p[1] ?>
			</a>
			<?php } ?>
		</div>
	</div>
</div>