<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pinalti_model extends CI_Model
{
	private $tbName = "tb_pinalti";
	function create($data){
		return $this->db->insert($this->tbName,$data);
	}

	function delete($id) {
		return $this->db->delete($this->tbName, array('id' => $id));
	}

	public function update($id, $data) 
	{		
		$this->db->where('id', $id);
		$this->db->update($this->tbName, $data);
	}

	public function get_pinalti_by_task_id($idTask)
	{
		$this->db->where('id_task', $idTask);
		$query = $this->db->get($this->tbName);

		if ($query->num_rows() != 0) {
			return $query->result_array();		
		} else {
			return [];
		}
	}

	public function get_pinalti_by_user($idStaff, $idLeader = '')
	{
		$this->db->where('id_staff', $idStaff);
		$this->db->or_where('id_leader', $idLeader);
		$query = $this->db->get($this->tbName);

		if ($query->num_rows() != 0) {
			return $query->result_array();		
		} else {
			return [];
		}
	}

}
