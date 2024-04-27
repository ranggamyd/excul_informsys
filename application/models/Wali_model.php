<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Wali_model extends CI_Model
{
    public function semua_wali()
    {
        $this->db->join('users', 'users.id_wali = tbl_wali.id_wali', 'left');
        return $this->db->get('tbl_wali')->result_array();
    }

    public function wali($id)
    {
        $this->db->join('users', 'users.id_wali = tbl_wali.id_wali', 'left');
        return $this->db->get_where('tbl_wali', ['tbl_wali.id_wali' => $id])->row();
    }

    public function tambah_wali()
    {
        $config['upload_path']    = './assets/img/wali';
        $config['allowed_types']  = 'jpg|png|jpeg';
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            $fileName = $this->upload->data('file_name');
        } else {
            $fileName = 'default.jpg';
        }

        $wali = [
            'id_siswa' => $this->input->post('id_siswa'),
            'nama' => $this->input->post('nama'),
            'jk' => $this->input->post('jk'),
            'no_hp' => $this->input->post('no_hp'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'alamat' => $this->input->post('alamat'),
            'agama' => $this->input->post('agama'),
            'foto' => $fileName,
        ];

        if (!$this->db->insert('tbl_wali', $wali)) return FALSE;

        $id_wali = $this->db->insert_id();

        $user = [
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('username')),
            'id_wali' => $id_wali,
        ];

        if ($this->db->insert('users', $user)) return TRUE;
    }

    public function ubah_wali()
    {
        $id_wali = $this->input->post('id_wali');

        $fileName = $this->input->post('foto_lama');

        if ($this->input->post('foto')) {
            $config['upload_path']    = './assets/img/wali';
            $config['allowed_types']  = 'jpg|png|jpeg';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $fileName = $this->upload->data('file_name');

                $wali = $this->db->get_where('tbl_wali', ['id_wali' => $id_wali])->row();
                unlink('./assets/img/wali/' . $wali->foto);
            }
        }

        $wali = [
            'id_siswa' => $this->input->post('id_siswa'),
            'nama' => $this->input->post('nama'),
            'jk' => $this->input->post('jk'),
            'no_hp' => $this->input->post('no_hp'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'alamat' => $this->input->post('alamat'),
            'agama' => $this->input->post('agama'),
            'foto' => $fileName,
        ];

        if (!$this->db->update('tbl_wali', $wali, ['id_wali' => $id_wali])) return FALSE;

        $user = [
            'username' => $this->input->post('username'),
            'id_wali' => $id_wali,
        ];

        if ($this->input->post('password')) $user['password'] = md5($this->input->post('password'));

        if ($this->db->update('users', $user, ['id_wali' => $id_wali])) return TRUE;
    }

    public function hapus_wali($id_wali)
    {
        $wali = $this->db->get_where('tbl_wali', ['id_wali' => $id_wali])->row();
        unlink('./assets/img/wali/' . $wali->foto);

        if (!$this->db->delete('tbl_wali', ['id_wali' => $id_wali])) return FALSE;
        if ($this->db->delete('users', ['id_wali' => $id_wali])) return TRUE;
    }
}
