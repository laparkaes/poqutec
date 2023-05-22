<div class="row">
	<div class="col-md-6 col-sm-12">
		<h4>New Account</h4>
	</div>
	<div class="col-md-6 col-sm-12 text-right">
		<a type="button" class="btn btn-outline-primary" href="<?= base_url() ?>buyer/list">Back to List</a>
	</div>
</div>
<div class="row mt-3">
	<div class="col">
		<div class="card">
				<div class="card-header">
					<h5 class="mb-0">Information</h5>
				</div>
				<div class="card-body">
					<form id="form_account_register">
						<div class="form-row mx-0">
							<div class="form-group col-md-12">
								<label for="in_username">Email</label>
								<input type="email" class="form-control" id="in_username" name="a[username]" required>
							</div>
							<div class="form-group col-md-6">
								<label for="in_password">Password</label>
								<input type="password" class="form-control" id="in_password" name="a[password]" required>
							</div>
							<div class="form-group col-md-6">
								<label for="in_password_confirm">Password Confirm</label>
								<input type="password" class="form-control" id="in_password_confirm" name="a[password_confirm]" required>
							</div>
							<div class="form-group col-md-12">
								<label for="in_name">Name</label>
								<input type="text" class="form-control" id="in_name" name="p[name]" required>
							</div>
							<div class="form-group col-md-6">
								<label for="in_position">Position</label>
								<input type="text" class="form-control" id="in_position" name="p[position]">
							</div>
							<div class="form-group col-md-6">
								<label for="in_mobile">Mobile</label>
								<input type="text" class="form-control" id="in_mobile" name="p[mobile]">
							</div>
						</div>
						<button type="submit" class="btn btn-primary mt-3">Register</button>
					</form>
				</div>
			</div>
	</div>
</div>