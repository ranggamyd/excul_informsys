<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Nilai_model extends CI_Model
{
    public function semua_nilai()
    {
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_nilai.id_siswa', 'left');
        $this->db->join('tbl_eskul', 'tbl_eskul.id_eskul = tbl_nilai.id_eskul', 'left');
        $this->db->order_by('id_nilai', 'desc');
        return $this->db->get('tbl_nilai')->result_array();
    }

    public function nilai_siswa($id)
    {
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_nilai.id_siswa', 'left');
        $this->db->join('tbl_eskul', 'tbl_eskul.id_eskul = tbl_nilai.id_eskul', 'left');
        $this->db->order_by('id_nilai', 'desc');
        return $this->db->get_where('tbl_nilai', ['tbl_nilai.id_siswa' => $id])->result_array();
    }

    public function tambah_nilai()
    {
        $data = [
            'id_siswa' => $this->input->post('id_siswa'),
            'id_eskul' => $this->input->post('id_eskul'),
            'skor' => $this->input->post('skor'),
        ];

        if ($this->db->insert('tbl_nilai', $data)) return TRUE;
    }

    public function ubah_nilai()
    {
        $id_nilai = $this->input->post('id_nilai');

        $data = [
            'id_siswa' => $this->input->post('id_siswa'),
            'id_eskul' => $this->input->post('id_eskul'),
            'skor' => $this->input->post('skor'),
        ];

        if ($this->db->update('tbl_nilai', $data, ['id_nilai' => $id_nilai])) return TRUE;
    }

    public function hapus_nilai($id_nilai)
    {
        if ($this->db->delete('tbl_nilai', ['id_nilai' => $id_nilai])) return TRUE;
    }
}
