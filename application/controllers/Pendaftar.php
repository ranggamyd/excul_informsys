<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login_as') != 'admin') {
            $this->session->set_userdata('referred_from', current_url());
            $this->session->set_flashdata('gagal', 'Gagal mengakses, Silahkan login kembali !');
            redirect('auth');
        }
    }

    private function loadView($file, $data)
    {
        $data['style'] = [
            // 'css' => 'pendaftar.css',
            // 'js' => 'pendaftar.js',
        ];

        $this->load->view('parts/header', $data);
        $this->load->view('' . $file, $data);
        $this->load->view('parts/footer', $data);
    }

    public function index()
    {
        $data['pendaftar'] = $this->pendaftar_model->semua_pendaftar();
        $data['siswa'] = $this->siswa_model->semua_siswa();
        $data['eskul'] = $this->eskul_model->semua_eskul();

        $data['title'] = 'Data Pendaftar';
        $this->loadView('pendaftar', $data);
    }

    public function ubah()
    {
        if ($this->pendaftar_model->ubah_pendaftar()) {
            $this->session->set_flashdata('sukses', 'Berhasil Mengubah Pendaftaran !');
            redirect('pendaftar');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Mengubah Pendaftaran !');
            $this->index();
        }
    }

    public function hapus($id_pendaftar)
    {
        if ($this->pendaftar_model->hapus_pendaftar($id_pendaftar)) {
            $this->session->set_flashdata('sukses', 'Berhasil Menghapus Pendaftaran !');
            redirect('pendaftar');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Menghapus Pendaftaran !');
            $this->index();
        }
    }

    public function terima($id)
    {
        if ($this->pendaftar_model->terima($id)) {
            $this->session->set_flashdata('sukses', 'Berhasil Menerima Pendaftaran !');
            redirect('pendaftar');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Menerima Pendaftaran !');
            redirect('pendaftar');
        }
    }

    public function tolak($id)
    {
        if ($this->pendaftar_model->tolak($id)) {
            $this->session->set_flashdata('sukses', 'Berhasil Menolak Pendaftaran !');
            redirect('pendaftar');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Menolak Pendaftaran !');
            redirect('pendaftar');
        }
    }
}
