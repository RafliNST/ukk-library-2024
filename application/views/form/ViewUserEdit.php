<div class="container my-3">
	<div class="card my-3 mx-auto">
		<div class="card-header bg-secondary text-center h1 text-uppercase text-light">
			<?= $title ?>
		</div>
		<div class="card-body bg-dark">
			<div class="row">
				<?php
			foreach($user as $user=>$o):
			?>
				<div class="col-3">
					<ul class="nav nav-pills flex-column">
						<li class="nav-item"><a href="#home" class="nav-link active" data-bs-toggle="tab">Info Umum</a>
						</li>
						<li class="nav-item"><a href="#profile" class="nav-link" data-bs-toggle="tab">Password</a></li>
					</ul>
				</div>
				<div class="col-9">
					<div class="tab-content">
						<div class="tab-pane fade show active container mx-2" id="home">
							<form action="<?= base_url().'aksiadmin/edituser'?>" method="post">
								<div class="form-group text-light">
									<label for="#">Nama Lengkap</label>
									<input type="text" name="nama" id="nama-lengkap"
										class="form-control from-control-sm" value="<?= $o->nama_lengkap ?>">
								</div>
								<div class="form-group text-light">
									<label for="#">Alamat</label>
									<textarea name="alamat" id="alamat" rows="7"
										class="form-control form-control-sm"><?= $o->alamat ?></textarea>
								</div>
								<div class="form-group text-light">
									<input type="submit" value="Ubah Data" class="btn btn-primary btn-block w-50"
										id="ubah-data">
								</div>
							</form><!-- data umum -->
						</div>
						<div class="tab-pane fade show container mx-2" id="profile">
							<form action="<?= base_url().'aksiadmin/editpassword'?>" method="post">
								<input type="hidden" name="user_id" value="<?= $o->user_id ?>">
								<div class="form-group text-light">
									<label for="#">Password Baru</label>
									<input type="password" name="password" id="password"
										class="form-control from-control-sm">
								</div>
								<div class="form-group text-light">
									<label for="#">Konfirmasi Password Baru</label>
									<input type="password" name="confirm-password" id="confirm-pass"
										class="form-control from-control-sm">
									<div class="invalid-feedback">
										password tidak sama
									</div>
								</div>
								<div class="form-group text-light">
									<input type="submit" value="Ubah Password" class="btn btn-primary btn-block w-50"
										id="ubah-password">
								</div>
							</form>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
