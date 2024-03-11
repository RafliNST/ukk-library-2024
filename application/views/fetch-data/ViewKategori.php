<div class="container my-3">
	<div class="row my-3">
		<div class="col float-end">
			<a href="<?= base_url().'admin/form-buku' ?>" class="btn btn-info btn-sm px-4">
				<i class="fa fa-plus"></i> Tambah Data
			</a>
		</div>
	</div>
	<table id="fetch-data" class="table table-responsive-sm table-striped table-sm table-action table-bordered"
		style="width:100%">
		<thead>
			<tr>
				<th width="3%">#</th>
				<th width="80%">Kategori</th>
				<th width="17%">Aksi</th>				
			</tr>
		</thead>
		<tbody>
			<?php
		$i = 0;
		foreach($categories as $category => $u):
		?>
			<tr>
				<td>
					<?= ++$i ?>
				</td>
				<td>
                    <p class="text-capitalize">
                        <?= $u->kategori ?>
                    </p>
				</td>
				<td>
					<p class="h5 lead text-capitalize">
                        <div class="row">
                            <div class="col-6 text-center">
                                <span class="badge badge-warning btn ubah-kategori" data-id-kategori="<?= $u->kategori_id ?>">
                                    <i class="fa fa-wrench"></i> ubah
                                </span>
                            </div>
                            <div class="col-6 text-center">
                                <span class="badge badge-danger btn hapus-kategori" data-id-kategori="<?= $u->kategori_id ?>">
                                    <i class="fa fa-trash"></i> hapus
                                </span>
                            </div>
                        </div>
                    </p>
				</td>				
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>