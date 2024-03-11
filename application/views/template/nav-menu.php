<ul class="nav position-absolute" style="right: 1.6em">
	<li class="nav-item">
		<a href="<?= base_url().'admin/user'?>" class="nav-link <?= (strtolower($title) == 'user')? 'active' : '' ?>">
			<i class="fa fa-user"></i> User
		</a>
	</li>
	<li class="nav-item">
		<a href="<?= base_url().'admin/buku'?>" class="nav-link <?= (strtolower($title) == 'buku')? 'active' : '' ?>">
			<i class="fa fa-book"></i> Buku
		</a>
	</li>
	<li class="nav-item">
		<a href="<?= base_url().'admin/peminjaman'?>"
			class="nav-link <?= (strtolower($title) == 'peminjaman')? 'active' : '' ?>">
			<i class="fa fa-file"></i> Peminjaman
		</a>
	</li>
	<li class="nav-item">
		<a href="<?= base_url().'admin/ulasan'?>"
			class="nav-link <?= (strtolower($title) == 'ulasan')? 'active' : '' ?>">
			<i class="fa fa-comment"></i> Ulasan
		</a>
	</li>
	<li class="nav-item">
		<a href="<?= base_url().'admin/petugas'?>"
			class="nav-link <?= (strtolower($title) == 'petugas')? 'active' : '' ?>">
			<i class="fa fa-group"></i> Petugas
		</a>
	</li>
	<li class="nav-item">
		<a href="<?= base_url().'admin/kategori'?>"
			class="nav-link <?= (strtolower($title) == 'kategori')? 'active' : '' ?>">
			<i class="fa fa-film"></i> Kategori
		</a>
	</li>
</ul>