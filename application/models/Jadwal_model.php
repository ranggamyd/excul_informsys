<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_model extends CI_Model
{
    public function semua_jadwal()
    {
        $this->db->join('tbl_eskul', 'tbl_eskul.id_eskul = tbl_jadwal.id_eskul', 'left');
        $this->db->order_by('id_jadwal', 'desc');
        return $this->db->get('tbl_jadwal')->result_array();
    }

    public function tambah_jadwal()
    {
        $data = [
            'id_eskul' => $this->input->post('id_eskul'),
            'tanggal' => $this->input->post('tanggal'),
            'jam_mulai' => $this->input->post('jam_mulai'),
            'jam_selesai' => $this->input->post('jam_selesai'),
            'tempat' => $this->input->post('tempat'),
            'periode' => $this->input->post('periode'),
        ];

        if ($this->db->insert('tbl_jadwal', $data)) return TRUE;
    }

    public function ubah_jadwal()
    {
        $id_jadwal = $this->input->post('id_jadwal');

        $data = [
            'id_eskul' => $this->input->post('id_eskul'),
            'tanggal' => $this->input->post('tanggal'),
            'jam_mulai' => $this->input->post('jam_mulai'),
            'jam_selesai' => $this->input->post('jam_selesai'),
            'tempat' => $this->input->post('tempat'),
            'periode' => $this->input->post('periode'),
        ];

        if ($this->db->update('tbl_jadwal', $data, ['id_jadwal' => $id_jadwal])) return TRUE;
    }

    public function hapus_jadwal($id_jadwal)
    {
        if ($this->db->delete('tbl_jadwal', ['id_jadwal' => $id_jadwal])) return TRUE;
    }
}
