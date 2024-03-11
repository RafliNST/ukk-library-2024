<?php defined('BASEPATH') or exit ('anda tidak memiliki hak akses');

class MBase extends CI_Model {
    function load ($view = 'main-view', $data = '') 
    {
        $this->load->view('template/header', $data);
        $this->load->view($view, $data);
        $this->load->view('template/footer');
    }
    function MakeSlug($string)
    {

        $formated_str = str_replace(' ', '-', trim($string));
        return $formated_str;
    }
    function BakeId($table = '', $column_name = '')
    {
        $this->db->select_max($column_name, 'max');
        $id   = $this->db->get($table);
        $id   = $id->result()[0]->max;
        $kode = '';

        if ($id == NULL) {
            switch ($table) {
                case 'user':
                    $kode = 'US';
                    break;
                case 'ulasan_buku':
                    $kode = 'UL';
                    break;
                case 'buku':
                    $kode = 'BK';
                    break;
                case 'koleksi_pribadi':
                    $kode = 'KP';
                    break;
                case 'peminjaman':
                    $kode = 'PM';
                    break;
                case 'kategori_buku':
                    $kode = 'KT';
                    break;
                case 'relasi_kategori_buku':
                    $kode = 'RL';
                    break;
            }
            $kode_fiks = $kode.'-001';
            return $kode_fiks;
        }   
        else {
            $urutan = (int) substr($id, 3, 3);
            $urutan++;
            $kode = substr($id, 0, 3);
            $kode_fiks = '';

            switch ($urutan) {
                case $urutan < 10:
                    $kode_fiks = $kode.'00'.$urutan;
                    break;
                case $urutan < 100:
                    $kode_fiks = $kode.'0'.$urutan;
                    break;
                default:
                    $kode_fiks = $kode.$urutan;
                    break;
            }
            return $kode_fiks;
        }    
    }
}
