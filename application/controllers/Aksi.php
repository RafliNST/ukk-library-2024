<?php defined('BASEPATH') or exit ('anda tidak memiliki hak akses');

class Aksi extends CI_Controller {
	function __construct() 
	{
		parent::__construct();
	}
    public function register()
    {
        $user_id    = $this->MBase->BakeId('user', 'user_id');
        $username   = $this->db->escape_str($this->input->post('username'));
        $password   = $this->db->escape_str($this->input->post('password'));
        $email      = $this->db->escape_str($this->input->post('email'));
        $nama       = $this->db->escape_str($this->input->post('nama'));
        $alamat     = $this->db->escape_str($this->input->post('alamat'));
        $status     = ($this->input->post('status'))? $this->input->post('status') : 1 ;

        $get_id = $this->db->get_where('user', ['email' => $email]);
        if ($get_id->num_rows() != 0) {
            $this->session->set_flashdata('email_validation', 'is-invalid');
            redirect(base_url().'user/sign-up');
            return;
        }

        $data       = [
            'user_id'      => $user_id,
            'username'     => $username,
            'password'     => md5($password),
            'email'        => $email,
            'nama_lengkap' => $nama,
            'alamat'       => $alamat,
            'level'        => $status
        ];

        $insert = $this->db->insert('user', $data);
        
        if ($insert) {
            $get_user   = $this->db->get_where('user', ['username' => $username, 'password' => md5($password)]);   
            $this->session->set_userdata('user', $get_user->result()[0]);
            $this->session->set_userdata('login', True);
            redirect(base_url());
        }
    }
    public function login()
    {
        $username   = $this->db->escape_str($this->input->post('username'));
        $password   = $this->db->escape_str($this->input->post('password'));
        
        $get_user   = $this->db->get_where('user', ['username' => $username, 'password' => md5($password)]);
        if ($get_user->num_rows() > 0)
        {
            $this->session->set_userdata('user', $get_user->result()[0]);
            $this->session->set_userdata('login', True);
            redirect(base_url());
        }
        else {
            $this->session->set_flashdata('data_validation', 'is-invalid');
            redirect(base_url().'user/sign-in');
        }
    }
    public function peminjaman()
    {
        $id_pinjam  = $this->MBase->BakeId('peminjaman', 'peminjaman_id');
        $kode_buku  = $this->db->escape_str($this->input->post('kode_buku'));
        $user_id    = $this->session->userdata('user')->user_id;
        $tgl_pinjam = date('Y-m-d');
        $status     = 1;

        $data_peminjaman   = [
            'peminjaman_id' => $id_pinjam,
            'user_id'       => $user_id,
            'buku_id'       => $kode_buku,
            'tanggal_peminjaman' => $tgl_pinjam,
            'status'        => $status
        ];

        $data_koleksi      = [
            'koleksi_id' => $this->MBase->BakeId('koleksi_pribadi', 'koleksi_id'), 
            'BukuID' => $kode_buku,
            'UserID' => $user_id
        ];

        $this->db->insert('koleksi_pribadi', $data_koleksi);
        $this->db->insert('peminjaman', $data_peminjaman);        
    }
    public function kembalikan()
    {
        $id_pinjam  = $this->db->escape_str($this->input->post('peminjaman_id'));
        $pengembalian = date('Y-m-d');
        $status     = 2;

        $data_peminjaman   = [
            'tanggal_pengembalian' => $pengembalian,
            'status'        => $status
        ];
            
        $this->db->set($data_peminjaman);
        $this->db->where('peminjaman_id', $id_pinjam);
        
        $update_for_peminjaman   = $this->db->update('peminjaman');
        if (!($update_for_peminjaman)) {
            echo "<script> alert('nooo') </script>";
        }
    }    
	public function komentar()
	{
        $ulasan_id  = $this->MBase->BakeId('ulasan_buku', 'ulasan_id');
        $komentar   = $this->db->escape_str($this->input->post('komentar'));
        $rating     = ceil(($this->input->post('rating') / 100) * 5);
        $respon     = $this->input->post('respon');
        $id_buku    = $this->input->post('id_buku');
        $user_id    = $this->session->userdata('user')->user_id;

        $data   = [
            'ulasan_id' => $ulasan_id,
            'user_id'   => $user_id,
            'buku_id'   => $id_buku,
            'ulasan'    => $komentar,
            'rating'    => $rating,
            'respon'    => $respon
        ];

        $insert = $this->db->insert('ulasan_buku', $data);
        if ($insert) {
            echo "<script> 
            window.location = '../'
            </script>";
        }   else {
            echo "<script> alert('no') </script>";
        }
	}
    public function ubahpassword() 
    {
        $password   = $this->db->escape_str($this->input->post('password'));
        $user_id    = $this->session->userdata('user')->user_id;

        $pass_user  = ['password' => md5($password)];
        $this->db->set($pass_user);
        $this->db->where('user_id', $user_id);        
        $update_pass= $this->db->update('user');

        if (!($update_pass)) {
            echo "<script> alert('nooo') </script>";
        }
        else {
            $this->session->user->password = $password;
        }    
    }
    public function ubahdata() 
    {
        $nama   = $this->db->escape_str($this->input->post('nama'));
        $alamat = $this->db->escape_str($this->input->post('alamat'));
        $user_id    = $this->session->userdata('user')->user_id;

        $data_user  = [
            'nama_lengkap' => $nama,
            'alamat' => $alamat
        ];
        $this->db->set($data_user);
        $this->db->where('user_id', $user_id);        
        $update_pass= $this->db->update('user');

        if (!($update_pass)) {
            echo "<script> alert('nooo') </script>";
        }
        else {
            $this->session->user->nama_lengkap = $nama;
            $this->session->user->alamat = $alamat;
        }
    }
}

