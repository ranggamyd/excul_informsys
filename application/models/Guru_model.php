<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Guru_model extends CI_Model
{
    public function semua_guru()
    {
        $this->db->join('users', 'users.id_admin = tbl_guru.id_guru', 'left');
        $this->db->order_by('nama', 'asc');
        return $this->db->get('tbl_guru')->result_array();
    }

    public function tambah_guru()
    {
        $guru = [
            'nama' => $this->input->post('nama'),
            'nip' => $this->input->post('nip'),
            'jk' => $this->input->post('jk'),
            'role' => $this->input->post('role'),
        ];

        if (!$this->db->insert('tbl_guru', $guru)) return FALSE;

        $user = [
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('username')),
            'id_admin' => $this->db->insert_id(),
        ];

        if ($this->db->insert('users', $user)) return TRUE;
    }

    public function ubah_guru()
    {
        $id_guru = $this->input->post('id_guru');

        $guru = [
            'nama' => $this->input->post('nama'),
            'nip' => $this->input->post('nip'),
            'jk' => $this->input->post('jk'),
            'role' => $this->input->post('role'),
        ];

        if (!$this->db->update('tbl_guru', $guru, ['id_guru' => $id_guru])) return FALSE;

        $user = [
            'username' => $this->input->post('username'),
            'id_admin' => $id_guru,
        ];

        if ($this->input->post('password')) $user['password'] = md5($this->input->post('password'));

        if ($this->db->insert('users', $user)) return TRUE;
    }

    public function hapus_guru($id_guru)
    {
        if (!$this->db->delete('tbl_guru', ['id_guru' => $id_guru])) return FALSE;
        if ($this->db->delete('users', ['id_admin' => $id_guru])) return TRUE;
    }
}
