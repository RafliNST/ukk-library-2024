<div class="container my-3">
	<div class="row my-3">
		<div class="col float-end">
			<a href="<?= base_url().'form/buku' ?>" class="btn btn-info btn-sm px-4">
				<i class="fa fa-plus"></i> Tambah Data
			</a>
		</div>
	</div>
	<?php
	if (isset($this->session->response)):
	?>
	<div class="row my-3">
		<div class="col">
			<ul class="list-group-item list-group-item-<?= $this->session->userdata('response')->status ?>">
				<?= $this->session->userdata('response')->message ?>
			</ul>
		</div>
	</div>
	<?php endif ?>
	<table id="fetch-data" class="table table-responsive-sm table-striped table-sm table-action table-bordered w-100" style="width: 100%;">
		<thead>
			<tr>
				<th width="5%">#</th>
				<th width="25%">Judul</th>
				<th width="10%">Penulis</th>
				<th width="10%">Penerbit</th>
				<th width="5%">Tahun Terbit</th>
				<th width="45%">Blurb</th>
				<th class="d-print-none">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
		$i = 0;
		foreach($books as $book => $u):
		?>
			<tr style="height: 2em;" class="">
				<td>
					<?= ++$i ?>
				</td>
				<td>
					<p class="text-capitalize">
						<a href="<?= base_url()."buku/$u->slug" ?>" class="text-decoration-none">
							<?= $u->judul ?>
						</a>
					</p>
				</td>
				<td>
					<p class="h5 lead text-capitalize">
						<?= $u->penulis ?>
					</p>
				</td>
				<td>
					<p class="text-capitalize h5 lead">
						<?= $u->penerbit ?>
					</p>
				</td>
				<td>
					<p class="text-capitalize h5 lead">
						<?= $u->tahun_terbit ?>
					</p>
				</td>
				<td>
					<p class="h5 lead">
						<?= $u->blurb ?>
					</p>
				</td>
				<td>
					<div class="container row">
						<div class="col">
							<a class="badge badge-warning" href="<?= base_url().'form/buku/'.$u->slug ?>">
								<i class="fa fa-wrench"></i> Edit
							</a>
						</div>
						<div class="col">
							<a href="#" class="badge badge-danger hapus-buku" onclick="HapusData('buku', 'kode_buku', '<?= $u->kode_buku?>')">
								<i class="fa fa-trash"></i> Hapus
							</a>
						</div>
					</div>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>