<div class="container my-3">
	<div class="row my-3">
		<div class="col float-end">
			<a href="<?= base_url().'form/user' ?>" class="btn btn-info btn-sm px-4">
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
	<table id="fetch-data" class="table table-responsive-sm table-striped table-sm table-action table-bordered"
		style="width:100%">
		<thead>
			<tr>
				<th width="1%">#</th>
				<th width="30%">Nama Lengkap</th>
				<th width="20%">Email</th>
				<th width="25%">Alamat</th>
				<th width="13%">Buku Dipinjam</th>
				<th width="7%">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
		$i = 0;
		foreach($users as $user => $o):
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
						<?= $o->email ?>
					</p>
				</td>
				<td>
					<p class="text-capitalize h5 lead">
						<?= $o->alamat ?>
					</p>
				</td>
				<td class="text-center">
					<p class="h5">
						<?php
                        echo $this->db->get_where('peminjaman', ['user_id' => $o->user_id])->num_rows();
                    ?>
					</p>
				</td>
				<td>
				<div class="container row">
						<div class="col">
							<a class="badge badge-warning" href="<?= base_url().'form/user/'.$o->user_id ?>">
								<i class="fa fa-wrench"></i> Edit
							</a>
						</div>
						<div class="col">
							<a href="#" class="badge badge-danger hapus-buku" onclick="HapusData('user', 'user_id', '<?= $o->user_id?>')">
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