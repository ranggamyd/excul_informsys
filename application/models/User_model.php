<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
  public function users()
  {
    return $this->db->get('users')->result_array();
  }

  function user($id)
  {
    return $this->db->get_where('users', ['id' => $id])->row();
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
