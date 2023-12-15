<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilai extends CI_Controller
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
        //     'css' => 'nilai.css',
        //     'js' => 'nilai.js',
        // ];

        $this->load->view('parts/header', $data);
        $this->load->view('' . $file, $data);
        $this->load->view('parts/footer', $data);
    }

    public function index()
    {
        if ($this->session->userdata('login_as') == 'siswa') {
            $data['nilai'] = $this->nilai_model->nilai_siswa($this->session->userdata('id_siswa'));
        } else {
            $data['nilai'] = $this->nilai_model->semua_nilai();
        };

        $data['siswa'] = $this->siswa_model->semua_siswa();
        $data['eskul'] = $this->eskul_model->semua_eskul();

        $data['title'] = 'Data Nilai';
        $this->loadView('nilai', $data);
    }

    public function tambah()
    {
        if ($this->nilai_model->tambah_nilai()) {
            $this->session->set_flashdata('sukses', 'Berhasil Menambahkan Nilai !');
            redirect('nilai');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Menambahkan Nilai !');
            $this->index();
        }
    }

    public function ubah()
    {
        if ($this->nilai_model->ubah_nilai()) {
            $this->session->set_flashdata('sukses', 'Berhasil Mengubah Nilai !');
            redirect('nilai');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Mengubah Nilai !');
            $this->index();
        }
    }

    public function hapus($id_nilai)
    {
        if ($this->nilai_model->hapus_nilai($id_nilai)) {
            $this->session->set_flashdata('sukses', 'Berhasil Menghapus Nilai !');
            redirect('nilai');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Menghapus Nilai !');
            $this->index();
        }
    }
}
