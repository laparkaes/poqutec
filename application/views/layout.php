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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="<?= base_url() ?>dashboard">
		<img src="<?= base_url() ?>resources/images/logo.png" id="logo">
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="<?= base_url() ?>dashboard">Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Buyer</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Product</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Inquiry</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Sale</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Account</a>
			</li>
		</ul>
		<form class="form-inline my-2 my-lg-0">
			<input class="form-control mr-sm-2" type="search" placeholder="Buyer quick search" aria-label="Search">
			<button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
		</form>
	</div>
</nav>
<div class="container mt-3">
	<div class="row">
		<div class="col-md-12">
			<div class="card mb-3">
				<div class="card-header">
					<h4 class="mb-0">Sales Progress</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-sm mb-0">
							<thead>
								<tr>
									<th scope="col">Num</th>
									<th scope="col">Country</th>
									<th scope="col">Company</th>
									<th scope="col">Term</th>
									<th scope="col">Amount</th>
									<th scope="col">Freight</th>
									<th scope="col">Shipment</th>
									<th scope="col">ETD</th>
									<th scope="col">ETA</th>
									<th scope="col">Status</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>2023-04-23</td>
									<td>Canada</td>
									<td class="text-truncate">Some construction company</td>
									<td>FOB</td>
									<td class="text-nowrap">USD 65,000</td>
									<td class="text-nowrap">USD 600</td>
									<td>Maritime</td>
									<td>2023-04-11</td>
									<td>2023-05-24</td>
									<td>Payment</td>
								</tr>
								<tr>
									<td>2023-04-23</td>
									<td>Canada</td>
									<td>Some construction company</td>
									<td>FOB</td>
									<td>USD 65,000</td>
									<td>USD 600</td>
									<td>Air</td>
									<td>2023-04-11</td>
									<td>2023-05-24</td>
									<td>Payment</td>
								</tr>
								<tr>
									<td>2023-04-23</td>
									<td>Canada</td>
									<td>Some construction company</td>
									<td>FOB</td>
									<td>USD 65,000</td>
									<td>USD 600</td>
									<td>Air</td>
									<td>2023-04-11</td>
									<td>2023-05-24</td>
									<td>Payment</td>
								</tr>
								<tr>
									<td>2023-04-23</td>
									<td>Canada</td>
									<td>Some construction company</td>
									<td>FOB</td>
									<td>USD 65,000</td>
									<td>USD 600</td>
									<td>Maritime</td>
									<td>2023-04-11</td>
									<td>2023-05-24</td>
									<td>Payment</td>
								</tr>
							</tbody>
						</table>
					</div>		
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-12">
			<div class="card mb-3">
				<div class="card-header">
					<h4 class="mb-0">Recent Buyers</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-sm mb-0">
							<thead>
								<tr>
									<th scope="col">Date</th>
									<th scope="col">Country</th>
									<th scope="col">Company</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>2023-03-11</td>
									<td>Canada</td>
									<td class="text-truncate">Some construction company</td>
								</tr>
								<tr>
									<td>2023-03-11</td>
									<td>Canada</td>
									<td>Some construction company</td>
								</tr>
								<tr>
									<td>2023-03-11</td>
									<td>Canada</td>
									<td>Some construction company</td>
								</tr>
								<tr>
									<td>2023-03-11</td>
									<td>Canada</td>
									<td>Some construction company</td>
								</tr>
								<tr>
									<td>2023-03-11</td>
									<td>Canada</td>
									<td>Some construction company</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-12">
			<div class="card mb-3">
				<div class="card-header">
					<h4 class="mb-0">Lastest Inquiries</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-sm mb-0">
							<thead>
								<tr>
									<th scope="col">Date</th>
									<th scope="col">Country</th>
									<th scope="col">Company</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>2023-04-23</td>
									<td>Canada</td>
									<td class="text-truncate">Some construction company</td>
								</tr>
								<tr>
									<td>2023-04-23</td>
									<td>Canada</td>
									<td>Some construction company</td>
								</tr>
								<tr>
									<td>2023-04-23</td>
									<td>Canada</td>
									<td>Some construction company</td>
								</tr>
								<tr>
									<td>2023-04-23</td>
									<td>Canada</td>
									<td>Some construction company</td>
								</tr>
								<tr>
									<td>2023-04-23</td>
									<td>Canada</td>
									<td>Some construction company</td>
								</tr>
							</tbody>
						</table>
					</div>
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
