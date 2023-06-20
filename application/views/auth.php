<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Poqutec - CRM</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>resources/images/logo.png">
	<link rel="stylesheet" href="<?= base_url() ?>resources/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>resources/vendor/sweetalert2-11.4.35/dist/sweetalert2.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>resources/setting.css">
	<script src="<?= base_url() ?>resources/vendor/jquery-3.6.4.min.js"></script>
	<script src="<?= base_url() ?>resources/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url() ?>resources/vendor/sweetalert2-11.4.35/dist/sweetalert2.min.js"></script>
	<script src="<?= base_url() ?>resources/setting.js"></script>
	<script src="<?= base_url() ?>resources/init/auth.js"></script>
</head>
<body>
<div class="container vh-100">
	<div class="row vh-100 d-flex justify-content-center">
		<div class="col-md-6 col-sm-12 vh-100 d-flex align-items-center">
			<div class="card w-100">
				<div class="card-header text-center">
					<div class="mb-2"><img src="<?= base_url() ?>resources/images/logo.png"></div>
					<div>Customer Relationship Management System</div>
				</div>
				<div class="card-body">
					<form id="form_login">
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="inp_email">Email</label>
								<input type="email" class="form-control" id="inp_user" name="username" required>
							</div>
							<div class="form-group col-md-12">
								<label for="inp_pass">Password</label>
								<input type="password" class="form-control" id="inp_pass" name="password" required>
							</div>
						</div>
						<div class="mt-3">
							<?php if ($this->gm->all("account", null, null, null, 1, 0)){ ?>
							<div><button type="submit" class="btn btn-primary">Access</button></div>
							<?php }else{ ?>
							<div>
								<button type="button" class="btn btn-outline-success" id="btn_first_account">
									Create First Account
								</button>
							</div>
							<div class="text-info mt-1">Enter email without password to create first account.</div>
							<?php } ?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="base_url" value="<?= base_url() ?>">
</body>
</html>
