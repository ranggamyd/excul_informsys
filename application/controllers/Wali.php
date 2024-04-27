<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wali extends CI_Controller
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
        //     'css' => 'wali.css',
        //     'js' => 'wali.js',
        // ];

        $this->load->view('parts/header', $data);
        $this->load->view('' . $file, $data);
        $this->load->view('parts/footer', $data);
    }

    public function index()
    {
        $data['wali'] = $this->wali_model->semua_wali();
        $data['siswa'] = $this->siswa_model->semua_siswa();

        $data['title'] = 'Data Wali';
        $this->loadView('wali', $data);
    }

    public function tambah()
    {
        $this->form_validation->set_rules('username', 'Username', 'is_unique[users.username]');
        $this->form_validation->set_rules('foto', 'Foto', 'is_image[foto]|max_size[foto,2048]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('gagal', 'Gagal Menambahkan Wali !');
            $this->session->set_flashdata('hasModalID', 'tambah_wali');
            $this->index();
        } else {
            if ($this->wali_model->tambah_wali()) {
                $this->session->set_flashdata('sukses', 'Berhasil Menambahkan Wali !');
                redirect('wali');
            } else {
                $this->session->set_flashdata('gagal', 'Gagal Menambahkan Wali !');
                $this->index();
            }
        }
    }

    public function detail($id)
    {
        $data['wali'] = $this->wali_model->wali($id);

        $data['title'] = 'Detail Wali';
        $this->loadView('wali_detail', $data);
    }

    public function ubah()
    {
        $id_wali = $this->input->post('id_wali');
        $wali = $this->db->get_where('tbl_wali', ['id_wali' => $id_wali])->row();
        $user = $this->db->get_where('users', ['id_wali' => $id_wali])->row();

        if ($this->input->post('username') != $user->username) $this->form_validation->set_rules('username', 'Username', 'is_unique[users.username]');
        if ($this->input->post('foto')) $this->form_validation->set_rules('foto', 'Foto', 'is_image[foto]|max_size[foto,2048]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('gagal', 'Gagal Mengubah Wali !');
            $this->session->set_flashdata('hasModalID', 'edit_wali-' . $id_wali);
            $this->index();
        } else {
            if ($this->wali_model->ubah_wali()) {
                $this->session->set_flashdata('sukses', 'Berhasil Mengubah Wali !');
                redirect('wali');
            } else {
                $this->session->set_flashdata('gagal', 'Gagal Mengubah Wali !');
                $this->index();
            }
        }
    }

    public function hapus($id_wali)
    {
        if ($this->wali_model->hapus_wali($id_wali)) {
            $this->session->set_flashdata('sukses', 'Berhasil Menghapus Wali !');
            redirect('wali');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Menghapus Wali !');
            $this->index();
        }
    }
}
