<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><span onclick="backToPreviousPage()" style="cursor: pointer"><i class="fa fa-arrow-left"></i></span> &nbsp;&nbsp;<i class="fa fa-comments"></i> Diskusi</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></div>
        <div class="breadcrumb-item">Diskusi</div>
		<div class="breadcrumb-item active">Create</div>
      </div>
    </div>
	<div class="section-body">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header d-flex justify-content-between align-items-center">
						<h2 class="section-title title-information">Informasi Pekerjaan</h2>
						<div class="text-right">
							<div class="numberCircle" id="point-task">0</div>
						</div>
					</div>
					<?php 
						$dataInformationTask = $datas['information_task'];
						$dataTitleSplit = explode(":", $dataInformationTask['project']);
						$kategoriPekerjaan = isset($dataTitleSplit[0]) ? $dataTitleSplit[0] : "-";
						$titleDeskripsiPekerjaan = isset($dataTitleSplit[1]) ? $dataTitleSplit[1] : "-";
					?>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-6">
								<table>
									<tr>
										<td>Judul Pekerjaan</td>
										<td>:</td>
										<td>&nbsp;<?= ucwords($titleDeskripsiPekerjaan) ?></td>
									</tr>
									<tr>
										<td>Tanggal Mulai</td>
										<td>:</td>
										<td>&nbsp;<?= isset($dataInformationTask['daritanggal']) ? $dataInformationTask['daritanggal'] : '-' ?></td>
									</tr>
									<tr>
										<td>Tanggal Selesai</td>
										<td>:</td>
										<td>&nbsp;<?= isset($dataInformationTask['sampaitanggal']) ? $dataInformationTask['sampaitanggal'] : '-' ?></td>
									</tr>
									<tr>
										<td>Dikerjakan Oleh</td>
										<td>:</td>
										<td>&nbsp;<?= isset($dataInformationTask['user_created']) ? $dataInformationTask['user_created'] : '-' ?></td>
									</tr>
									<tr>
										<td>Dilaporkan Kepada</td>
										<td>:</td>
										<td>&nbsp;<?= isset($dataInformationTask['user_leader']) ? $dataInformationTask['user_leader'] : '-' ?></td>
									</tr>
									<tr>
										<td>Terkahir Diubah</td>
										<td>:</td>
										<td>&nbsp;<?= isset($dataInformationTask['tanggal_update']) ? $dataInformationTask['tanggal_update'] : '-' ?></td>
									</tr>
								</table>
							</div>
							<div class="col-lg-6">
								<table>
									<tr>
										<td>Divisi</td>
										<td>:</td>
										<td>&nbsp;<?= isset($dataInformationTask['divisi']) ? $dataInformationTask['divisi'] : '-' ?></td>
									</tr>
									<tr>
										<td>Kategori Pekerjaan</td>
										<td>:</td>
										<td>&nbsp;<?= $kategoriPekerjaan ?></td>
									</tr>
									<!-- <tr>
										<td>Keterlambatan Pekerjaan</td>
										<td>:</td>
										<td>&nbsp;<?= isset($dataInformationTask['tanggal_input_selesai']) ? $dataInformationTask['tanggal_input_selesai'] : '-' ?></td>
									</tr> -->
									<tr>
										<td>Status Perpanjangan</td>
										<td>:</td>
										<td>&nbsp;<?= isset($dataInformationTask['status_perpanjang']) && $dataInformationTask['status_perpanjang'] != "" ? $dataInformationTask['status_perpanjang'] : 'Tidak Ada' ?> <i class="fa fa-question-circle pointer"></i></td>
									</tr>
									<tr>
										<td>Status Pekerjaan</td>
										<td>:</td>
										<?php
											$statusPekerjaan = isset($dataInformationTask['status_string']) && $dataInformationTask['status_string'] != ""  ? $dataInformationTask['status_string'] : '-';
											$colorBadge = "badge-primary";

											if ($statusPekerjaan == "-") {
												$colorBadge = "badge-danger";
												$statusPekerjaan = "Belum Dikerjakan";
											} else if ($statusPekerjaan == "Done 100%") {
												$colorBadge = "badge-success";
												$statusPekerjaan = "Selesai";
											}
										?>
										<td>&nbsp;<span class="badge <?= $colorBadge ?>"><?= $statusPekerjaan ?></span></td>
									</tr>
									<tr>
										<td>Persentase Hasil pekerjaan</td>
										<td>:</td>
										<td>&nbsp;<i class="fa fa-chart-bar" aria-hidden="true"></i> <?= $statusPekerjaan = isset($dataInformationTask['persentase'])  ? $dataInformationTask['persentase'] : '0'?>%</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<button class="btn btn-primary" id="btn-create-discuss"><i class="fa fa-plus"></i> Tambah Diskusi</button>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="table-responsive">
								<table class="table table-bordered table-hover table-striped" >
									<thead>
										<tr class="bg-light text-center">
											<th width="5">No</th>
											<th>Judul Diskusi</th>
											<th>Diskusi Dengan</th>
											<th>Dibuat Pada</th>
											<th>Diubah Pada</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody id="data-diskusi">
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</section>
</div>
<div class="modal fade" id="createDiscuss" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data Diskusi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" enctype="multipart/form-data">
			<div class="modal-body">
				<div id="alert-form"></div>
				<div class="form-group">
    				<label>Judul Diskusi</label>
    				<input type="text" class="form-control" id="title-discuss" min="2" placeholder="Judul Diskusi" required>
					<div class="invalid-feedback">
						Please choose a username.
					</div>
  				</div>
				  <div class="form-group">
    				<label>Diskusi Dengan</label>
    				<select class="form-control" id="list-mentor" required>
						<option>Pilih Mentor Diskusi</option>
					</select>
  				</div>
				<!-- <div>
					<label>Pilih Dokumen Pendukung</label> <br>
					<input type="file" name="listFile[]" accept="*" id="attachments" multiple>
					<small id="emailHelp" class="form-text text-muted">Anda dapat menambahkan beberapa file pendukung</small>
				</div> -->
				<div class="form-group">
					<label class="col-form-label">Hasil Diskusi</label>
					<textarea class="form-control" id="results-discuss" minlength="23"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary" id="submitCreateDiscuss">Simpan</button>
			</form>
			</div>
		</div>
	</div>
