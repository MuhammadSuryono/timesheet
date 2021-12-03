<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Discuss extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Discuss_model');
		$this->load->model('Pinalti_model');
		$this->load->model('Attachment_model');
		$this->load->model('Point_model');
	}

	public function list_discuss_task($idTask) {
		$this->setHeaderPage("Diskusi", true);
		$this->setData('id_task', $idTask);

		$dataInformationTask = $this->Discuss_model->getInformationTask($idTask);
		$this->setData('information_task', $dataInformationTask);
		$this->setData('is_management', in_array($this->session->userdata('ses_akses'), ["Manager", "Direksi"]));

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
		} else {
			echo json_encode($this->response(500, "Gagal Simpan Data Diskusi"));
		}
	}

	public function update($id) {
		$data = array(
			'id_user_mentor' => $this->input->post('mentor_discuss'),
			'title' => $this->input->post('title_discuss'),
			'discussion_results' => $this->input->post('result_discuss'),
			'updated_by' => $this->session->userdata('ses_id'),
			);
		
		$isUpdated = $this->Discuss_model->updateDiscuss($id, $data);
		if ($isUpdated) {
			echo json_encode($this->response(200, "Berhasil Update Data Diskusi", $data));
		} else {
			echo json_encode($this->response(500, "Gagal Update Data Diskusi"));
		}
	}

	public function delete($idDiscuss) {
		$isDeleted = $this->Discuss_model->delete($idDiscuss);
		if ($isDeleted) {
			echo json_encode($this->response(200, "Berhasil Delete Data Diskusi"));
		} else {
			echo json_encode($this->response(500, "Gagal Delete Data Diskusi"));
		}
	}

	public function add_data_pinalti($idTask, $description = "") {
		$atasanId = $this->session->userdata('ses_atasan');
		$idUser = $this->session->userdata('ses_id');
		$pinaltiModel = $this->Pinalti_model;

		$pinalti = $pinaltiModel->get_pinalti_by_task_id($idTask);
		$isAlreadyPinalti = count($pinalti) > 0;

		$data = [
			"id_task" => $idTask,
			"id_staff" => $idUser,
			"id_leader" => $atasanId,
			'description' => $description,
		];


		if ($isAlreadyPinalti) {
			return true;
		} else {
			$isCreated = $pinaltiModel->create($data);
			return $isCreated;
		}
	}

	public function get_discuss_by_id($id) {
		$discussModel =  $this->Discuss_model;
		$discuss = $discussModel->getDiscussById($id);
		echo json_encode($this->response(200, "Success retrieve data", $discuss));
	}

	public function upload_attachment($taskId, $discussId) {
		$attachmentModel = $this->Attachment_model;
		$config['upload_path']          = './dist/';
		$config['max_size']             = 100;
		$config['allowed_types']        = 'jpg|gif|png|pdf|doc|docx|xls|xlsx|jpeg';
 
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload('file')){
			$error = array('error' => $this->upload->display_errors());
			echo json_encode($this->response(500, "Error upload attachment", $error));
		}else{
			$data = $this->upload->data();
			$bodyAttachment = [
				"id_task" => $taskId,
				"id_discuss" => $discussId,
				"filename" => $data['file_name'],
				'created_by' => $this->session->userdata('ses_id'),
			];

			$isCreated = $attachmentModel->create($bodyAttachment);
			echo json_encode($this->response(200, "Success upload attachment", $data));
		}
	}

	public function get_attachment_by_discuss_id($idDiscuss) {
		$attachmentModel =  $this->Attachment_model;
		$attachments = $attachmentModel->get_attachment_by_discuss_id($idDiscuss);
		echo json_encode($this->response(200, "Success retrieve data", $attachments));
	}

	public function delete_attachment($idAttachment) {
		$isDeleted = $this->Attachment_model->delete($idAttachment);
		if ($isDeleted) {
			echo json_encode($this->response(200, "Berhasil Delete Data Atachment", $isDeleted));
		} else {
			echo json_encode($this->response(500, "Gagal Delete Data Atachment", $isDeleted));
		}
	}

	public function add_point($idTask, $point = 0) {
		$pointModel = $this->Point_model;

		$pinalti = $pointModel->get_pinalti_by_task_id($idTask);
		$isAlreadyPinalti = count($pinalti) > 0;

		$data = [
			"id_task" => $idTask,
			'point' => $point,
			'updated_by' => $this->session->userdata('ses_id'),
			'created_by' => $this->session->userdata('ses_id'),
		];


		if ($isAlreadyPinalti) {
			$isUpdated = $pointModel->update($idTask, $data);
			return $isUpdated;
		} else {
			$isCreated = $pointModel->create($data);
			return $isCreated;
		}
	}
}

