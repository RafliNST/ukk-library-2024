<div class="container my-3">
	<table id="fetch-data" class="table table-responsive-sm table-striped table-sm table-action table-bordered" style="width:100%">
		<thead>
			<tr>
				<th width="3%">#</th>
				<th width="40%">Judul</th>
				<th width="20%">Penulis</th>
				<th width="25%">Penerbit</th>
				<th width="5%">Status</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$i = 0;
		foreach($colections as $colection => $o):
		?>
			<tr>
				<td>
					<?= ++$i ?>
				</td>
				<td>
					<a href="<?= base_url().'buku/'.$o->slug ?>" class="text-decoration-none text-primary h5">
						<?= $o->judul ?>
					</a>
				</td>
				<td>
					<p class="text-capitalize h5 lead">
						<?= $o->penulis ?>
					</p>
				</td>
				<td>
					<p class="text-capitalize h5 lead">
						<?= $o->penerbit ?>
					</p>
				</td>
				<td class="text-center">
					<p class="h5">
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