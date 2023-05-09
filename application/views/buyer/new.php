<div class="row">
	<div class="col-md-6 col-sm-12">
		<h4>New Buyer</h4>
	</div>
	<div class="col-md-6 col-sm-12 text-right">
		<a type="button" class="btn btn-outline-primary" href="<?= base_url() ?>buyer/list">Back to List</a>
	</div>
</div>
<div class="row mt-3">
	<div class="col">
		<div class="card">
				<div class="card-header">
					<h5 class="mb-0">Company Information</h5>
				</div>
				<div class="card-body">
					<form id="form_buyer_register">
						<div class="form-row mx-0">
							<div class="form-group col-md-12">
								<label for="in_company">Company</label>
								<input type="text" class="form-control" id="in_company" name="company" required>
							</div>
							<div class="form-group col-md-4">
								<label for="sl_country">Country</label>
								<select id="sl_country" class="form-control" name="country_id" required>
									<option value="" selected>Choose...</option>
									<?php foreach($countries as $item){ ?>
									<option value="<?= $item->id ?>"><?= $item->country ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="sl_type">Type</label>
								<select id="sl_type" class="form-control" name="type_id" required>
									<option value="" selected>Choose...</option>
									<?php foreach($types as $item){ ?>
									<option value="<?= $item->id ?>"><?= $item->type ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="in_main_email">Main Email</label>
								<input type="email" class="form-control" id="in_main_email" name="main_email">
							</div>
							<div class="form-group col-md-4">
								<label for="in_web">Web</label>
								<input type="text" class="form-control" id="in_web" name="web">
							</div>
							<div class="form-group col-md-4">
								<label for="in_tel">Tel</label>
								<input type="text" class="form-control" id="in_tel" name="tel">
							</div>
							<div class="form-group col-md-4">
								<label for="in_fax">Fax</label>
								<input type="text" class="form-control" id="in_fax" name="fax">
							</div>
							<div class="form-group col-md-12">
								<label for="in_address">Address</label>
								<input type="text" class="form-control" id="in_address" name="address">
							</div>
						</div>
						<button type="submit" class="btn btn-primary mt-3">Register</button>
					</form>
				</div>
			</div>
	</div>
</div>