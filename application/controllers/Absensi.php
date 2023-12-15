<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
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
        //     'css' => 'absensi.css',
        //     'js' => 'absensi.js',
        // ];

        $this->load->view('parts/header', $data);
        $this->load->view('' . $file, $data);
        $this->load->view('parts/footer', $data);
    }

    public function index()
    {
        if ($this->session->userdata('login_as') == 'siswa') {
            $data['absensi'] = $this->absensi_model->absensi_siswa($this->session->userdata('id_siswa'));
        } else {
            $data['absensi'] = $this->absensi_model->semua_absensi();
        };

        $data['siswa'] = $this->siswa_model->semua_siswa();

        $data['title'] = 'Data Absensi';
        $this->loadView('absensi', $data);
    }

    public function tambah_absensi()
    {
        $data['siswa'] = $this->siswa_model->semua_siswa();

        $data['title'] = 'Scan/Tambah Absensi';
        $this->loadView('scan_absensi', $data);
    }

    public function tambah()
    {
        if ($this->absensi_model->tambah_absensi()) {
            $this->session->set_flashdata('sukses', 'Berhasil Menambahkan Absensi !');

            $siswa = $this->db->get_where('tbl_siswa', ['id_siswa' => $this->input->post('id_siswa')])->row();

            $this->load->library('whatsapp_notification');
            $to = $siswa->no_hp;
            $message = "🎉 Hai $siswa->nama! Selamat, absensi kamu berhasil tercatat. Tetap semangat mengikuti ekstrakulikuler hari ini! Jangan lupa untuk selalu hadir dan aktif dalam setiap kegiatan. Semoga harimu menyenangkan dan penuh prestasi! 💪✨";
            $this->whatsapp_notification->send_whatsapp_message($to, $message);

            redirect('absensi/tambah_absensi');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Menambahkan Absensi !');
            $this->tambah_absensi();
        }
    }

    public function ubah()
    {
        if ($this->absensi_model->ubah_absensi()) {
            $this->session->set_flashdata('sukses', 'Berhasil Mengubah Absensi !');
            redirect('absensi');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Mengubah Absensi !');
            $this->index();
        }
    }

    public function hapus($id_absensi)
    {
        if ($this->absensi_model->hapus_absensi($id_absensi)) {
            $this->session->set_flashdata('sukses', 'Berhasil Menghapus Absensi !');
            redirect('absensi');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Menghapus Absensi !');
            $this->index();
        }
    }
}
