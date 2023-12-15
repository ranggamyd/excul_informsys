<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prestasi extends CI_Controller
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
        //     'css' => 'prestasi.css',
        //     'js' => 'prestasi.js',
        // ];

        $this->load->view('parts/header', $data);
        $this->load->view('' . $file, $data);
        $this->load->view('parts/footer', $data);
    }

    public function index()
    {
        $data['prestasi'] = $this->prestasi_model->semua_prestasi();
        $data['siswa'] = $this->siswa_model->semua_siswa();
        $data['eskul'] = $this->eskul_model->semua_eskul();

        $data['title'] = 'Data Prestasi';

        if ($this->session->userdata('login_as') == 'siswa' || $this->session->userdata('role') == 'wakasek') {
            $this->loadView('prestasi_siswa', $data);
        } else {
            $this->loadView('prestasi', $data);
        }
    }

    public function detail($id)
    {
        $data['prestasi'] = $this->prestasi_model->prestasi($id);

        $data['title'] = 'Detail Prestasi';
        $this->loadView('prestasi_siswa_detail', $data);
    }

    public function tambah()
    {
        if ($this->prestasi_model->tambah_prestasi()) {
            $this->session->set_flashdata('sukses', 'Berhasil Menambahkan Prestasi !');
            redirect('prestasi');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Menambahkan Prestasi !');
            $this->index();
        }
    }

    public function ubah()
    {
        if ($this->prestasi_model->ubah_prestasi()) {
            $this->session->set_flashdata('sukses', 'Berhasil Mengubah Prestasi !');
            redirect('prestasi');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Mengubah Prestasi !');
            $this->index();
        }
    }

    public function hapus($id_prestasi)
    {
        if ($this->prestasi_model->hapus_prestasi($id_prestasi)) {
            $this->session->set_flashdata('sukses', 'Berhasil Menghapus Prestasi !');
            redirect('prestasi');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Menghapus Prestasi !');
            $this->index();
        }
    }
}
