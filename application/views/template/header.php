<?php defined('BASEPATH') or exit ('anda tidak memiliki hak akses'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

	<title>Peminjaman Buku Perpustakaan - <?= $title ?></title>
	
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap-grid.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/font-awesome/css/font-awesome.css">

	<link rel="stylesheet" href="<?= base_url() ?>assets\DataTables\datatables.min.css">
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow shadow-md">
		<div class="container navbar-nav">
			<a href="<?= base_url() ?>" class="navbar-brand mx-auto">
				Galileo Galilei				
			</a>
			<?php 
			if ($this->session->userdata('login') == true) {
				$this->load->view('template/post-login');
				if ($this->session->userdata('user')->level != 'user'){
					$this->load->view('template/nav-menu');
				}
			}	else {
				$this->load->view('template/pre-login');
			}
			?>
		
		</div>
	</nav>

	<div class="container my-2 border bg-dark border-dark rounded <?= $search_bar ?>">
		<form action="#" class="row py-2">
			<div class="col-8 col-md-10">
				<input type="text" name="cari" id="cari" class="form-control w-100" placeholder="Cari...">
			</div>
			<div class="col-4 col-md-2">
				<input type="submit" value="cari" class="btn btn-primary w-100">
			</div>
		</form>
	</div>