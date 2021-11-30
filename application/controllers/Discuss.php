<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Discuss extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Discuss_model');
	}

	public function create($idTask) {
		$this->setHeaderPage("Diskusi", true);
		$this->setData('id_task', $idTask);

		$dataInformationTask = $this->Discuss_model->getInformationTask($idTask);
		$this->setData('information_task', $dataInformationTask);


		$data = $this->getParseData();

		$this->load->view('template/header');
		$this->load->view('discuss/index', $data);
		$this->load->view('template/sidebar');
		$this->load->view('template/footer');
	}
}

