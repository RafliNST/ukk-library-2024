<div class="container">
	<form action="<?= base_url().'aksi/login' ?>" method="post" class="my-auto">
		<div class="card my-3 mx-auto w-auto">
			<div class="card-header bg-secondary text-center h1 text-uppercase text-light">
				<?= $title ?>
			</div>
			<div class="card-body bg-dark">
				<div class="row text-light">
					<div class="form-group col">
						<label for="#">Username</label>            
						<input type="text" name="username" id="" class="form-control form-control-sm <?= $this->session->userdata('data_validation') ?>">
						<div class="invalid-feedback">
							username mungkin salah
						</div>
					</div>
				</div>
				<div class="row text-light">
					<div class="form-group col">
						<label for="#">Password</label>
						<input type="password" name="password" id="" class="form-control form-control-sm <?= $this->session->userdata('data_validation') ?>">
						<div class="invalid-feedback">
							password mungkin salah
						</div>
					</div>
				</div>
				<div class="row text-light">
					<div class="form-group col">
						<button type="submit" class="btn btn-primary btn-block">Masuk</button>
						<a class="text-info text-decoration-none" href="<?= base_url().'user/sign-up' ?>">
							<i class="fa fa-question-circle"></i> Belum Punya Akun
						</a>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>