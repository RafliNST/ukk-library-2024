<div class="container my-3">
	<div class="card w-75 mx-auto float-center">
		<div class="card-header bg-secondary text-light text-center">
			<p class="h1">Form Buku</p>
		</div>
		<div class="card-body">
			<?= form_open_multipart('form/tambah-buku')?>
			<form action="">
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label for="#judul">Judul</label>
							<input type="text" name="judul" id="judul" class="form-control form-control-sm">
						</div>
						<div class="form-group">
							<label for="#cover">Cover</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" accept="image/*" name="cover">
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
						</div>
						<div class="form-group">
							<label for="#penulis">Penulis</label>
							<input type="text" name="penulis" id="penulis" class="form-control form-control-sm">
						</div>
						<div class="form-group">
							<label for="#penerbit">Penerbit</label>
							<input type="text" name="penerbit" id="penerbit" class="form-control form-control-sm">
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label for="#tahun-terbit">Tahun Terbit</label>
							<input type="number" name="tahun-terbit" id="tahun-terbit"
								class="form-control form-control-sm" min="1880" max="<?= date('Y')?>" step="1">
						</div>
						<div class="form-group">
							<label for="#blurb">Blurb</label>
							<textarea name="blurb" id="blurb" rows="9" class="form-control form-control-sm"
								style="resize: none"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col d-inline">
						<label for="">Genre</label>
						<a href="#" class="badge badge-success" id="tambah-kategori">
							<i class="fa fa-plus"></i> tambah genre
						</a>
						<div class="row">
						<?php
						foreach($genres as $genre=>$g):
						?>
							<div class="col-3">
								<div class="form-check">
									<input type="checkbox" name="kategori[]" id="" class="form-check-input" value="<?= $g->kategori_id ?>">
									<label for=""><?= $g->kategori ?></label>
								</div>
							</div>
						<?php endforeach ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<input type="submit" value="tambah" class="btn btn-primary btn-sm btn-block">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>