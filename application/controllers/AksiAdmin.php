<?php defined('BASEPATH') or exit('Anda Tidak Diizinkan Masuk');

class AksiAdmin extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }
    public function TambahBuku()
    {
        $kode_buku  = $this->MBase->BakeId('buku', 'kode_buku');
        $judul      = $this->db->escape_str(strtolower($this->input->post('judul')));
        $penulis    = $this->db->escape_str($this->input->post('penulis'));
        $penerbit   = $this->db->escape_str($this->input->post('penerbit'));
        $thn_terbit = (int) $this->db->escape_str($this->input->post('tahun-terbit'));
        $blurb      = $this->db->escape_str($this->input->post('blurb'));
        $slug       = $this->MBase->MakeSlug($judul);
        
        $config['upload_path'] = './assets/img/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size'] = 10000;
        $config['file_name']   = $slug;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('cover')){
            $error = ['error' => $this->upload->display_errors()];
            echo var_dump($error); exit;
        }else{
            $file   = $this->upload->data();
            $data   = [
                'kode_buku' => $kode_buku,
                'judul'     => $judul,
                'cover'     => $file['file_name'],
                'penulis'  => $penulis,
                'penerbit'  => $penerbit,
                'tahun_terbit' => $thn_terbit,
                'blurb'     => $blurb,
                'slug'      => $slug
            ];
            $this->db->insert('buku', $data);

            $kategories    = $this->db->escape_str($this->input->post('kategori'));

            foreach($kategories as $kategori => $k):
                $kategori_id = $this->MBase->BakeId('relasi_kategori_buku', 'relasi_id');
                $this->db->insert('relasi_kategori_buku', [
                    'relasi_id' => $kategori_id,
                    'KategoriID' => $k,
                    'BukuID' => $kode_buku
                ]);
            endforeach;
            redirect(base_url().'form/buku');
        }
    }
    public function EditBuku()
    {
        $kode_buku  = $this->db->escape_str($this->input->post('kode_buku'));
        $judul      = $this->db->escape_str(strtolower($this->input->post('judul')));
        $penulis    = $this->db->escape_str($this->input->post('penulis'));
        $penerbit   = $this->db->escape_str($this->input->post('penerbit'));
        $thn_terbit = (int) $this->db->escape_str($this->input->post('tahun-terbit'));
        $blurb      = $this->db->escape_str($this->input->post('blurb'));
        $slug       = $this->MBase->MakeSlug($judul);
        
        $pre_cover  =  $this->db->escape_str(strtolower($this->input->post('cover-lama')));

        $config['upload_path'] = './assets/img/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size'] = 10000;
        $config['file_name']   = $slug;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('cover')){
            $error = ['error' => $this->upload->display_errors()];
            echo var_dump($error); exit;
        }else{
            $file   = $this->upload->data();
            $data   = [
                'judul'     => $judul,
                'cover'     => $file['file_name'],
                'penulis'  => $penulis,
                'penerbit'  => $penerbit,
                'tahun_terbit' => $thn_terbit,
                'blurb'     => $blurb,
                'slug'      => $slug
            ];
            $this->db->set($data);
            $this->db->where('kode_buku', $kode_buku);
            $update_buku = $this->db->update('buku');

            if ($update_buku){
                $this->load->helper("file");
                $path = APPPATH.'..\assets\img/'.$pre_cover;
                unlink($path);

                $clear_category = $this->db->delete('relasi_kategori_buku', ['BukuID' => $kode_buku]);
                $kategories    = $this->db->escape_str($this->input->post('kategori'));

                foreach($kategories as $kategori => $k):
                    $kategori_id = $this->MBase->BakeId('relasi_kategori_buku', 'relasi_id');
                    $this->db->insert('relasi_kategori_buku', [
                        'relasi_id' => $kategori_id,
                        'KategoriID' => $k,
                        'BukuID' => $kode_buku
                    ]);
                endforeach;
                redirect(base_url());
            }
        }
    }
    public function DeleteBuku()
    {
        $table     = $this->db->escape_str(strtolower($this->input->post('table')));
        $kolom     = $this->db->escape_str(strtolower($this->input->post('kolom')));
        $id_data   = $this->db->escape_str(strtolower($this->input->post('id_data')));

        if ($table == 'buku') {
            $this->db->select('cover');
            $this->db->from('buku');
            $this->db->where('kode_buku', $id_data);

            $cover    = $this->db->get()->result()[0]->cover;
            $path = APPPATH.'..\assets\img/'.$cover;
            unlink($path);
        }


        $data     = [
            "$kolom" => $id_data
        ];
        $this->db->delete($table, $data);
    }
    public function TambahUser()
    {
        $user_id    = $this->MBase->BakeId('user', 'user_id');
        $username   = $this->db->escape_str($this->input->post('username'));
        $password   = $this->db->escape_str($this->input->post('password'));
        $email      = $this->db->escape_str($this->input->post('email'));
        $nama       = $this->db->escape_str($this->input->post('nama'));
        $alamat     = $this->db->escape_str($this->input->post('alamat'));
        $status     = $this->session->userdata('level');

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

        $this->db->insert('user', $data);
        redirect(base_url().'admin/');
    }
    public function EditUser()
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
            redirect(base_url());
        }    
    }
    public function EditPassword()
    {
        $password   = $this->db->escape_str($this->input->post('password'));
        $user_id    = $this->db->escape_str($this->input->post('user_id'));

        $pass_user  = ['password' => md5($password)];
        $this->db->set($pass_user);
        $this->db->where('user_id', $user_id);        
        $update_pass= $this->db->update('user');

        if (!($update_pass)) {
            echo "<script> alert('nooo') </script>";
        }
        else {
            redirect(base_url());
        }  
    }
    public function DeleteData()
    {
        $table  = $this->db->escape_str(strtolower($this->input->post('table')));
        $kolom  = $this->db->escape_str(strtolower($this->input->post('kolom')));
        $id_data  = $this->db->escape_str(strtolower($this->input->post('id_data')));

        $this->db->delete($table, ["$kolom" => $id_data]);
    }
    public function DeleteComment()
    {

    }
    public function TambahGenre()
    {
        $genre_id = $this->MBase->BakeId('kategori_buku', 'kategori_id');
        $genre    = $this->db->escape_str(strtolower($this->input->post('genre')));

        $data     = [
            'kategori_id' => $genre_id,
            'kategori'    => $genre
        ];
        $this->db->insert('kategori_buku', $data);
    }
    public function UbahGenre()
    {
        $id = $this->db->escape_str(strtolower($this->input->post('id')));
        $genre = $this->db->escape_str(strtolower($this->input->post('genre')));

        $data = ['kategori' => $genre];
        $this->db->set($data);
        $this->db->where(['kategori_id' => $id]);
        $this->db->update('kategori_buku');
    }
}