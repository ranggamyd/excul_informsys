<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
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
        $data['style'] = [
            // 'css' => 'jadwal.css',
            // 'js' => 'jadwal.js',
        ];

        $this->load->view('parts/header', $data);
        $this->load->view('' . $file, $data);
        $this->load->view('parts/footer', $data);
    }

    public function index()
    {
        $data['jadwal'] = $this->jadwal_model->semua_jadwal();
        $data['eskul'] = $this->eskul_model->semua_eskul();

        $data['title'] = 'Jadwal Eskul';
        $this->loadView('jadwal', $data);
    }

    public function tambah()
    {
        if ($this->jadwal_model->tambah_jadwal()) {
            $this->session->set_flashdata('sukses', 'Berhasil Menambahkan Jadwal !');
            redirect('jadwal');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Menambahkan Jadwal !');
            $this->index();
        }
    }

    public function ubah()
    {
        if ($this->jadwal_model->ubah_jadwal()) {
            $this->session->set_flashdata('sukses', 'Berhasil Mengubah Jadwal !');
            redirect('jadwal');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Mengubah Jadwal !');
            $this->index();
        }
    }

    public function hapus($id_jadwal)
    {
        if ($this->jadwal_model->hapus_jadwal($id_jadwal)) {
            $this->session->set_flashdata('sukses', 'Berhasil Menghapus Jadwal !');
            redirect('jadwal');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Menghapus Jadwal !');
            $this->index();
        }
    }
}
