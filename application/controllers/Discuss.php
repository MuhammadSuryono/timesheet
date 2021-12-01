<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Discuss extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Discuss_model');
	}

	public function list_discuss_task($idTask) {
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

	public function create() {
		$data = array(
			'id_task' => $this->input->post('task_id'),
			'id_user' => $this->session->userdata('ses_id'),
			'id_user_mentor' => $this->input->post('mentor_discuss'),
			'title' => $this->input->post('title_discuss'),
			'discussion_results' => $this->input->post('result_discuss'),
			'created_by' => $this->session->userdata('ses_id'),
			);
		
		$isCreated = $this->Discuss_model->createDiscuss($data);
		if ($isCreated) {
			echo json_encode($this->response(200, "Berhasil Simpan Data Diskusi"));
			# code...
		} else {
			echo json_encode($this->response(500, "Gagal Simpan Data Diskusi"));
		}
	}

	public function delete($idDiscuss) {
		
	}
}

