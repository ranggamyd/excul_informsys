<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengumuman_model extends CI_Model
{
    public function semua_pengumuman()
    {
        $this->db->order_by('id_pengumuman', 'desc');
        return $this->db->get('tbl_pengumuman')->result_array();
    }

    public function tambah_pengumuman()
    {
        $data = [
            'judul' => $this->input->post('judul'),
            'isi_pengumuman' => $this->input->post('isi_pengumuman'),
        ];

        if ($this->db->insert('tbl_pengumuman', $data)) return TRUE;
    }

    public function ubah_pengumuman()
    {
        $id_pengumuman = $this->input->post('id_pengumuman');

        $data = [
            'judul' => $this->input->post('judul'),
            'isi_pengumuman' => $this->input->post('isi_pengumuman'),
        ];

        if ($this->db->update('tbl_pengumuman', $data, ['id_pengumuman' => $id_pengumuman])) return TRUE;
    }

    public function hapus_pengumuman($id_pengumuman)
    {
        if ($this->db->delete('tbl_pengumuman', ['id_pengumuman' => $id_pengumuman])) return TRUE;
    }
}
