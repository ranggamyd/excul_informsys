<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Eskul extends CI_Controller
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
    //     'css' => 'eskul.css',
    //     'js' => 'eskul.js',
    // ];

    $this->load->view('parts/header', $data);
    $this->load->view('' . $file, $data);
    $this->load->view('parts/footer', $data);
  }

  public function index()
  {
    $data['siswa'] = $this->siswa_model->semua_siswa();
    $data['guru'] = $this->guru_model->semua_guru();
    $data['eskul'] = $this->eskul_model->semua_eskul();

    $data['title'] = 'Data Ekstrakurikuler';
    $this->loadView('eskul', $data);
  }

  public function tambah()
  {
    $this->form_validation->set_rules('nama_eskul', 'Nama Eskul', 'is_unique[tbl_eskul.nama_eskul]');

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('gagal', 'Gagal Menambahkan Ekstrakurikuler !');
      $this->session->set_flashdata('hasModalID', 'tambah_eskul');
      $this->index();
    } else {
      if ($this->eskul_model->tambah_eskul()) {
        $this->session->set_flashdata('sukses', 'Berhasil Menambahkan Ekstrakurikuler !');
        redirect('eskul');
      } else {
        $this->session->set_flashdata('gagal', 'Gagal Menambahkan Ekstrakurikuler !');
        $this->index();
      }
    }
  }

  public function ubah()
  {
    $id_eskul = $this->input->post('id_eskul');
    $eskul = $this->db->get_where('tbl_eskul', ['id_eskul' => $id_eskul])->row();

    $this->form_validation->set_rules('nama_eskul', 'Nama Eskul', 'required');
    if ($this->input->post('nama_eskul') != $eskul->nama_eskul) $this->form_validation->set_rules('nama_eskul', 'Nama Eskul', 'is_unique[tbl_eskul.nama_eskul]');

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('gagal', 'Gagal Mengubah Ekstrakurikuler !');
      $this->session->set_flashdata('hasModalID', 'edit_eskul-' . $id_eskul);
      $this->index();
    } else {
      if ($this->eskul_model->ubah_eskul()) {
        $this->session->set_flashdata('sukses', 'Berhasil Mengubah Ekstrakurikuler !');
        redirect('eskul');
      } else {
        $this->session->set_flashdata('gagal', 'Gagal Mengubah Ekstrakurikuler !');
        $this->index();
      }
    }
  }

  public function hapus($id_eskul)
  {
    if ($this->eskul_model->hapus_eskul($id_eskul)) {
      $this->session->set_flashdata('sukses', 'Berhasil Menghapus Ekstrakurikuler !');
      redirect('eskul');
    } else {
      $this->session->set_flashdata('gagal', 'Gagal Menghapus Ekstrakurikuler !');
      $this->index();
    }
  }

  public function join()
  {
    if ($this->eskul_model->join_eskul()) {
      $this->session->set_flashdata('sukses', 'Berhasil Gabung !');
      redirect('eskul');
    } else {
      $this->session->set_flashdata('gagal', 'Gagal Gabung !');
      $this->index();
    }
  }
}
