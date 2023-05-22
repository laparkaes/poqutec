<div class="row">
	<div class="col-md-6 col-sm-12">
		<h4 class="mb-3">Account Detail</h4>
	</div>
	<div class="col-md-6 col-sm-12 text-right">
		<a type="button" class="btn btn-outline-primary mb-3" href="<?= base_url() ?>account/list">Back to List</a>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card mb-3">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h5 class="mb-0">Account Information</h5>
				<div>
					<button type="button" class="btn btn-primary" id="btn_account_edit">Edit</button>
					<button type="button" class="btn btn-outline-danger d-none" id="btn_account_edit_cancel">Cancel</button>
				</div>
			</div>
			<div class="card-body">
				<form id="form_account_update">
					<input type="hidden" name="a[id]" value="<?= $account->id ?>">
					<input type="hidden" name="p[id]" value="<?= $person->id ?>">
					<div class="form-row mx-0">
							<div class="form-group col-md-12">
								<label for="in_username">Email</label>
								<input type="email" class="form-control" id="in_username" value="<?= $account->username ?>" readonly required>
							</div>
							<div class="form-group col-md-6">
								<label for="in_password">Password</label>
								<input type="password" class="form-control" id="in_password" name="a[password]" readonly>
							</div>
							<div class="form-group col-md-6">
								<label for="in_password_confirm">Password Confirm</label>
								<input type="password" class="form-control" id="in_password_confirm" name="a[password_confirm]" readonly>
							</div>
							<div class="form-group col-md-12">
								<label for="in_name">Name</label>
								<input type="text" class="form-control" id="in_name" name="p[name]" value="<?= $person->name ?>" readonly required>
							</div>
							<div class="form-group col-md-6">
								<label for="in_position">Position</label>
								<input type="text" class="form-control" id="in_position" name="p[position]" value="<?= $person->position ?>" readonly>
							</div>
							<div class="form-group col-md-6">
								<label for="in_mobile">Mobile</label>
								<input type="text" class="form-control" id="in_mobile" name="p[mobile]" value="<?= $person->mobile ?>" readonly>
							</div>
						</div>
					<button type="submit" class="btn btn-primary mt-3 d-none" id="btn_account_update">Update</button>
				</form>
			</div>
		</div>
	</div>
</div>