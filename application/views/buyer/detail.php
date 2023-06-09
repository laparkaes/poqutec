<div class="row">
	<div class="col-md-6 col-sm-12">
		<h4 class="mb-3">Buyer Detail</h4>
	</div>
	<div class="col-md-6 col-sm-12 text-right">
		<a type="button" class="btn btn-outline-primary mb-3" href="<?= base_url() ?>buyer/list">Back to List</a>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card mb-3">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h5 class="mb-0">Company Information</h5>
				<div>
					<button type="button" class="btn btn-primary" id="btn_buyer_edit">Edit</button>
					<button type="button" class="btn btn-outline-danger d-none" id="btn_buyer_edit_cancel">Cancel</button>
				</div>
			</div>
			<div class="card-body">
				<form id="form_buyer_update">
					<input type="hidden" name="id" value="<?= $buyer->id ?>">
					<div class="form-row mx-0">
						<div class="form-group col-md-12">
							<label for="in_company">Company</label>
							<input type="text" class="form-control" id="in_company" name="company" value="<?= $buyer->company ?>" required readonly>
						</div>
						<div class="form-group col-md-4">
							<label for="sl_country">Country</label>
							<select id="sl_country" class="form-control" name="country_id" required disabled>
								<?php foreach($countries as $item){
								if ($item->id == $buyer->country_id) $s = "selected"; else $s = ""; ?>
								<option value="<?= $item->id ?>" <?= $s ?>><?= $item->country ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-md-4">
							<label for="sl_type">Type</label>
							<select id="sl_type" class="form-control" name="type_id" required disabled>
								<?php foreach($types as $item){
								if ($item->id == $buyer->type_id) $s = "selected"; else $s = ""; ?>
								<option value="<?= $item->id ?>" <?= $s ?>><?= $item->type ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-md-4">
							<label for="in_main_email">Main Email</label>
							<input type="email" class="form-control" id="in_main_email" name="main_email" value="<?= $buyer->main_email ?>" readonly>
						</div>
						<div class="form-group col-md-4">
							<label for="in_web">Web</label>
							<input type="text" class="form-control" id="in_web" name="web" value="<?= $buyer->web ?>" readonly>
						</div>
						<div class="form-group col-md-4">
							<label for="in_tel">Tel</label>
							<input type="text" class="form-control" id="in_tel" name="tel" value="<?= $buyer->tel ?>" readonly>
						</div>
						<div class="form-group col-md-4">
							<label for="in_fax">Fax</label>
							<input type="text" class="form-control" id="in_fax" name="fax" value="<?= $buyer->fax ?>" readonly>
						</div>
						<div class="form-group col-md-12">
							<label for="in_address">Address</label>
							<input type="text" class="form-control" id="in_address" name="address" value="<?= $buyer->address ?>" readonly>
						</div>
					</div>
					<button type="submit" class="btn btn-primary mt-3 d-none" id="btn_buyer_update">Update</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card mb-3">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h5 class="mb-0">Notes</h5>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#md_note_add">Add</button>
			</div>
			<div class="card-body" id="tb_notes_body"></div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card mb-3">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h5 class="mb-0">People</h5>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#md_person_add">Add</button>
			</div>
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Name</th>
							<th scope="col">Position</th>
							<th scope="col">Mobile</th>
							<th scope="col">Email</th>
							<th scope="col">Registered</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody id="tb_people">
						<?php foreach($people as $i => $item){ ?>
						<tr>
							<th scope="row"><?= $i + 1 ?></th>
							<td><?= $item->name ?></td>
							<td><?= $item->position ?></td>
							<td><?= $item->mobile ?></td>
							<td><?= $item->email ?></td>
							<td><?= $item->registed_at ?></td>
							<td class="text-right">
								<button type="button" class="btn btn-danger btn-sm btn_person_delete" value="<?= $item->id ?>">
									<i class="fas fa-trash-alt"></i>
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
<!--
<div class="row">
	<div class="col-md-6 col-sm-12">
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h5 class="mb-0">Recent Inquieries</h5>
				<a href="<?= base_url() ?>inquiry/new?buyer_id=<?= $buyer->id ?>" class="btn btn-primary">New</a>
			</div>
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Date</th>
							<th scope="col">Item Qty</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($inquiries as $i => $item){ ?>
						<tr>
							<th scope="row"><?= $i + 1 ?></th>
							<td><?= $item->registed_at ?></td>
							<td><?= $item->item_qty ?></td>
							<td class="text-right">
								<a type="button" class="btn btn-info btn-sm" href="<?= base_url() ?>inquiry/detail/<?= $item->id ?>">
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
	<div class="col-md-6 col-sm-12">
		sales
	</div>
</div>
-->
<input type="hidden" id="company_id" value="<?= $buyer->id ?>">

<!-- modal - person add -->
<div class="modal fade" id="md_person_add" tabindex="-1" role="dialog" aria-labelledby="md_person_addLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="md_person_addLabel">Add Person</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form_person_register">
					<input type="hidden" name="company_id" value="<?= $buyer->id ?>">
					<div class="form-group">
						<label for="person_name">Name</label>
						<input type="text" class="form-control" id="person_name" name="name" required>
					</div>
					<div class="form-group">
						<label for="person_position">Position</label>
						<input type="text" class="form-control" id="person_position" name="position">
					</div>
					<div class="form-group">
						<label for="person_mobile">Mobile</label>
						<input type="text" class="form-control" id="person_mobile" name="mobile">
					</div>
					<div class="form-group">
						<label for="person_email">Email</label>
						<input type="email" class="form-control" id="person_email" name="email">
					</div>
					<div class="pt-3">
						<button type="submit" class="btn btn-primary">Add</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- modal - note add -->
<div class="modal fade" id="md_note_add" tabindex="-1" role="dialog" aria-labelledby="md_note_addLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="md_note_addLabel">Add Note</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form_note_add">
					<div class="form-row">
						<input type="hidden" name="company_id" value="<?= $buyer->id ?>">
						<div class="form-group col-md-6">
							<label for="content">Date</label>
							<input class="form-control" value="<?= date("Y-m-d") ?>" readonly>
						</div>
						<div class="form-group col-md-6">
							<label for="content">Type</label>
							<select class="custom-select" name="type_id">
								<option selected>Choose...</option>
								<?php foreach($note_types as $item){ ?>
								<option value="<?= $item->id ?>"><?= $item->note_type ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-md-12">
							<label for="content">Content</label>
							<textarea class="form-control" name="content" rows="5" required></textarea>
						</div>
					</div>
					<div class="pt-3">
						<button type="submit" class="btn btn-primary">Add</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>