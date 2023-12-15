<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
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
    //     'css' => 'users.css',
    //     'js' => 'users.js',
    // ];

    $this->load->view('parts/header', $data);
    $this->load->view('' . $file, $data);
    $this->load->view('parts/footer', $data);
  }

  // public function index()
  // {
  //   $data['users'] = $this->user_model->users();

  //   $data['title'] = 'Daftar Pengguna';
  //   $this->loadView('users', $data);
  // }

  public function detail($id)
  {
    $user = $this->user_model->user($id);

    $data['user'] = $user;
    $data['title'] = 'Profil Saya';

    if ($user->id_admin) {
      $data['guru'] = $this->db->get_where('tbl_guru', ['id_guru' => $user->id_admin])->row();
      $this->loadView('admin_detail', $data);
    }

    if ($user->id_siswa) {
      $data['siswa'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $user->id_siswa])->row();
      $this->loadView('siswa_detail', $data);
    }
  }

  public function kartu_anggota($id)
  {
    $this->user_model->generate_kartu($id);
  }
}
