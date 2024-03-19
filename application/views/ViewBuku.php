<div class="container mt-2">
	<div class="row" id="main-container">
	<?php foreach ($books as $book=>$o): ?>
		<div class="col-12 col-md-3">
			<div class="row">
				<img src="<?= base_url().'assets/IMG/'.$o->cover ?>" alt="" class="img-thumbnail shadow shadow-lg w-100">
			</div>
			<?php
			$this->db->select('peminjaman_id, buku_id, status');
			$this->db->from('peminjaman');
			$this->db->where('buku_id', $o->kode_buku);
			$this->db->where('status', 1);
			$banyak	= $this->db->get();
			if ($banyak->num_rows() == 0 && ($this->session->userdata('login') == true && $this->session->userdata('user')->level == 'user')):
			?>
			<div class="row my-2">
				<div class="col">
					<a href="#" class="btn btn-warning btn-block ambil" id="ambil" data-id-buku="<?= $o->kode_buku ?>">
						<i class="fa fa-check"></i> Pinjam
					</a>
				</div>
			</div>
			<?php
			elseif ($this->session->userdata('login') == false || $this->session->userdata('user')->level != 'user'):
				
			elseif ($banyak->result()[0]->status === 'dipinjam'): ?>
			<div class="row my-2">
				<div class="col">
					<a href="#" class="btn btn-success btn-block dipinjam" data-id-peminjaman="<?= $banyak->result()[0]->peminjaman_id ?>">
						<i class="fa fa-check"></i> Selesai
					</a>
				</div>
			</div>
			<?php endif ?>
		</div>
		<div class="col-12 col-md-8 mt-2 mt-md-0">
			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a href="#home" class="nav-link active" data-bs-toggle="tab">
						<i class="fa fa-book"></i> Tentang Buku
					</a>
				</li>
				<li class="nav-item">
					<a href="#profile" class="nav-link " data-bs-toggle="tab">
						<i class="fa fa-pencil"></i> Tulis Ulasan
					</a>
				</li>
				<li class="nav-item">
					<a href="#contact" class="nav-link" data-bs-toggle="tab">
						<i class="fa fa-star"></i> Ulasan
					</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade show active p-2" id="home">
					<div class="row">
						<div class="form-group col-6">
							<label for="judul">Judul</label>
							<input type="text" class="form-control form-control-sm text-capitalize" value="<?= $o->judul ?>" readonly>
						</div> <!-- judul -->
						<div class="form-group col-6">
							<label for="penulis">Penulis</label>
							<input type="text" class="form-control form-control-sm text-capitalize" value="<?= $o->penulis ?>" readonly>
						</div> <!-- penulis -->
					</div>
					<div class="row">
						<div class="form-group col-6">
							<label for="penerbit">Penerbit</label>
							<input type="text" class="form-control form-control-sm text-capitalize" value="<?= $o->penerbit ?>" readonly>
						</div> <!-- penerbit -->
						<div class="form-group col-6">
							<label for="tahun terbit">Tahun Terbit</label>
							<input type="text" class="form-control form-control-sm" value="<?= $o->tahun_terbit ?>" readonly>
						</div> <!-- tahun terbit -->
					</div>
					<div class="row">
						<div class="form-group col">
							<label for="deskripsi">Deskripsi</label>
							<textarea class="form-control form-control-sm" rows="5%" readonly style="resize: none"><?= $o->blurb ?></textarea>
							<!-- <input type="text" name="" id="" class="form-control form-control-sm" value="<?= $o->blurb ?>" readonly> -->
						</div>
					</div>
					<div class="row container">
						<div class="form-group col">
							<label for="genre">Genre</label>
							<div class="row">
							<?php 
							$this->db->select("buku.kode_buku, buku.judul, kategori_buku.kategori from buku left join
							relasi_kategori_buku on buku.kode_buku = relasi_kategori_buku.BukuID left join kategori_buku on 
							relasi_kategori_buku.KategoriID = kategori_buku.kategori_id 
							where kode_buku ='$o->kode_buku'", FALSE);

							$genres = $this->db->get()->result();

							foreach($genres as $genre=>$g):
							?>
								<a href="#" class="col-4 list-group-item list-group-action btn-sm btn-light shadow shadow-lg"><?= $g->kategori ?></a>
							<?php endforeach ?>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade show p-2" id="profile">
					<form action="<?= base_url().'aksi/komentar' ?>" method="post">	
						<input type="hidden" name="id_buku" value="<?= $books[0]->kode_buku ?>">					
						<div class="form-group">
							<label for="#">Komentar</label>
							<textarea name="komentar" id="KomentarUser" class="form-control form-control-sm" rows="7"
								style="resize: none;" placeholder="Tulis Komentar Anda" required></textarea>
						</div>
						<div class="form-group w-50">
							<label for="rating">Rating</label>
							<input type="range" name="rating" id="" class="form-control-range" required>
						</div>
						<div class="form-group">
							<label for="#" class="d-block">Respon</label>
							<div class="form-check form-check-inline h6">
								<input type="radio" name="respon" id="" class="form-check-input" value="1" required>
								<label for="#" class="form-check-label text-primary">
									<i class="fa fa-thumbs-up"></i> Like
								</label>
							</div>
							<div class="form-check form-check-inline h6">
								<input type="radio" name="respon" id="" class="form-check-input" value="2" required>
								<label for="#" class="form-check-label text-danger">
									<i class="fa fa-thumbs-down"></i> Dislike
								</label>								
							</div>
						<?php 
						if ($this->session->userdata('login') == true):
							$this->db->select('buku_id, user_id, status');
							$this->db->from('peminjaman');
							$this->db->where('buku_id', $books[0]->kode_buku);
							$this->db->where('user_id', $this->session->userdata('user')->user_id);
							$this->db->where('status', 2);
							$cek_pernah_pinjam = $this->db->get()->num_rows();
							if ($cek_pernah_pinjam != 0):
						?>
							<div class="row container">
								<button type="submit" class="col-3 btn btn-primary">Tulis</button>
							</div>
						<?php endif; endif ?>
						</div>
					</form>
				</div>
				<div class="tab-pane fade show p-2" id="contact">
				<?php
				$this->db->select('*');
				$this->db->from('ulasan_buku');
				$this->db->join('buku', 'ulasan_buku.buku_id = buku.kode_buku', 'left');
				$this->db->join('user', 'ulasan_buku.user_id = user.user_id', 'left');
				$this->db->where('ulasan_buku.buku_id', $books[0]->kode_buku);
				$comments	= $this->db->get();
				if ($comments->num_rows() < 1):
				?>
				<div class="container">
					<p class="h4 text-center py-5">
						<i class="fa fa-star"></i> Belum Ada Ulasan
					</p>
				</div>
				<?php else:
				foreach($comments->result() as $comment=>$o): 
				?>
					<div class="card w-100 mb-2" style="width: 18rem;">
						<h5 class="card-header">
							<?= $o->nama_lengkap ?>
							<p class="position-absolute text-dark h5" style="right: 1.3em; top: 0%; transform: translateY(50%)">
								<i class="fa fa-star"></i> <?= $o->rating ?>
							</p>
						</h5>
						<div class="list-group list-group-flush">
							<p class="list-group-item h6 text-<?= (($o->respon == 'like')? 'primary' : 'danger') ?>">
								<?= $o->ulasan ?>
								<i class="fa fa-<?= (($o->respon == 'like')? 'thumbs-up' : 'thumbs-down') ?>"></i>
							</p>
						</div>
					</div>
				<?php endforeach; endif ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
</div>