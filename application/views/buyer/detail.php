<div class="row">
	<div class="col-md-6 col-sm-12">
		<h4 class="mb-3">Buyer Detail</h4>
	</div>
	<div class="col-md-6 col-sm-12 text-right">
		<a type="button" class="btn btn-outline-primary mb-3" href="<?= base_url() ?>buyer/list">Back to List</a>
	</div>
</div>
<div class="row">
	<div class="col-md-8 col-sm-12">
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
	<div class="col-md-4 col-sm-12 d-flex align-items-stretch">
		<div class="card w-100 mb-3">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h5 class="mb-0">People</h5>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#md_person_add">Add</button>
			</div>
			<div class="card-body" style="height: 300px; overflow-y: auto;">
				<ul class="list-group" id="ul_people_list">
					<?php foreach($people as $item){ ?>
					<li class="list-group-item">
						<div class="d-flex justify-content-between align-items-start">
							<h5 class="mb-0"><?= $item->name ?></h5>
							<button type="button" class="btn btn-danger btn-sm btn_person_delete" value="<?= $item->id ?>">
								<i class="fas fa-trash-alt"></i>
							</button>
						</div>
						<?php if ($item->position_id){ ?>
						<p class="mb-1"><?= $position_arr[$item->position_id] ?></p>
						<?php } if ($item->mobile){ ?>
						<p class="mb-1"><i class="fas fa-phone fa-fw"></i> <?= $item->mobile ?></p>
						<?php } if ($item->email){ ?>
						<p class="mb-1"><i class="fas fa-envelope fa-fw"></i> <?= $item->email ?></p>
						<?php } ?>
						<small class="text-muted"><?= $item->registed_at ?></small>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>	
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-sm-12">
		inquiries
	</div>
	<div class="col-md-6 col-sm-12">
		sales
	</div>
</div>
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