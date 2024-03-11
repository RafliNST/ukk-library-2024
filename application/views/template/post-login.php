<div class="dropdown me-3 position-absolute d-inline" style="left: 1.6rem">
	<button type="button" class="btn btn-outline-light btn-sm dropdown-toggle" data-bs-toggle="dropdown">
		<i class="fa fa-user"></i> <?= $this->session->userdata('user')->nama_lengkap ?>
	</button>
	<div class="dropdown-menu">
		<a href="<?= base_url().'user/koleksi-pribadi' ?>" class="dropdown-item text-secondary btn-sm">
			<i class="fa fa-file"></i> Koleksi Pribadi
		</a>
		<div class="dropdown-divider"></div>
		<a href="<?= base_url().'user' ?>" class="dropdown-item text-warning btn-sm">
			<i class="fa fa-wrench"></i> Pengaturan Akun
		</a>
		<div class="dropdown-divider"></div>
		<a href="<?= base_url().'user/sign-out' ?>" class="dropdown-item text-danger btn-sm">
			<i class="fa fa-sign-out"></i> Keluar
		</a>
	</div>
</div>