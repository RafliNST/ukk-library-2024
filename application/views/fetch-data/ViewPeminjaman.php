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
				<th width="1%">#</th>
				<th width="25%">Nama Lengkap</th>
				<th width="20%">Buku</th>
				<th width="25%">Tanggal Peminjaman</th>
				<th width="25%">Tanggal Pengembalian</th>
				<th width="13%">Status</th>
			</tr>
		</thead>
		<tbody>
			<?php
		$i = 0;
		foreach($borrows as $borrow => $o):
		?>
			<tr>
				<td>
					<?= ++$i ?>
				</td>
				<td>
					<?= $o->nama_lengkap ?>
				</td>
				<td>
					<p class="h5 lead">
						<?= $o->judul ?>
					</p>
				</td>
				<td>
					<p class="text-capitalize h5 lead">
						<?= $o->tanggal_peminjaman ?>
					</p>
				</td>
				<td>
					<p class="text-capitalize h5 lead">
						<?= $o->tanggal_pengembalian ?>
					</p>
				</td>
				<td class="text-center">
					<p class="h5 container">
						<?php 
					switch ($o->status) {
						case 'dipinjam':
							$badge = 'badge-warning';
							$msg   = 'dipinjam';
							break;
						default:
							$badge = 'badge-primary';
							$msg   = 'dikembalikan';
							break;
					}	?>
						<span class="btn badge <?= $badge. ' '. $msg ?>" data-id-peminjaman="<?= $o->peminjaman_id ?>">
							<?= $msg ?>
						</span>
					</p>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>