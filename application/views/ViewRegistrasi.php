<div class="container my-3">
	<form action="<?= base_url().'aksi/register' ?>" method="post"" class=" my-3">
		<div class="card my-3 mx-auto w-auto">
			<div class="card-header bg-secondary text-center h1 text-uppercase text-light">
				<?= $title ?>
			</div>
			<div class="card-body bg-dark">
				<div class="row">
					<div class="col-12 col-md-6 text-light">
						<div class="row">
							<div class="form-group col-12">
								<label for="#">Nama Lengkap</label>
								<input type="text" name="nama" id="full-name" class="form-control form-control-sm">
							</div>
							<div class="form-group col-12">
								<label for="#">Username</label>
								<input type="text" name="username" id="usrname" class="form-control form-control-sm <?= $this->session->userdata('email_validation')?>">
								<div class="invalid-feedback">
									username mungkin telah digunakan
								</div>
							</div>
							<div class="form-group col-12">
								<label for="#">Password</label>
								<input type="password" name="password" id="password"
									class="form-control form-control-sm">
							</div>
							<div class="form-group col-12">
								<label for="#">Konfirmasi Password</label>
								<input type="password" name="confirm-password" id="confirm-pass"
									class="form-control form-control-sm">
								<div class="invalid-feedback">
									password tidak sama
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 text-light">
						<div class="row">
							<div class="form-group col-12">
								<label for="email">Email</label>
								<input type="email" name="email" id="email"
									class="form-control form-control-sm <?= $this->session->userdata('email_validation')?>">
								<div class="invalid-feedback">
									email telah digunakan
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-12">
								<label for="alamat">Alamat</label>
								<textarea name="alamat" id="alamat" rows="5%" class="form-control form-control-sm"
									style="resize: none;"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<button type="submit" class="btn btn-primary btn-block">Daftar</button>
								<a class="text-info text-decoration-none" href="<?= base_url().'user/sign-in' ?>">
									<i class="fa fa-exclamation-circle"></i> Sudah Punya Akun
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>