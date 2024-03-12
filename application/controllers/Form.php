<?php defined('BASEPATH') or exit('anda tidak memiliki hak akses');

class Form extends CI_Controller {
	function __construct() 
	{
		parent::__construct();
        if ($this->session->userdata('user')->level == 'user')
			redirect(base_url());
	}
    public function _remap($param, $path)
    {
        if (($param == 'petugas' || $param == 'user') && !isset($path[0])){
            $this->session->set_userdata('level', $param);
            $this->TambahUser($param);
        }   
        elseif (($param == 'petugas' || $param == 'user') && $path != '') {
            $this->EditUser($param, $path[0]);
        }
        elseif ($param == 'buku' && !isset($path[0])) {
            $this->buku();
        }
        elseif ($param == 'buku' && $path != '') {
            $this->EditBuku($path[0]);
        }
    }    
	public function index()
	{
		$data['title'] 		= 'Index';
		$data['search_bar'] = "";
	}
    public function buku()
    {
        $data['title']      =  'Buku';
        $data['search_bar'] =  'collapse';
        $data['genres']     = $this->db->get('kategori_buku')->result();
        $this->MBase->load('form/ViewBuku', $data);        
    }
    public function EditBuku($param)
    {
        $data['title']      =  'Buku';
        $data['search_bar'] =  'collapse';
        $data['genres']     = $this->db->get('kategori_buku')->result();
        try {
            $data['books']  = $this->db->get_where('buku', ['slug' => $param])->result();
            if (!$data['books']) {
                // redirect (base_url().'error');
            }
        }   catch (Exception $e) {
            echo $e;
        }
        $this->MBase->load('form/ViewBukuEdit', $data);        
    }
    public function TambahUser($param)
    {
        $data['title']  = $param;
        $data['search_bar']= "collapse";
        $this->MBase->load('form/ViewUser', $data);
    }
    public function EditUser($level, $id)
    {
        $data['search_bar'] =  'collapse';
        try {
            $data['user']  = $this->db->get_where('user', ['user_id' => $id, 'level' => $level])->result();
            if (!$data['user']) {
                $this->Error($id);
                return;
            }
        }   catch (Exception $e) {
            echo $e;
        }
        $data['title'] = $data['user'][0]->level;
        $this->MBase->load('form/ViewUserEdit', $data);
    }
    public function Error($msg)
	{
		$data['title'] = 'Error';
		$data['search_bar'] = '';
		$data['param'] = $msg;
		$this->MBase->load('ErrorMsg', $data);
	}
}
