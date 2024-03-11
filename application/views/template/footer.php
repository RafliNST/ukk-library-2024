<?php defined('BASEPATH') or exit ('anda tidak memiliki hak akses'); ?>

<!-- <footer class="fixed-bottom bg-dark text-light text-center float-center p-1">
    &copy;<?= date('Y')?> Galilei Galilei
</footer> -->

<script src="<?= base_url()?>assets\js\jquery.js"></script>
<script src="<?= base_url()?>assets\js\popper.min.js"></script>
<script src="<?= base_url()?>assets\DataTables\datatables.min.js"></script>
<script src="<?= base_url()?>assets\js\bootstrap.bundle.js"></script>
<script src="<?= base_url()?>assets\js\bootstrap.min.js"></script>

<script>
	// new DataTable('#fetch-data');
	$('#fetch-data').DataTable({
		dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
	})

	const HapusData = (nama_table, nama_kolom, id_data) => {
		if (confirm("Apakah Anda Yakin Akan Mengahpus Data "+ id_data + "?") == true) {
			$.post('<?= base_url().'aksiadmin/deletedata' ?>', {
				table:nama_table,
				kolom: nama_kolom,
				id_data: id_data
			}, location.reload())
		}
	}

	$('#cari').on('keyup', () => {
		$.get('<?= base_url() ?>welcome/Testajax?param=' + $('#cari').val(), function (data) {
			$('#main-container').html(data);
		})
	})

	$('#ubah-password').click(() => {
		$.post('<?= base_url().'aksi/ubahpassword' ?>', {
			password: $('#password').val()
		}, function (data) {
			location.reload();
		})
	})

	$('#ubah-data').click(() => {
		$.post('<?= base_url().'aksi/ubahdata' ?>', {
			nama: $('#nama-lengkap').val(),
			alamat: $('#alamat').val()
		}, location.reload())
	})

	$('#tambah-kategori').on('click', () => {
		let genre_name = prompt('nama genre');
		if (genre_name === null) return
		$.post('<?= base_url().'form/tambah-genre'?>', {
			genre:genre_name
		})
		location.reload()
	});

	$('.ubah-kategori').click(function () {
		let genre_name = prompt('nama genre');
		if (genre_name === null) return
		$.post('<?= base_url().'aksiadmin/ubahgenre'?>', {
			id : $(this).data('id-kategori'),
			genre:genre_name
		}, location.reload())
	});

	$('.ambil').click(function () {
		if (confirm("Apakah Anda Ingin Meminjam Buku " +$(this).data('id-buku') + "?") == true) {
			$.post('<?= base_url().'aksi/peminjaman' ?>', {kode_buku: $(this).attr('data-id-buku')}, function (data) {
				location.reload();
			})
		}
	});

	$('.dipinjam').click(function () {
		if (confirm("Apakah Anda Sudah Selesai Membaca Buku " +$(this).attr('data-id-peminjaman') + "?") == true) {
			$.post('<?= base_url().'aksi/kembalikan' ?>', {peminjaman_id: $(this).attr('data-id-peminjaman')}, function (data) {
				location.reload();
			})
		}
	});

	$('#confirm-pass, #password').on('keyup', () => {
		let pass	= $('#password');
		let confirm	= $('#confirm-pass');
		if (pass.val() !== confirm.val()) {
			confirm.addClass('is-invalid')
			$('#ubah-password').attr('disabled', 'disabled');
		}	else {
			confirm.removeClass('is-invalid');
			$('#ubah-password').removeAttr('disabled');
		}
	})	
</script>
</body>

</html>