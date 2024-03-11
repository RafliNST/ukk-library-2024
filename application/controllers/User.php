<?php defined('BASEPATH') or exit ('anda tidak memiliki hak akses');

class User extends CI_Controller {
	function __construct() 
	{
		parent::__construct();
	}
	function _remap($path) 
	{
		switch($path) {
			case 'index':
				$this->index();
				break;
			case 'koleksi-pribadi':
				$this->koleksiPribadi();
				break;
			case 'sign-in':
				$this->SignIn();
				break;
			case 'sign-out':
				$this->SignOut();
				break;
			case 'sign-up':
				$this->SignUp();
				break;
			default:
				$this->NotFound($path);
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
	public function KoleksiPribadi()
	{
		if ($this->session->userdata('login') != true) {
			redirect(base_url());
			return;
		}

		$data['title'] = 'KoleksiPribadi';
		$data['search_bar'] = "collapse";

		$this->db->select('buku.cover, buku.kode_buku, buku.judul, user.user_id, peminjaman.status, buku.slug, peminjaman_id, buku.penulis, buku.penerbit');
		$this->db->from('buku');
		$this->db->join('peminjaman', 'peminjaman.buku_id = buku.kode_buku');
		$this->db->join('user', 'user.user_id = peminjaman.user_id');
		$this->db->where('user.user_id', $this->session->userdata('user')->user_id);
		$data['colections'] = $this->db->get()->result();
		$this->MBase->load('ViewKoleksi', $data);		
	}
	public function SignIn()
	{
		if ($this->session->userdata('login') == true) {
			redirect(base_url());
			return;
		}

		$data['title'] = 'Masuk';
		$data['search_bar'] = "collapse";
		$this->MBase->load('ViewLogin', $data);
	}
	public function SignOut()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
	public function SignUp()
	{
		if ($this->session->userdata('login') == true) {
			redirect(base_url());
			return;
		}
		
		$data['title'] = 'Daftar';
		$data['search_bar'] = "collapse";
		$this->MBase->load('ViewRegistrasi', $data);
	}
	public function NotFound($path)
	{
		echo 'Path '.$path.' tidak ada';
	}
}
