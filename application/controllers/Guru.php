<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
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
        //     'css' => 'guru.css',
        //     'js' => 'guru.js',
        // ];

        $this->load->view('parts/header', $data);
        $this->load->view('' . $file, $data);
        $this->load->view('parts/footer', $data);
    }

    public function index()
    {
        $data['guru'] = $this->guru_model->semua_guru();

        $data['title'] = 'Data Guru';
        $this->loadView('guru', $data);
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nip', 'NIP', 'is_unique[tbl_guru.nip]');
        $this->form_validation->set_rules('username', 'Username', 'is_unique[users.username]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('gagal', 'Gagal Menambahkan Guru !');
            $this->session->set_flashdata('hasModalID', 'tambah_guru');
            $this->index();
        } else {
            if ($this->guru_model->tambah_guru()) {
                $this->session->set_flashdata('sukses', 'Berhasil Menambahkan Guru !');
                redirect('guru');
            } else {
                $this->session->set_flashdata('gagal', 'Gagal Menambahkan Guru !');
                $this->index();
            }
        }
    }

    public function ubah()
    {
        $id_guru = $this->input->post('id_guru');
        $guru = $this->db->get_where('tbl_guru', ['id_guru' => $id_guru])->row();
        $user = $this->db->get_where('users', ['id_admin' => $id_guru])->row();

        $this->form_validation->set_rules('nip', 'NIP', 'required');
        if ($this->input->post('nip') != $guru->nip) $this->form_validation->set_rules('nip', 'NIP', 'is_unique[tbl_guru.nip]');
        if ($this->input->post('username') != $user->username) $this->form_validation->set_rules('username', 'Username', 'is_unique[users.username]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('gagal', 'Gagal Mengubah Guru !');
            $this->session->set_flashdata('hasModalID', 'edit_guru-' . $id_guru);
            $this->index();
        } else {
            if ($this->guru_model->ubah_guru()) {
                $this->session->set_flashdata('sukses', 'Berhasil Mengubah Guru !');
                redirect('guru');
            } else {
                $this->session->set_flashdata('gagal', 'Gagal Mengubah Guru !');
                $this->index();
            }
        }
    }

    public function hapus($id_guru)
    {
        if ($this->guru_model->hapus_guru($id_guru)) {
            $this->session->set_flashdata('sukses', 'Berhasil Menghapus Guru !');
            redirect('guru');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Menghapus Guru !');
            $this->index();
        }
    }
}
