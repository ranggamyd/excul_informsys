<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
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
        //     'css' => 'laporan.css',
        //     'js' => 'laporan.js',
        // ];

        $this->load->view('parts/header', $data);
        $this->load->view('' . $file, $data);
        $this->load->view('parts/footer', $data);
    }

    public function index()
    {
        $data['eskul'] = $this->eskul_model->semua_eskul();
        $data['guru'] = $this->guru_model->semua_guru();
        $data['siswa'] = $this->siswa_model->semua_siswa();
        $data['jadwal'] = $this->jadwal_model->semua_jadwal();
        $data['absensi'] = $this->absensi_model->semua_absensi();
        $data['prestasi'] = $this->prestasi_model->semua_prestasi();
        $data['nilai'] = $this->nilai_model->semua_nilai();

        $data['title'] = 'Rekap Data Laporoan';
        $this->loadView('laporan', $data);
    }
}
