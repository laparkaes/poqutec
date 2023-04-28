<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Poqutec - CRM</title>
    <link rel="icon" type="image/png" sizes="16x16" href="resources/images/logo.png">
	<link rel="stylesheet" href="resources/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="resources/setting.css">
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
					<form>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="inputEmail4">Email</label>
								<input type="email" class="form-control" id="inputEmail4">
							</div>
							<div class="form-group col-md-12">
								<label for="inputPassword4">Password</label>
								<input type="password" class="form-control" id="inputPassword4">
							</div>
						</div>
						<button type="submit" class="btn btn-primary mt-3">Access</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="resources/jquery-3.6.4.min.js"></script>
<script src="resources/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="resources/setting.js"></script>
</body>
</html>
