<?php defined('BASEPATH') or exit ('anda tidak memiliki hak akses');

class NotFound extends CI_Controller {
	function __construct() 
	{
		parent::__construct();
	}
	public function index()
	{
        $data['title'] = 'Error';
		$data['search_bar'] = '';

        $last = $this->uri->total_segments();
		$data['param'] = $this->uri->segment($last);
		$this->MBase->load('ErrorMsg', $data);	
    }
}
