<div class="d-flex justify-content-between">
	<div class="btn-group mb-3" role="group" aria-label="paging">
		<?php foreach($pages as $p){  ?>
		<button class="btn btn-<?= $p[2] ?> btn_note_page" value="<?= $p[0] ?>">
			<?= $p[1] ?>
		</button>
		<?php } ?>
	</div>
	<div class="input-group ml-3 mb-3" style="max-width: 300px;">
		<input type="text" class="form-control" id="ip_note_keyword" name="keyword" placeholder="Search keyword here..." value="<?= $keyword ?>">
		<div class="input-group-append">
			<button class="btn btn-info" id="btn_search_note" type="button"><i class="fas fa-search"></i></button>
		</div>
	</div>
</div>
<table class="table">
	<thead>
		<tr>
			<th scope="col" style="width: 120px;">Date</th>
			<th scope="col" style="width: 150px;">Person</th>
			<th scope="col" style="width: 100px;">Type</th>
			<th scope="col">Content</th>
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody>
		<?php if ($notes){ foreach($notes as $item){ ?>
		<tr>
			<td><?= date("Y-m-d", strtotime($item->registed_at)) ?></td>
			<td><?= $item->person->name ?></td>
			<td><?= $item->type ?></td>
			<td style="white-space: pre-line;"><?= $item->content ?></td>
			<td class="text-right">
				<button type="button" class="btn btn-danger btn-sm btn_note_delete" value="<?= $item->id ?>">
					<i class="fas fa-trash-alt"></i>
				</button>
			</td>
		</tr>
		<?php }} else{ ?>
		<tr>
			<td colspan="4" class="text-center text-danger">No data.</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<div class="text-info"><strong><?= number_format($total) ?> result(s)</strong></div>