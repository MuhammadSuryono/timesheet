<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attachment_model extends CI_Model
{
	private $tbName = "tb_attachments";
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

	public function get_attachment_by_discuss_id($idDiscuss)
	{
		$this->db->where('id_discuss', $idDiscuss);
		$query = $this->db->get($this->tbName);

		if ($query->num_rows() != 0) {
			return $query->result_array();		
		} else {
			return [];
		}
	}

}
