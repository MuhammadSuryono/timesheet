<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Struktur_model extends CI_Model{

    public function direksi()
    {
        $user = $this->session->userdata('ses_username');
        return $this->db->query("SELECT * FROM tb_user WHERE hak_akses = 'Direksi' and resign=0 and id_user!='$user' and id_user !='dummy' order by nama_user ASC")->result_array();
    }

    public function karyawan()
    {
        if($this->session->userdata('ses_akses')=='Direksi'){
            $user = $this->session->userdata('ses_username');
            return $this->db->query("SELECT * FROM tb_user WHERE (atasan is null or atasan != '$user') and hak_akses = 'Manager' and resign=0 order by nama_user ASC")->result_array();

        // } elseif($this->session->userdata('ses_akses')=='Manager'){

        //     $divisi = $this->session->userdata('ses_divisi');
        //     return $this->db->query("SELECT * from tb_user where atasan is null and (hak_akses='Pegawai' or hak_akses = 'Pegawai2') and divisi = '$divisi' and resign=0 order by nama_user ASC")->result_array();

        } else {
            return $this->db->query("SELECT * FROM tb_user WHERE hak_akses != 'Direksi' and resign=0 order by nama_user ASC")->result_array();
        }
    }

    public function tambah()
    {
        $karyawan = $this->input->post('karyawan');

        for ($i=0; $i < count($karyawan) ; $i++) {
            
            // UPDATE MANAGER
            $data = [
                'atasan' => $this->input->post('direksi'),
            ];

            $this->db->update('tb_user', $data, ['id_user' => $karyawan[$i]]);
            // AKHIR

            // UPDATE STAFF
            $divisi = $this->db->get_where('tb_user', ['id_user' => $karyawan[$i]])->row_array();
            $div = $divisi['divisi'];
            $staff = $this->db->query("SELECT id_user from tb_user where divisi = '$div' and (hak_akses = 'Pegawai' or hak_akses = 'Pegawai2') and resign=0")->result_array();

            foreach ($staff as $key => $db) {
               $data = [
                    'atasan' => $karyawan[$i],
               ];

               $this->db->update('tb_user', $data, ['id_user' => $db['id_user']]);
            }
            // AKHIR

        }
    }

    public function manager()
    {
        if($this->session->userdata('ses_akses')=='Pegawai' or $this->session->userdata('ses_akses')=='Pegawai2'){

            $divisi = $this->session->userdata('ses_divisi');
            return $this->db->query("SELECT * from tb_user where atasan is not null and (hak_akses='Pegawai' or hak_akses = 'Pegawai2') and divisi = '$divisi' and resign=0 order by nama_user ASC")->result_array();

        } else {

            $this->db->order_by('nama_user', 'ASC');
            return $this->db->get_where('tb_user', ['atasan' => $this->session->userdata('ses_username')])->result_array();

        }
    }

    public function managerlain()
    {
        $this->db->order_by('nama_user', 'ASC');
        return $this->db->get_where('tb_user', ['atasan!=' => $this->session->userdata('ses_username'), 'hak_akses'=>'Manager', 'resign'=>0])->result_array();
    }

    public function staff()
    {
        return $this->db->query("SELECT * from tb_user where atasan is not null and (hak_akses='Pegawai' or hak_akses = 'Pegawai2') and resign=0 order by nama_user ASC")->result_array();
    }

    public function hapus($id)
    {
        $data = [
            'atasan' => null
        ];

        $this->db->update('tb_user', $data, ['id_user' => $id]);
    }

    public function staff1()
    {
        $divisi = $this->session->userdata('ses_divisi');
        return $this->db->query("SELECT * from tb_user where atasan is not null and (hak_akses='Pegawai' or hak_akses = 'Pegawai2') and divisi = '$divisi' and resign=0 order by nama_user ASC")->result_array();
    }

    public function manager_direksi()
    {
        $divisi = $this->session->userdata('ses_divisi');
        $staff = $this->db->query("SELECT atasan from tb_user where atasan is not null and (hak_akses='Pegawai' or hak_akses = 'Pegawai2') and   divisi = '$divisi' and resign=0 group by atasan")->row_array();

        // $manager = $this->db->get_where('tb_user', ['hak_akses'=>'Manager', 'divisi'=>$divisi, 'resign'=>0])->row_array();
        $manager = $this->db->get_where('tb_user', ['id_user'=>$staff['atasan']])->row_array();
        $direksi = $this->db->get_where('tb_user', ['id_user'=>$manager['atasan']])->row_array();

        $data = [
            'manager' => $manager['nama_user'],
            'direksi' => $direksi['nama_user'],
        ];
        return $data;
    }
}