</div>

<script>

	let stateForm = "create"

	$(document).ready(function() {
		const btnCreateDiscuss = $('#btn-create-discuss')
		const btnSubmitCreateDiscuss = $('#submitCreateDiscuss');
		const pathName = window.location.pathname
		let pathNameSplit = pathName.split("/")
		let taskId = pathNameSplit[pathNameSplit.length - 1]
		
		// setDataTableDiscuss
		setDataTableDiscuss(taskId)
		setPointTask(taskId)

		btnCreateDiscuss.click(function() {
			showModalCreateDiscuss()
		})

		btnSubmitCreateDiscuss.click(function() {
			btnSubmitCreateDiscuss.attr('disabled','disabled')
			btnSubmitCreateDiscuss.html('Menyimpan')
			submitDiscussTask(taskId, btnSubmitCreateDiscuss)
		})
  	});

	function setDataTableDiscuss(taskId) {
		const bodyTable = document.getElementById("data-diskusi")
		let delay = 2000
		let url = '/api/discuss/list/task/' + taskId

		bodyTable.innerHTML = loadingDataTable();
		httpRequestGet(url).then((res) => {
			let htmlTableDataDiscuss = ""
			let data = res.data

			if (data.length > 0) {
				data.forEach((element, index) => {
					htmlTableDataDiscuss += `<tr><td class='text-center'>${index + 1}</td><td>${element.title}</td><td>${element.mentor}</td><td class="text-center">${element.created_at}</td><td class="text-center">${element.updated_at}</td><td><button class="btn btn-primary btn-sm mr-1"><i class="fa fa-eye"></i>&nbsp;Detail</button><button class="btn btn-success btn-sm mr-1"><i class="fa fa-edit"></i>&nbsp;Edit</button><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Hapus</button></td></tr>`
				});	
				setTimeout(() => {
					bodyTable.innerHTML = htmlTableDataDiscuss;	
				}, delay)		
			} else {
				setTimeout(() => {
					bodyTable.innerHTML = noDataTable();
				}, delay)
			}
				
		});

	}

	function noDataTable() {
		return '<tr class="text-center" style="border-bottom: 1px solid #F0F8FF;"><th colspan="6"><h6>Data Tidak Tersedia</h6></th></tr>';
	}

	function loadingDataTable() {
		return '<tr class="text-center" style="border-bottom: 1px solid #F0F8FF;"><th colspan="6"><div class="item"><i class="loader --1"></i></div></th></tr>';
	}

	function alertForm(type = "success", message = "") {
		return `<div class="alert alert-${type}" role="alert">
						${message}
					</div>`;
	}

	function httpRequestGet(url) {
		return fetch(url)
			.then((response) => response.json())
			.then(data => data);
	}

	function httpRequestPost(url, data) {
		return fetch(url, {
			method: 'POST',
			body: data
		}).then(res => res.json()).then(data => data)
	}

	function showModalCreateDiscuss() {
		showModal('createDiscuss')
		getUserManager();
	}

	function showModal(idModal) {
		const formModal = $(`#${idModal}`)
		formModal.modal('show')
	}

	function hideModal(idModal) {
		const formModal = $(`#${idModal}`)
		formModal.modal('hide')
	}

	function backToPreviousPage() {
		let lastPopUp = window.localStorage.getItem('last_popup')
		let previousPage = window.localStorage.getItem('previous_page')
		let searchData = window.localStorage.getItem('search_data_rekap')

		previousPage = previousPage + "?lastData=true"

		if (searchData !== undefined && searchData !== "") {
			let dataSearch = JSON.parse(searchData)

			let queryUrl = `&isSearch${dataSearch.is_search}&idUser=${dataSearch.id_user}&startDate=${dataSearch.daritanggal}&endDate=${dataSearch.sampaitanggal}&keyword=${dataSearch.katakunci}`
			previousPage = previousPage + queryUrl
		}

		window.location.href = previousPage
	}

	function getUserManager() {
		const optionMentors = document.getElementById("list-mentor")
		httpRequestGet('/api/user/manager').then((res) => {
			let data = res.data
			let options = "<option value='0'>Pilih Mentor Diskusi</option>"

			data.forEach((elm,i) => {
				let selected = ""
				if(elm.is_leader) selected = "selected";
				options += `<option value='${elm.id}' ${selected}>${elm.name}</option>`
			})

			optionMentors.innerHTML = options;

		})
	}

	function submitDiscussTask(taskId, elmButtonSubmit) {
		const titleDiscuss = $('#title-discuss').val();
		const mentorDiscuss = $('#list-mentor').val();
		const resultDiscuss = $('#results-discuss').val();
		const notifAlertForm = document.getElementById('alert-form')

		var formData = new FormData()
		formData.append('task_id', taskId)
		formData.append('title_discuss', titleDiscuss)
		formData.append('mentor_discuss', mentorDiscuss)
		formData.append('result_discuss', resultDiscuss)

		httpRequestPost('/api/discuss/create', formData).then((res) => {
			elmButtonSubmit.html('Simpan')
			if (res.is_success) {
				notifAlertForm.innerHTML = alertForm("success", res.message);
				setDataTableDiscuss(taskId)
				setTimeout(() => {
					hideModal('createDiscuss')
				}, 1000)
			} else {
				notifAlertForm.innerHTML = alertForm("danger", res.message);
			}
		}).catch((e) => {
			console.warn(e)
			notifAlertForm.innerHTML = alertForm("danger", "Terjadi masalah ketika membuat diskusi");
		})
	}

	function setPointTask(taskId) {
		httpRequestGet('/api/discuss/point/task/' + taskId).then((res) => {
			console.log(res)
			let data = res.data
			let point = 100
			let persentase = parseInt(data.persentase)

			let startDate = Date.parse(data.daritanggal)
			let endDate = Date.parse(data.sampaitanggal)
			let lastUpdateDate = Date.parse(data.tanggal_input_selesai)
			let dateTarget = Date.parse(data.tanggal_target_seelsai_rincian)

			if (lastUpdateDate < endDate) {
				if (persentase < 100 && lastUpdateDate < dateTarget) {
					point = persentase
				} else if (persentase >= 100 && lastUpdateDate < dateTarget) {
					point = 100
				}	
			} else if (lastUpdateDate > endDate) {
				point = 0
				if (persentase < 100 && dateTarget > endDate && lastUpdateDate < dateTarget) {
					point = persentase - 25 <= 0 ? 0 : persentase - 25
				} else if (persentase >= 100 && dateTarget > endDate && lastUpdateDate < dateTarget) {
					point = point - 25 <= 0 ? 0 : point - 25
				}
			}

			document.getElementById('point-task').innerHTML = '<div>100</div>'
		})
	}

</script>
