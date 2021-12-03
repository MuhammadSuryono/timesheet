<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Discuss.php");

class Api extends Discuss 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Discuss_model');
		$this->load->model('User_model');
		$this->load->model('Point_model');
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

	public function point_task($taskId, $output = "json", $isCallback = false)
	{
		$discussModel = $this->Discuss_model;
		$pointModel = $this->Point_model;
		$data = $discussModel->getInformationTask($taskId);
		$dataPointAdjustment = $pointModel->get_point_by_task_id($taskId);
		$isAdjustmenPoint = count($dataPointAdjustment) > 0;

		$point = 0;
		$persentase = (int)$data['persentase'];

		$dateInput = $data['tanggalisi'];
		// $startDate = $this->parseDateToTimestampApi($data['daritanggal']);
		// $deadlineWeekly = $this->parseDateToTimestampApi($data['sampaitanggal']);
		$dateFinish = $this->parseDateToTimestampApi($data['tanggal_input_selesai']);
		$dateTarget = $this->parseDateToTimestampApi($data['tanggal_target_seelsai_rincian']);

		$weekInput = $this->getNumberOfWeek($dateInput);
		// $weekStartDate = $this->getNumberOfWeek($data['daritanggal']);
		$weekFinish = $this->getNumberOfWeek($data['tanggal_input_selesai']);
		// $weekdeadlineWeekly = $this->getNumberOfWeek($data['sampaitanggal']);
		$weekDateTarget = $this->getNumberOfWeek($data['tanggal_target_seelsai_rincian']);

		$dayInput = $this->getDayNameOfDate($dateInput);
		if (!in_array($dayInput, ["Saturday", "Friday", "Sunday"]) && $weekInput != $weekDateTarget) {
			$weekInput = $weekInput + 1;
		}

		if (in_array($dayInput, ["Saturday", "Friday", "Sunday"])) {
			$weekInput = $weekInput + 1;
		}

		if ($data['status_string'] == "Berprogress") {
			$dateFinish = $this->dateNowTimeStamp();
		}
		
		$totalPotonganOverWeekly = ($weekFinish - $weekInput) * 25;
		$totalPotonganOverWeekly = $totalPotonganOverWeekly > 100 ? 100 : $totalPotonganOverWeekly;
		$selisihHari = $this->selisihHariByDate($data['tanggal_input_selesai'], $data['tanggal_target_seelsai_rincian']);

		if (!$isAdjustmenPoint) {
			if ($weekInput == $weekFinish || $weekFinish < $weekInput) {
				if ($persentase >= 100 && $dateFinish < $dateTarget || $dateFinish === $dateTarget) {
					$point = $weekFinish == $weekInput ? 100 : 100 - $totalPotonganOverWeekly;
				} else if ($persentase >= 100 && $dateFinish > $dateTarget) {
					$point = 100 - ($selisihHari * 5);
				}
				
			} else if ($weekFinish > $weekInput) {
				$selisihWeekFinishWithWeekInput = $weekFinish - $weekInput;
	
				if ($persentase >= 100 && $dateFinish < $dateTarget || $dateFinish === $dateTarget && $selisihWeekFinishWithWeekInput <= 1) {
					$alreadyDiscuss = $this->alreadyDiscuss($taskId, $weekFinish);
					if (!$alreadyDiscuss) {
						for ($i=0; $i < $selisihWeekFinishWithWeekInput; $i++) { 
							$totalPotonganOverWeekly = 50 * ($i + 1);
						}
					}
					$point = $weekFinish == $weekDateTarget ? 100 : 100 - $totalPotonganOverWeekly;
				} else if ($persentase >= 100 && $selisihWeekFinishWithWeekInput > 1) {
					$descriptionPinalti = "Task sudah melebihi jadwal dan target yang ditentukan. Target task " . $data['tanggal_input_selesai'];
					$this->add_data_pinalti($taskId, $descriptionPinalti);
					$point = 0;
				}
			}
		} else {
			$point = $dataPointAdjustment[0]['point'];
		}

		$point = $point > 100 ? 100 : $point;
		if ($output == "json") {
			$htmlResponse = "<div>$point</div>";
			echo json_encode($this->response(200, "Success retrieve data", $htmlResponse));
			# code...
		} else if ($isCallback) {
			return $point;
		} else {
			echo $point;
		}

	}

	public function alreadyDiscuss($idTask, $weekNumber)
	{
		$weekDate = $this->getStartAndEndDate($weekNumber);
		$discussModel = $this->Discuss_model;

		$dataDiscuss = $discussModel->getDiscussByTaskIdRangeDate($idTask, $weekDate['week_start'], $weekDate['week_end']);

		return count($dataDiscuss) > 0;
	}
}
