<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengumuman extends CI_Controller
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
        //     'css' => 'pengumuman.css',
        //     'js' => 'pengumuman.js',
        // ];

        $this->load->view('parts/header', $data);
        $this->load->view('' . $file, $data);
        $this->load->view('parts/footer', $data);
    }

    public function index()
    {
        $data['pengumuman'] = $this->pengumuman_model->semua_pengumuman();

        $data['title'] = 'Data Pengumuman';

        if ($this->session->userdata('login_as') == 'siswa') {
            $this->loadView('pengumuman_siswa', $data);
        } else {
            $this->loadView('pengumuman', $data);
        }
    }

    public function tambah()
    {
        if ($this->pengumuman_model->tambah_pengumuman()) {
            $this->session->set_flashdata('sukses', 'Berhasil Menambahkan Pengumuman !');
            redirect('pengumuman');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Menambahkan Pengumuman !');
            $this->index();
        }
    }

    public function ubah()
    {
        if ($this->pengumuman_model->ubah_pengumuman()) {
            $this->session->set_flashdata('sukses', 'Berhasil Mengubah Pengumuman !');
            redirect('pengumuman');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Mengubah Pengumuman !');
            $this->index();
        }
    }

    public function hapus($id_pengumuman)
    {
        if ($this->pengumuman_model->hapus_pengumuman($id_pengumuman)) {
            $this->session->set_flashdata('sukses', 'Berhasil Menghapus Pengumuman !');
            redirect('pengumuman');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Menghapus Pengumuman !');
            $this->index();
        }
    }
}
