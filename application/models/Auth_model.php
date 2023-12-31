<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	public function login()
	{
		$credential = $this->input->post('credential');
		$password = $this->input->post('password');

		// $this->db->where('is_active', 1);
		// $this->db->where('users.phone', $credential)->or_where('users.email', $credential);
		$this->db->where('users.username', $credential);
		$user = $this->db->get('users')->row();

		if (!$user) return FALSE;
		if (md5($password) != $user->password) return FALSE;
		if ($user->id_admin) {
			$this->session->set_userdata(['login_as' => 'admin']);
			$this->session->set_userdata(['id_admin' => $user->id_admin]);
			$this->session->set_userdata(['role' => $this->db->get_where('tbl_guru', ['id_guru' => $user->id_admin])->row('role')]);
		} elseif ($user->id_siswa) {
			$this->session->set_userdata(['login_as' => 'siswa']);
			$this->session->set_userdata(['id_siswa' => $user->id_siswa]);
		}

		$this->session->set_userdata(['id' => $user->id]);

		if ($this->session->has_userdata('id')) return TRUE;
	}

	public function current_user()
	{
		if ($this->session->has_userdata('id')) return TRUE;
	}

	public function logout()
	{
		$this->session->sess_destroy();
		if (!$this->session->has_userdata('id')) return TRUE;
	}

	// public function register()
	// {
	// 	$kd_supplier = $this->supplier_model->kd_supplier_auto();
	// 	$name = $this->input->post('name');
	// 	$phone = $this->input->post('phone');
	// 	$email = $this->input->post('email');
	// 	$password = md5($this->input->post('password1'));
	// 	// $avatar = 'default_avatar.jpg';

	// 	$supplier = [
	// 		'kd_supplier' => $kd_supplier,
	// 		'nama_miniplant' => $name,
	// 		'no_telp' => $phone,
	// 		'email' => $email,
	// 		// 'avatar' => $avatar
	// 	];

	// 	if (!$this->db->insert('suppliers', $supplier)) return FALSE;

	// 	$user = [
	// 		'name' => $name,
	// 		'phone' => $phone,
	// 		'email' => $email,
	// 		'password' => $password,
	// 		'kd_supplier' => $kd_supplier,
	// 		'is_active' => 0
	// 	];

	// 	$notifikasi = [
	// 		'kd_supplier' => $kd_supplier,
	// 		'type' => 'registrasi',
	// 		'pesan' => 'Supplier baru telah mendaftar, aktivasi sekarang?'
	// 	];

	// 	if (!$this->db->insert('notifikasi', $notifikasi)) return FALSE;

	// 	if ($this->db->insert('users', $user)) return TRUE;
	// }
}
