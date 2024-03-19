<div class="container">
	<div class="row" id="main-container">
		<?php $i = 0;
	foreach ($books as $book => $o): ?>
		<div class="col-12 col-md-4 my-2">
			<a href="<?= base_url().'buku/'.$o->slug ?>" class="text-decoration-none btn btn-outline-dark w-100">
				<img src="<?= base_url() ?>assets\IMG\<?= $o->cover ?>" alt="" class="card-img-top"
					style="object-fit: cover; object-position: center;">
			</a>
			<div class="accordion">
				<div class="card-header" id="headingOne">
					<h5 class="mb-0">
						<a href="#" class="text-decoration-none h6 text-capitalize" data-toggle="collapse"
							data-target="#buku<?= $i ?>">
							<?= $o->judul ?> - <span class="text-muted"><?= $o->penulis ?></span>
						</a>
					</h5>
				</div>
				<div class="collapse" id="buku<?= $i ?>" data-parents="">
					<div class="card-body border">
						<?= $o->blurb ?>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col">
						<span class="text-primary h5">
							<i class="fa fa-thumbs-up"></i>
							<?php							
							$like = $this->db->get_where('ulasan_buku', ['respon' => 1, 'buku_id' => $o->kode_buku]);
							echo $like->num_rows();							
							?>
						</span>
						<span class="mx-2"> - </span>
						<span class="text-danger h5">
							<i class="fa fa-thumbs-down"></i>
							<?php							
							$dislike = $this->db->get_where('ulasan_buku', ['respon' => 2, 'buku_id' => $o->kode_buku]);
							echo $dislike->num_rows();							
							?>
						</span>
						<?php
						$this->db->select('buku_id');
						$this->db->from('peminjaman');
						$this->db->where('buku_id', $o->kode_buku);
						$this->db->where('status', 1);
						$banyak	= $this->db->get()->num_rows();
						if ($banyak == 0 && ($this->session->userdata('login') == true && $this->session->userdata('user')->level == 'user')):
						?>
						<span class="text-dark position-absolute h5" style="right: 1%">
							<a class="badge badge-pill badge-warning ambil btn"
								data-id-buku="<?= $o->kode_buku ?>">
								<i class="fa fa-check"></i> Pinjam
							</a>
						</span>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
		<?php 
	$i++;
	endforeach; ?>		
	</div>
	<div class="row">
		<div class="col-12 text-center mx-auto">
			<?= $this->pagination->create_links() ?>
		</div>
	</div>
</div>
