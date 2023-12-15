<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Absensi_model extends CI_Model
{
    public function semua_absensi()
    {
        $this->db->select('tbl_siswa.nama');
        $this->db->select('tbl_absensi.*');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_absensi.id_siswa', 'left');
        $this->db->order_by('id_absensi', 'desc');
        return $this->db->get('tbl_absensi')->result_array();
    }

    public function absensi_siswa($id)
    {
        $this->db->select('tbl_siswa.nama');
        $this->db->select('tbl_absensi.*');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_absensi.id_siswa', 'left');
        $this->db->order_by('id_absensi', 'desc');
        return $this->db->get_where('tbl_absensi', ['tbl_absensi.id_siswa' => $id])->result_array();
    }

    public function tambah_absensi()
    {
        $config['upload_path']    = './assets/img/absensi';
        $config['allowed_types']  = 'jpg|png|jpeg';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            $fileName = $this->upload->data('file_name');
        } else {
            $fileName = 'default.jpg';
        }

        $data = [
            'id_siswa' => $this->input->post('id_siswa'),
            'tanggal_waktu' => $this->input->post('tanggal_waktu'),
            'keterangan' => $this->input->post('keterangan'),
            'foto' => $fileName,
        ];

        if ($this->db->insert('tbl_absensi', $data)) return TRUE;
    }

    public function ubah_absensi()
    {
        $id_absensi = $this->input->post('id_absensi');

        $config['upload_path']    = './assets/img/absensi';
        $config['allowed_types']  = 'jpg|png|jpeg';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            $fileName = $this->upload->data('file_name');

            $absensi = $this->db->get_where('tbl_absensi', ['id_absensi' => $id_absensi])->row();
            unlink('./assets/img/absensi/' . $absensi->foto);
        } else {
            $fileName = $this->input->post('foto_lama');
        }

        $data = [
            'id_siswa' => $this->input->post('id_siswa'),
            'tanggal_waktu' => $this->input->post('tanggal_waktu'),
            'keterangan' => $this->input->post('keterangan'),
            'foto' => $fileName,
        ];

        if ($this->db->update('tbl_absensi', $data, ['id_absensi' => $id_absensi])) return TRUE;
    }

    public function hapus_absensi($id_absensi)
    {
        $absensi = $this->db->get_where('tbl_absensi', ['id_absensi' => $id_absensi])->row();
        unlink('./assets/img/absensi/' . $absensi->foto);

        if ($this->db->delete('tbl_absensi', ['id_absensi' => $id_absensi])) return TRUE;
    }
}
