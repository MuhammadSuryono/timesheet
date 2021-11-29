<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model{

  public function cekusernya($username,$password){
    return $this->db->query("SELECT * FROM tb_user WHERE id_user= '$username' AND password= '$password' LIMIT 1");
  }

  public function cekusernya2($username){
    return $this->db->query("SELECT * FROM tb_user WHERE id_user= '$username' LIMIT 1");
  }

  public function get_atasan($jabatan)
    {
    	if ($jabatan == 'Pegawai') {
    	
        		return $this->db->query("SELECT * FROM tb_user WHERE hak_akses = 'Manager'
                                    ")->result_array();
        } else if ($jabatan == 'Manager') {
        		return $this->db->query("SELECT * FROM tb_user WHERE hak_akses = 'Direksi'
                                    ")->result_array();
        }
    }

}
