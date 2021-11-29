<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_model extends CI_Model{

    public function divisi()
    {
        $this->db->order_by('divisi', 'ASC');
        return $this->db->get('divisi')->result_array();
    }

  public function tambahdivisi()
  {
      $data = [
          'divisi' => strtoupper($this->input->post('divisi')),
      ];

      $this->db->insert('divisi', $data);

      $data2 =[
        'divisi' => strtoupper($this->input->post('divisi')),
        'waktuisi' => 22,
      ];

      $this->db->insert('waktuisi', $data2);
  }

  public function editdivisi()
  {
      $divisi = $this->db->get_where('divisi', ['id_divisi' => $this->input->post('id_divisi')])->row_array();

      $data = [
          'divisi' => strtoupper($this->input->post('divisi')),
      ];

      $this->db->update('tb_user', $data, ['divisi' => $divisi['divisi']]);
      $this->db->update('divisi', $data, ['id_divisi' => $this->input->post('id_divisi')]);
  }

  public function hapusdivisi($id)
  {

      $this->db->delete('divisi', ['id_divisi' => $id]);
  }

  public function karyawan()
  {
      $this->db->order_by('nama_user', 'ASC');
      return $this->db->get_where('tb_user', ['hak_akses!=' => 'Direksi', 'resign'=>0, 'aktif'=> 'Y',])->result_array();
  }

  public function karyawanlain()
  {
      $this->db->order_by('jabatan1', 'ASC');
      $this->db->order_by('nama_user', 'ASC');
      return $this->db->get_where('tb_user', ['hak_akses!=' => 'Direksi', 'resign'=>0, 'jabatan1!=' => null])->result_array();
  }

  public function karyawanlain2()
  {
      $this->db->order_by('jabatan2', 'ASC');
      $this->db->order_by('nama_user', 'ASC');
      return $this->db->get_where('tb_user', ['hak_akses!=' => 'Direksi', 'resign'=>0, 'jabatan2!=' => null])->result_array();
  }

  public function tambahkaryawan()
  {
      $id_user  = $this->input->post('id_user');

      for ($i=0; $i < count($id_user); $i++) {
          $cek = $this->db->get_where('tb_user',  ['id_user'=>$id_user[$i]])->row_array();

          if($cek['divisi'] == '' or $cek['jabatan1']==''){
            $data = [
                    'jabatan1' => $this->input->post('jabatan'),
                    'divisi' => $this->input->post('divisi'),
                    'atasan' => $this->input->post('atasan')

            ];
          } else {
              $data = [
                'jabatan2' => $this->input->post('jabatan'),
                'divisi2' => $this->input->post('divisi'),
                'atasan' => $this->input->post('atasan')

              ];
          }

          $this->db->update('tb_user', $data, ['id_user'=>$id_user[$i]]);
      }
  }

  public function editkaryawan()
  {
      $data = [
          'jabatan1' => $this->input->post('jabatan'),
          'divisi' => $this->input->post('divisi'),
          'atasan' => $this->input->post('atasan'),
          'izinbackdate' => $this->input->post('backdate')
      ];

      $this->db->update('tb_user', $data, ['id_user'=>$this->input->post('id_user')]);
  }

  public function hapuskaryawan($id)
  {
      $data = [
          'jabatan1' => null,
          'divisi' => null,
          'atasan' => null,
          'aktif' => 'N'
      ];

      $this->db->update('tb_user', $data, ['id_user'=>$id]);
  }

  public function hapuskaryawan2($id)
  {
      $data = [
          'jabatan2' => null,
          'divisi2' => null
      ];

      $this->db->update('tb_user', $data, ['id_user'=>$id]);
  }

  public function kategori()
  {
      $divisi = $this->session->userdata('ses_divisi');
      // return $this->db->order_by('nama_kategori', 'ASC')->result_array();
      // return $this->db->get_where('kategori', ['divisi'=>$divisi])->result_array();
      return $this->db->query("SELECT * FROM kategori ORDER BY nama_kategori ASC")->result_array();
  }

  public function tambahkategori()
  {
      $data = [
        'nama_kategori' => strtoupper($this->input->post('nama_kategori')),
        'divisi' => $this->session->userdata('ses_divisi'),
      ];

      $cek = $this->db->get_where('kategori', $data)->row_array();

      if($cek == 0){
          $this->db->insert('kategori', $data);
      }
  }

  public function editkategori()
  {
      $data = [
        'nama_kategori' => strtoupper($this->input->post('nama_kategori')),
        'divisi' => $this->session->userdata('ses_divisi'),
      ];

      $cek = $this->db->get_where('kategori', $data)->row_array();

      if($cek == 0){
          $this->db->update('kategori', $data, ['id_kategori' => $this->input->post('id_kategori')]);
      }
  }


  public function hapuskategori($id)
  {
      $this->db->delete('kategori', ['id_kategori' => $id]);
  }

  public function hapuspanduan($id)
  {
      $this->db->delete('panduan', ['id' => $id]);
  }

}
