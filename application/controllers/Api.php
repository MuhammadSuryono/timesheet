<?php

class Api extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Discuss_model');
		$this->load->model('User_model');
	}

	public function discuss_task($taskId)
	{
		$discussModel = $this->Discuss_model;
		$data = $discussModel->getDiscussByTaskId($taskId);

		echo json_encode($this->response(200, "Success retrieve data", $data));
	}

	public function list_user_manager_user()
	{
		$userModel = $this->User_model;
		$atasanId = $this->session->userdata('ses_atasan');
		$idUser = $this->session->userdata('ses_id');

		$allManager = [];
		$getManagerUser = $userModel->getManagerUser($atasanId);
		array_push($allManager, ["id" => $getManagerUser->no_user, "name" => $getManagerUser->nama_user, "is_leader" => true]);

		$getAllManagerNotIncludeLeaderUser = $userModel->getUserLevelManager($atasanId);

		foreach ($getAllManagerNotIncludeLeaderUser as $obj) {
			array_push($allManager, ["id" => $obj['no_user'], "name" => $obj['nama_user'], "is_leader" => false]);
		}

		echo json_encode($this->response(200, "Success retrieve data", $allManager));
	}

	public function point_task($taskId)
	{
		$discussModel = $this->Discuss_model;
		$data = $discussModel->getInformationTask($taskId);

		echo json_encode($this->response(200, "Success retrieve data", $data));
	}
}
