<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            $this->session->set_userdata('referred_from', current_url());
            $this->session->set_flashdata('gagal', 'Gagal mengakses, Silahkan login kembali !');
            redirect('auth');
        }
    }

    private function loadView($file, $data)
    {
        // $data['style'] = [
        //     'css' => 'dashboard.css',
        //     'js' => 'dashboard.js',
        // ];

        $this->load->view('parts/header', $data);
        $this->load->view('' . $file, $data);
        $this->load->view('parts/footer', $data);
    }

    public function index()
    {
        $data['jml_eskul'] = $this->db->get_where('tbl_eskul')->num_rows();
        $data['jml_siswa'] = $this->db->get_where('tbl_siswa')->num_rows();
        $data['jml_pembina'] = $this->db->group_by('id_pembina')->get_where('tbl_eskul')->num_rows();
        $data['jml_ketua'] = $this->db->group_by('id_ketua')->get_where('tbl_eskul')->num_rows();

        $data['pengumuman'] = $this->db->order_by('id_pengumuman', 'desc')->get('tbl_pengumuman')->result_array();

        $data['siswa'] = $this->siswa_model->semua_siswa();

        $data['title'] = 'Dashboard';
        $this->loadView('dashboard', $data);
    }
}
