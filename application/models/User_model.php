<?php

class User_model extends CI_Model {
	public function getUserLevelManager($notIncludeIdUser = "") {
		$this->db->where('hak_akses', 'manager');
		if ($notIncludeIdUser != "") {
			$this->db->where('id_user !=', $notIncludeIdUser);
		}
		$query = $this->db->get('tb_user');

		if ($query->num_rows() != 0) {
			return $query->result_array();		
		} else {
			return [];
		}
	}

	public function getManagerUser($idUser) {
		$this->db->where('id_user', $idUser);
		$query = $this->db->get('tb_user');

		if ($query->num_rows() != 0) {
			return $query->row();		
		} else {
			return [];
		}
	}
}
