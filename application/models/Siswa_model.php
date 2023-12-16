<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
    public function semua_siswa()
    {
        $this->db->join('users', 'users.id_siswa = tbl_siswa.id_siswa', 'left');
        $this->db->order_by('nis', 'desc');
        return $this->db->get('tbl_siswa')->result_array();
    }

    public function siswa($id)
    {
        $this->db->join('users', 'users.id_siswa = tbl_siswa.id_siswa', 'left');
        return $this->db->get_where('tbl_siswa', ['tbl_siswa.id_siswa' => $id])->row();
    }

    public function tambah_siswa()
    {
        $nis = $this->input->post('nis');

        $config['upload_path']    = './assets/img/siswa';
        $config['allowed_types']  = 'jpg|png|jpeg';
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            $fileName = $this->upload->data('file_name');
        } else {
            $fileName = 'default.jpg';
        }

        $this->load->library('ciqrcode');

        header("Content-Type: image/png");
        $params['data'] = $nis;
        $params['size'] = 9;
        $params['savename'] = FCPATH . 'assets/img/siswa/qr/' . $nis . '.png';
        $this->ciqrcode->generate($params);

        $siswa = [
            'nama' => $this->input->post('nama'),
            'nis' => $nis,
            'jk' => $this->input->post('jk'),
            'kelas' => $this->input->post('kelas'),
            'jurusan' => $this->input->post('jurusan'),
            'no_hp' => $this->input->post('no_hp'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'alamat' => $this->input->post('alamat'),
            'agama' => $this->input->post('agama'),
            'foto' => $fileName,
            'qr_code' => $nis . '.png',
        ];

        if (!$this->db->insert('tbl_siswa', $siswa)) return FALSE;

        $id_siswa = $this->db->insert_id();

        $kartu_anggota = $this->generate_kartu($id_siswa);

        if (!$this->db->update('tbl_siswa', ['kartu_anggota' => $kartu_anggota], ['id_siswa' => $id_siswa])) return FALSE;

        $user = [
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('username')),
            'id_siswa' => $id_siswa,
        ];

        if ($this->db->insert('users', $user)) return TRUE;
    }

    public function ubah_siswa()
    {
        $id_siswa = $this->input->post('id_siswa');
        $nis = $this->input->post('nis');

        $config['upload_path']    = './assets/img/siswa';
        $config['allowed_types']  = 'jpg|png|jpeg';
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            $fileName = $this->upload->data('file_name');

            $siswa = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row();
            unlink('./assets/img/siswa/' . $siswa->foto);
        } else {
            $fileName = $this->input->post('foto_lama');
        }

        $this->load->library('ciqrcode');

        header("Content-Type: image/png");
        $params['data'] = $nis;
        $params['size'] = 9;
        $params['savename'] = FCPATH . 'assets/img/siswa/qr/' . $nis . '.png';
        $this->ciqrcode->generate($params);

        $siswa = [
            'nama' => $this->input->post('nama'),
            'nis' => $nis,
            'jk' => $this->input->post('jk'),
            'kelas' => $this->input->post('kelas'),
            'jurusan' => $this->input->post('jurusan'),
            'no_hp' => $this->input->post('no_hp'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'alamat' => $this->input->post('alamat'),
            'agama' => $this->input->post('agama'),
            'foto' => $fileName,
            'qr_code' => $nis . '.png',
        ];

        if (!$this->db->update('tbl_siswa', $siswa, ['id_siswa' => $id_siswa])) return FALSE;

        $kartu_anggota = $this->generate_kartu($id_siswa);

        if (!$this->db->update('tbl_siswa', ['kartu_anggota' => $kartu_anggota], ['id_siswa' => $id_siswa])) return FALSE;

        $user = [
            'username' => $this->input->post('username'),
            'id_siswa' => $id_siswa,
        ];

        if ($this->input->post('password')) $user['password'] = md5($this->input->post('password'));

        if ($this->db->update('users', $user, ['id_siswa' => $id_siswa])) return TRUE;
    }

    public function hapus_siswa($id_siswa)
    {
        $siswa = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row();
        unlink('./assets/img/siswa/' . $siswa->foto);

        if (!$this->db->delete('tbl_siswa', ['id_siswa' => $id_siswa])) return FALSE;
        if ($this->db->delete('users', ['id_siswa' => $id_siswa])) return TRUE;
    }

    public function generate_kartu($id)
    {
        $siswa = $this->db->get_where('tbl_siswa', ['id_siswa' => $id])->row();

        $font = APPPATH . '..\assets\fonts\TNR.TTF';
        // $image = imagecreatefromjpeg(base_url('assets/img/kartu_anggota_template/kartu_depan.jpg'));

        $backgroundImagePath = base_url('assets/img/kartu_anggota_template/kartu_depan.jpg');
        $foregroundImagePath = base_url('assets/img/siswa/' . $siswa->foto);

        $backgroundImage = imagecreatefromstring(file_get_contents($backgroundImagePath));
        $foregroundImage = imagecreatefromstring(file_get_contents($foregroundImagePath));

        $foregroundWidth = imagesx($foregroundImage);
        $foregroundHeight = imagesy($foregroundImage);

        $cropWidth = 394;
        $cropHeight = 539;

        $cropX = ($foregroundWidth - $cropWidth) / 2;
        $cropY = ($foregroundHeight - $cropHeight) / 2;

        $croppedForeground = imagecrop($foregroundImage, ['x' => $cropX, 'y' => $cropY, 'width' => $cropWidth, 'height' => $cropHeight]);

        imagecopymerge($backgroundImage, $croppedForeground, 66, 335, 0, 0, $cropWidth, $cropHeight, 100);

        $color = imagecolorallocate($backgroundImage, 255, 255, 255);
        imagettftext($backgroundImage, 31, 0, 950, 441, $color, $font, $siswa->nama);
        imagettftext($backgroundImage, 31, 0, 950, 518, $color, $font, $siswa->nis);
        imagettftext($backgroundImage, 31, 0, 950, 598, $color, $font, $siswa->kelas . ' / ' . $siswa->jurusan);
        imagettftext($backgroundImage, 31, 0, 950, 670, $color, $font, $siswa->jk ?: '-');
        imagettftext($backgroundImage, 31, 0, 950, 743, $color, $font, $siswa->tempat_lahir && $siswa->tanggal_lahir ? $siswa->tempat_lahir . ', ' . date('d-m-Y', strtotime($siswa->tanggal_lahir)) : '-');
        imagettftext($backgroundImage, 31, 0, 950, 806, $color, $font, $siswa->alamat ?: '-');
        imagettftext($backgroundImage, 31, 0, 950, 874, $color, $font, $siswa->agama ?: '-');
        imagettftext($backgroundImage, 31, 0, 950, 945, $color, $font, '-');
        imagettftext($backgroundImage, 31, 0, 400, 1079, $color, $font, '-');

        $QRCodeImage = imagecreatefromstring(file_get_contents(base_url('assets/img/siswa/qr/' . $siswa->qr_code)));

        imagecopymerge($backgroundImage, $QRCodeImage, 1209, 895, 0, 0, 220, 220, 100);

        $fileName = $siswa->nis;

        $output = APPPATH . '../assets/img/kartu_anggota/' . $fileName;
        imagejpeg($backgroundImage, $output . '.jpg');

        $this->load->library('Pdf');

        $pdf = new FPDF('L');

        // KARTU DEPAN
        $pdf->AddPage();
        $pdf->Image($output . '.jpg', 0, 0, 297);

        // KARTU BELAKANG
        $pdf->AddPage();
        $pdf->Image(base_url('assets/img/kartu_anggota_template/kartu_belakang.jpg'), 0, 0, 297);

        $title = 'Kartu Anggota - ' . $siswa->nama;
        $pdf->SetTitle($title);
        $pdf->SetAuthor('SMK Manbaul Ulum Cirebon');
        $pdf->Output($output . '.pdf', 'F');

        return $fileName;
    }
}
