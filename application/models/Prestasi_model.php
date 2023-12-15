<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Prestasi_model extends CI_Model
{
    public function semua_prestasi()
    {
        $this->db->select('tbl_siswa.nama');
        $this->db->select('tbl_eskul.nama_eskul');
        $this->db->select('tbl_prestasi.*');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_prestasi.id_siswa', 'left');
        $this->db->join('tbl_eskul', 'tbl_eskul.id_eskul = tbl_prestasi.id_eskul', 'left');
        $this->db->order_by('id_prestasi', 'desc');
        return $this->db->get('tbl_prestasi')->result_array();
    }
    public function prestasi($id)
    {
        $this->db->select('tbl_siswa.nama');
        $this->db->select('tbl_eskul.nama_eskul');
        $this->db->select('tbl_prestasi.*');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_prestasi.id_siswa', 'left');
        $this->db->join('tbl_eskul', 'tbl_eskul.id_eskul = tbl_prestasi.id_eskul', 'left');
        $this->db->order_by('id_prestasi', 'desc');
        return $this->db->get_where('tbl_prestasi', ['id_prestasi' => $id])->row();
    }

    public function tambah_prestasi()
    {
        $config['upload_path']    = './assets/img/prestasi';
        $config['allowed_types']  = 'jpg|png|jpeg';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            $fileName = $this->upload->data('file_name');
        } else {
            $fileName = 'default.jpg';
        }

        $data = [
            'id_eskul' => $this->input->post('id_eskul'),
            'id_siswa' => $this->input->post('id_siswa'),
            'deskripsi' => $this->input->post('deskripsi'),
            'foto' => $fileName,
        ];

        if ($this->db->insert('tbl_prestasi', $data)) return TRUE;
    }

    public function ubah_prestasi()
    {
        $id_prestasi = $this->input->post('id_prestasi');

        $config['upload_path']    = './assets/img/prestasi';
        $config['allowed_types']  = 'jpg|png|jpeg';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            $fileName = $this->upload->data('file_name');

            $prestasi = $this->db->get_where('tbl_prestasi', ['id_prestasi' => $id_prestasi])->row();
            unlink('./assets/img/prestasi/' . $prestasi->foto);
        } else {
            $fileName = $this->input->post('foto_lama');
        }

        $data = [
            'id_eskul' => $this->input->post('id_eskul'),
            'id_siswa' => $this->input->post('id_siswa'),
            'deskripsi' => $this->input->post('deskripsi'),
            'foto' => $fileName,
        ];

        if ($this->db->update('tbl_prestasi', $data, ['id_prestasi' => $id_prestasi])) return TRUE;
    }

    public function hapus_prestasi($id_prestasi)
    {
        $prestasi = $this->db->get_where('tbl_prestasi', ['id_prestasi' => $id_prestasi])->row();
        unlink('./assets/img/prestasi/' . $prestasi->foto);

        if ($this->db->delete('tbl_prestasi', ['id_prestasi' => $id_prestasi])) return TRUE;
    }
}
