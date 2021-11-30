<?php

class Api extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Discuss_model');
	}

	public function discuss($taskId)
	{
		$discussModel = $this->Discuss_model;
		$data = $discussModel->getDiscussByTaskId($taskId);

		echo json_encode($this->response(200, "Success retrieve data", $data));
	}
}
