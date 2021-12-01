<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Discuss_model extends CI_Model
{
	public function getInformationTask($idTask)
	{
		$this->db->select('a.*, g.nama_user as user_leader, f.nama_user as user_created, b.divisi, b.daritanggal, b.sampaitanggal, d.deskripsi, d.no as no_pekerjaan, e.status as status_string, e.status_perpanjang');
		$this->db->from('tkmstaff a');
		$this->db->join('tkmdivisi b', 'a.idtkmdiv = b.no', 'left');
		$this->db->join('pekerjaan d', 'a.idtkmdiv = d.idtkmdiv AND a.project = d.project');
		$this->db->join('rincian e', 'a.no = e.id_tkmstaff AND d.no=e.idpekerjaan');
		$this->db->join('tb_user f', 'f.id_user = a.userstaff');
		$this->db->join('tb_user g', 'g.id_user = a.leader');
		$this->db->where('a.no', $idTask);
		$query = $this->db->get();

		if ($query->num_rows() != 0) {
			return $query->result_array()[0];		
		} else {
			return [];
		}

	}

	public function getDiscussByTaskId($idTask)
	{
		$this->db->select('a.*, b.nama_user as created_by, c.nama_user as updated_by, d.nama_user as mentor');
		$this->db->from('tb_discuss a');
		$this->db->join('tb_user b', 'a.created_by = b.no_user', 'left');
		$this->db->join('tb_user c', 'a.updated_by = c.no_user', 'left');
		$this->db->join('tb_user d', 'a.id_user_mentor = d.no_user', 'left');
		$this->db->where('a.id_task', $idTask);

		$query = $this->db->get();

		if ($query->num_rows() != 0) {
			return $query->result_array();		
		} else {
			return [];
		}
	}
}
