<?php defined('BASEPATH') or exit ('anda tidak memiliki hak akses');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	function __construct() 
	{
		parent::__construct();
		$this->load->library('pagination');
	}
	public function index()
	{
		$data['title'] 		= 'Index';
		$data['search_bar'] = "";	
		
		$this->db->select('buku_id');
		$this->db->from('peminjaman');
		$this->db->where('status', 1);
		$not_available =  $this->db->get()->result();

		$tidak_tersedia = [''];	
		foreach($not_available as $not) {array_push($tidak_tersedia, $not->buku_id);}

		$batas = 6;

		$this->db->select('*');
		$this->db->from('buku');
		$this->db->where_not_in('kode_buku', $tidak_tersedia);
		$this->db->limit($batas, $this->uri->segment(3));
		$data['books'] = $this->db->get()->result();
		
		$config['base_url'] = base_url().'welcome/index/';
		$config['total_rows'] = $this->db->get('buku')->num_rows();
		$config['per_page'] = $batas;
		$this->pagination->initialize($config);	

		$this->MBase->load('main-view', $data);		
	}
	public function TestAjax()
	{
		$data['title'] 		= "Index";
		$data['search_bar'] = "";

		$this->db->select('*');
		$this->db->from('buku');
		$this->db->like('judul', $_GET['param']);
		
		$data['books']		= $this->db->get()->result();
		$this->load->view('main-view', $data);
	}
}
