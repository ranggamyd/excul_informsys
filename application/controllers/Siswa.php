<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
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
        // $data['style'] = [
        //     'css' => 'siswa.css',
        //     'js' => 'siswa.js',
        // ];

        $this->load->view('parts/header', $data);
        $this->load->view('' . $file, $data);
        $this->load->view('parts/footer', $data);
    }

    public function index()
    {
        $data['siswa'] = $this->siswa_model->semua_siswa();

        $data['title'] = 'Data Siswa';
        $this->loadView('siswa', $data);
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nis', 'NIS', 'is_unique[tbl_siswa.nis]');
        $this->form_validation->set_rules('username', 'Username', 'is_unique[users.username]');
        $this->form_validation->set_rules('foto', 'Foto', 'is_image[foto]|max_size[foto,2048]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('gagal', 'Gagal Menambahkan Siswa !');
            $this->session->set_flashdata('hasModalID', 'tambah_siswa');
            $this->index();
        } else {
            if ($this->siswa_model->tambah_siswa()) {
                $this->session->set_flashdata('sukses', 'Berhasil Menambahkan Siswa !');
                redirect('siswa');
            } else {
                $this->session->set_flashdata('gagal', 'Gagal Menambahkan Siswa !');
                $this->index();
            }
        }
    }

    public function detail($id)
    {
        $data['siswa'] = $this->siswa_model->siswa($id);

        $data['title'] = 'Detail Siswa';
        $this->loadView('siswa_detail', $data);
    }

    public function ubah()
    {
        $id_siswa = $this->input->post('id_siswa');
        $siswa = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row();
        $user = $this->db->get_where('users', ['id_siswa' => $id_siswa])->row();

        $this->form_validation->set_rules('nis', 'NIS', 'required');
        if ($this->input->post('nis') != $siswa->nis) $this->form_validation->set_rules('nis', 'NIS', 'is_unique[tbl_siswa.nis]');
        if ($this->input->post('username') != $user->username) $this->form_validation->set_rules('username', 'Username', 'is_unique[users.username]');
        if ($this->input->post('foto')) $this->form_validation->set_rules('foto', 'Foto', 'is_image[foto]|max_size[foto,2048]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('gagal', 'Gagal Mengubah Siswa !');
            $this->session->set_flashdata('hasModalID', 'edit_siswa-' . $id_siswa);
            $this->index();
        } else {
            if ($this->siswa_model->ubah_siswa()) {
                $this->session->set_flashdata('sukses', 'Berhasil Mengubah Siswa !');
                redirect('siswa');
            } else {
                $this->session->set_flashdata('gagal', 'Gagal Mengubah Siswa !');
                $this->index();
            }
        }
    }

    public function hapus($id_siswa)
    {
        if ($this->siswa_model->hapus_siswa($id_siswa)) {
            $this->session->set_flashdata('sukses', 'Berhasil Menghapus Siswa !');
            redirect('siswa');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Menghapus Siswa !');
            $this->index();
        }
    }
}
