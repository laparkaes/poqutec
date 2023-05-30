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
	<link rel="stylesheet" href="<?= base_url() ?>resources/vendor/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>resources/vendor/sweetalert2-11.4.35/dist/sweetalert2.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>resources/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>resources/setting.css">
	<script src="<?= base_url() ?>resources/vendor/jquery-3.6.4.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>
	<script src="<?= base_url() ?>resources/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url() ?>resources/vendor/fontawesome/js/all.min.js"></script>
	<script src="<?= base_url() ?>resources/vendor/sweetalert2-11.4.35/dist/sweetalert2.min.js"></script>
	<script src="<?= base_url() ?>resources/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?= base_url() ?>resources/setting.js"></script>
	<?php if ($init){ ?>
	<script src="<?= base_url() ?>resources/init/<?= $init ?>"></script>
	<?php } ?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="<?= base_url() ?>dashboard">
		<img src="<?= base_url() ?>resources/images/logo.png" id="logo">
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<?php if (!strcmp($this->nav_active, "dashboard")) $a = "active"; else $a = ""; ?>
			<li class="nav-item <?= $a ?>">
				<a class="nav-link" href="<?= base_url() ?>dashboard">Home</a>
			</li>
			<?php if (!strcmp($this->nav_active, "product")) $a = "active"; else $a = ""; ?>
			<li class="nav-item <?= $a ?>">
				<a class="nav-link" href="<?= base_url() ?>product/list">Product</a>
			</li>
			<?php if (!strcmp($this->nav_active, "buyer")) $a = "active"; else $a = ""; ?>
			<li class="nav-item <?= $a ?>">
				<a class="nav-link" href="<?= base_url() ?>buyer/list">Buyer</a>
			</li>
			<?php if (!strcmp($this->nav_active, "inquiry")) $a = "active"; else $a = ""; ?>
			<li class="nav-item <?= $a ?>">
				<a class="nav-link" href="<?= base_url() ?>inquiry/list">Inquiry</a>
			</li>
			<?php if (!strcmp($this->nav_active, "sale")) $a = "active"; else $a = ""; ?>
			<li class="nav-item <?= $a ?>">
				<a class="nav-link" href="<?= base_url() ?>sale/list">Sale</a>
			</li>
			<?php if (!strcmp($this->nav_active, "account")) $a = "active"; else $a = ""; ?>
			<li class="nav-item <?= $a ?>">
				<a class="nav-link" href="<?= base_url() ?>account/list">Account</a>
			</li>
		</ul>
		<span class="badge badge-info"><?= $this->session->userdata('username'); ?></span>
		<div class="my-2 my-lg-0 text-right">
			<button class="btn btn-outline-danger border-0 my-2 my-sm-0" id="btn_logout"><i class="fas fa-sign-out"></i></button>
		</div>
	</div>
</nav>
<div class="container mt-3 pb-5"><?php $this->load->view($main); ?></div>
<input type="hidden" id="base_url" value="<?= base_url() ?>">
</body>
</html>
