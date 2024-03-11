<?php defined('BASEPATH') or exit ('anda tidak memiliki hak akses');

class Admin extends CI_Controller {
	function __construct() 
	{
		parent::__construct();
	}
	function _remap($param) 
	{
		switch($param) {
			case 'index':
				$this->index();
				break;
			case 'user':
				$this->user();
				break;
			case 'petugas':
				$this->petugas();
				break;				
			case 'peminjaman':
				$this->peminjaman();
				break;
			case 'buku':
				$this->buku();
				break;
			case 'kategori':
				$this->kategori();
				break;
			case 'ulasan':
				$this->ulasan();
				break;
			default:
				$this->NotFound($param);
		}
	}
	public function index()
	{
		if ($this->session->userdata('login') != true) {
			redirect(base_url());
			return;
		}

		$data['title'] = 'Info Pribadi';
		$data['search_bar'] = "collapse";
		$this->MBase->load('ViewUser', $data);
	}
	public function user()
    {
        if ($this->session->userdata('login') != true && $this->session->userdata('user')->level != 3) {
			redirect(base_url());
			return;
		}
        $data['title'] = 'User';
        $data['search_bar'] = "collapse";
        $data['users'] = $this->db->get_where('user', ['level' => 1])->result();
        $this->MBase->load('fetch-data/ViewUser', $data);
    }
	public function petugas()
    {
        if ($this->session->userdata('login') != true && $this->session->userdata('user')->level != 2) {
			redirect(base_url());
			return;
		}
        $data['title'] = 'Petugas';
        $data['search_bar'] = "collapse";
        $data['operators'] = $this->db->get_where('user', ['level' => 2])->result();
        $this->MBase->load('fetch-data/ViewPetugas', $data);
    }
	public function peminjaman()
    {
        if ($this->session->userdata('login') != true && $this->session->userdata('user')->level != 3) {
			redirect(base_url());
			return;
		}
        $data['title'] = 'Peminjaman';
        $data['search_bar'] = "collapse";
        $this->db->select('user.user_id, user.nama_lengkap, peminjaman.peminjaman_id, buku.judul, status, tanggal_peminjaman, tanggal_pengembalian');
        $this->db->from('user');
        $this->db->join('peminjaman', 'peminjaman.user_id = user.user_id');
        $this->db->join('buku', 'buku.kode_buku = peminjaman.buku_id');
        $this->db->where('user.level = 1');
        $data['borrows'] = $this->db->get()->result();
        $this->MBase->load('fetch-data/ViewPeminjaman', $data);
    }
	public function buku()
    {
        if ($this->session->userdata('login') != true && $this->session->userdata('user')->level != 3) {
			redirect(base_url());
			return;
		}
        $data['title'] = 'Buku';
        $data['search_bar'] = "collapse";
        $data['books'] = $this->db->get('buku')->result();
        $this->MBase->load('fetch-data/ViewBuku', $data);
    }
    public function kategori()
    {
        if ($this->session->userdata('login') != true && $this->session->userdata('user')->level != 3) {
			redirect(base_url());
			return;
		}
        $data['title'] = 'Kategori';
        $data['search_bar'] = "collapse";
        $data['categories'] = $this->db->get('kategori_buku')->result();
        $this->MBase->load('fetch-data/ViewKategori', $data);
    }
    public function ulasan()
    {
        if ($this->session->userdata('login') != true && $this->session->userdata('user')->level != 3) {
			redirect(base_url());
			return;
		}
        $data['title'] = 'Ulasan';
        $data['search_bar'] = "collapse";
        $this->db->select('ulasan_id, ulasan, respon, nama_lengkap, judul');
        $this->db->from('ulasan_buku');
        $this->db->join('buku', 'kode_buku = buku_id');
        $this->db->join('user', 'ulasan_buku.user_id = user.user_id');
        $data['reviews'] = $this->db->get()->result();
        $this->MBase->load('fetch-data/ViewUlasan', $data);
    }
    public function NotFound($path)
    {

    }
}
