<?php defined('BASEPATH') or exit ('anda tidak memiliki hak akses');

class Buku extends CI_Controller {

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
	}
    function _remap($param) 
	{
        $this->buku($param);
    }
	public function index()
	{
		// echo $;
	}
	public function buku($slug = '')
	{
        $data['title'] 		= "Buku";
		$data['search_bar'] = "";
		$data['pinjam']		= '';

		try {
			$data['books']		= $this->db->get_where('buku', ['slug' => $slug])->result();
			if (!$data['books']) {
				$this->Error($slug);
				return;
			}			
		}	catch (Exception $err) {
			echo $err;
		}
		$this->MBase->load('ViewBuku', $data);
	}
	public function Error($msg)
	{
		$data['title'] = 'Error';
		$data['search_bar'] = '';
		$data['param'] = $msg;
		$this->MBase->load('ErrorMsg', $data);
	}
}