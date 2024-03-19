<div class="container my-3">
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
	<table id="fetch-data" class="table table-responsive-sm table-striped table-sm table-action table-bordered"
		style="width:100%">
		<thead>
			<tr>
				<th width="3%">#</th>
				<th width="25%">Nama</th>
				<th width="20%">Judul</th>
				<th width="17%">Komentar</th>
				<th width="17%">Respon</th>
				<th width="17%">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
		$i = 0;
		foreach($reviews as $review => $o):
		?>
			<tr>
				<td>
					<?= ++$i ?>
				</td>
				<td>
					<p class="text-capitalize">
						<?= $o->nama_lengkap ?>
					</p>
				</td>
				<td>
					<p class="text-capitalize">
						<?= $o->judul ?>
					</p>
				</td>
				<td>
					<p class="text-capitalize">
						<?= $o->ulasan ?>
					</p>
				</td>
				<td>
					<p class="text-capitalize">
						<?= $o->respon ?>
					</p>
				</td>
				<td>
					<p class="h5 lead text-center">
						<span class="badge badge-danger btn hapus-komentar" onclick="HapusData('ulasan_buku', 'ulasan_id', '<?= $o->ulasan_id?>')">
							<i class="fa fa-trash"></i> hapus
						</span>
					</p>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>