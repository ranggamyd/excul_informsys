<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Eskul_model extends CI_Model
{
    public function semua_eskul()
    {
        $this->db->order_by('nama_eskul', 'asc');
        return $this->db->get('tbl_eskul')->result_array();
    }

    public function tambah_eskul()
    {
        $data = [
            'nama_eskul' => $this->input->post('nama_eskul'),
            'id_ketua' => $this->input->post('id_ketua'),
            'id_pembina' => $this->input->post('id_pembina'),
            'id_kesiswaan' => $this->input->post('id_kesiswaan'),
        ];

        if ($this->db->insert('tbl_eskul', $data)) return TRUE;
    }

    public function ubah_eskul()
    {
        $data = [
            'nama_eskul' => $this->input->post('nama_eskul'),
            'id_ketua' => $this->input->post('id_ketua'),
            'id_pembina' => $this->input->post('id_pembina'),
            'id_kesiswaan' => $this->input->post('id_kesiswaan'),
        ];

        if ($this->db->update('tbl_eskul', $data, ['id_eskul' => $this->input->post('id_eskul')])) return TRUE;
    }

    public function hapus_eskul($id_eskul)
    {
        if ($this->db->delete('tbl_eskul', ['id_eskul' => $id_eskul])) return TRUE;
    }

    public function join_eskul()
    {
        $data = [
            'id_eskul' => $this->input->post('id_eskul'),
            'id_siswa' => $this->input->post('id_siswa'),
            'tanggal' => $this->input->post('tanggal'),
        ];

        if ($this->db->insert('tbl_pendaftaran', $data)) return TRUE;
    }
}
