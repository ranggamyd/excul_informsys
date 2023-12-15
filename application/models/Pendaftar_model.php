<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftar_model extends CI_Model
{
    public function semua_pendaftar()
    {
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pendaftaran.id_siswa', 'left');
        $this->db->join('tbl_eskul', 'tbl_eskul.id_eskul = tbl_pendaftaran.id_eskul', 'left');
        $this->db->order_by('id_pendaftaran', 'desc');
        return $this->db->get('tbl_pendaftaran')->result_array();
    }

    public function ubah_pendaftar()
    {
        $id_pendaftaran = $this->input->post('id_pendaftaran');

        $data = [
            'id_siswa' => $this->input->post('id_siswa'),
            'id_eskul' => $this->input->post('id_eskul'),
            'tanggal' => $this->input->post('tanggal'),
            'status' => $this->input->post('status'),
        ];

        if ($this->db->update('tbl_pendaftaran', $data, ['id_pendaftaran' => $id_pendaftaran])) return TRUE;
    }

    public function hapus_pendaftar($id_pendaftaran)
    {
        if ($this->db->delete('tbl_pendaftaran', ['id_pendaftaran' => $id_pendaftaran])) return TRUE;
    }

    public function terima($id)
    {
        if ($this->db->update('tbl_pendaftaran', ['status' => 'diterima'], ['id_pendaftaran' => $id])) return TRUE;
    }

    public function tolak($id)
    {
        if ($this->db->update('tbl_pendaftaran', ['status' => 'ditolak'], ['id_pendaftaran' => $id])) return TRUE;
    }
}
