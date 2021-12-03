<?php 
$dataInformationTask = $datas['information_task'];
$dataTitleSplit = explode(":", $dataInformationTask['project']);
$kategoriPekerjaan = isset($dataTitleSplit[0]) ? $dataTitleSplit[0] : "-";
$titleDeskripsiPekerjaan = isset($dataTitleSplit[1]) ? $dataTitleSplit[1] : "-";
?>
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
				<input id="status-management" type="hidden" value="<?= $datas['is_management'] == '' ? 0 : $datas['is_management'] ?>" />
				<input id="status-task" type="hidden" value="<?= isset($dataInformationTask['status_string']) && $dataInformationTask['status_string'] != ""  ? $dataInformationTask['status_string'] : '-' ?>" />
				<div id="alert-notification"></div>
				<div class="card">
					<div class="card-header d-flex justify-content-between align-items-center">
						<h2 class="section-title title-information">Informasi Pekerjaan</h2>
						<div class="text-right">
							<div class="numberCircle" id="point-task">0</div>
						</div>
					</div>
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
										<td>Tanggal Input Pekerjaan</td>
										<td>:</td>
										<td>&nbsp;<?= isset($dataInformationTask['tanggalisi']) ? $dataInformationTask['tanggalisi'] : '-' ?></td>
									</tr>
									<tr>
										<td>Tanggal Selesai</td>
										<td>:</td>
										<td>&nbsp;<?= isset($dataInformationTask['tanggal_input_selesai']) ? $dataInformationTask['tanggal_input_selesai'] : '-' ?></td>
									</tr>
									<tr>
										<td>Tanggal Target Selesai</td>
										<td>:</td>
										<td>&nbsp;<?= isset($dataInformationTask['tanggal_target_seelsai_rincian']) ? $dataInformationTask['tanggal_target_seelsai_rincian'] : '-' ?></td>
									</tr>
									<tr>
										<td>Tanggal Deadline Mingguan</td>
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
										<td>Pencapaian</td>
										<td>:</td>
										<td>&nbsp;<?= isset($dataInformationTask['status_perpanjang']) && $dataInformationTask['status_perpanjang'] != "" ? $dataInformationTask['status_perpanjang'] : 'Tidak Ada' ?> </td>
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
										<td>&nbsp;<i class="fa fa-chart-bar" aria-hidden="true"></i> <?= isset($dataInformationTask['persentase'])  ? $dataInformationTask['persentase'] : '0'?>%</td>
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
						<?php if ($statusPekerjaan != "Selesai" || $datas['is_management']) {
							echo '<button class="btn btn-primary" id="btn-create-discuss"><i class="fa fa-plus"></i> Tambah Diskusi</button>';
						} ?>
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
			<form enctype="multipart/form-data">
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
					<textarea class="form-control" id="results-discuss" minlength="100" style="height: 450px !important;"></textarea>
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

<div class="modal fade" id="attachments-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Lampiran Pendukung</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="alert-form-attachment"></div>
				<?= $datas['is_management'] ? "" : '<form enctype="multipart/form-data">
				<div class="row">
					<div class="col-lg-8">
						<div class="mb-4">
							<label>Pilih Dokumen Pendukung</label> <br>
							<input type="file" name="file" accept="*" id="attachment">
						</div>
					</div>
					<div class="col-lg-4 text-center">
						<button type="button" class="btn btn-primary mt-4" id="submitUploadFile">Simpan</button>
					</div>
				</div>
				</form>' ?>
				<div class="row">
					<div class="col-lg-12">
					<h6>Daftar Lamprian:</h6>
					<ul class="list-group" id="list-attachments"></ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="loading-prosess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="item"><i class="loader --1"></i></div>
		</div>
	</div>
</div>

<div class="modal fade" id="detail-discuss" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Isi Diskusi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="content-discuss"><div class="item"><i class="loader --1"></i></div></div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	let stateForm = "create"
	let stateIdDiscuss = 0;
	let stateTaskId = 0;
	let isManagement = document.getElementById("status-management").value === "0" ? false : document.getElementById("status-management").value === "1" ? true : false
	$(document).ready(function() { 
		console.log(isManagement)
		const btnCreateDiscuss = $('#btn-create-discuss')
		const btnSubmitCreateDiscuss = $('#submitCreateDiscuss');
		const btnSubmitUploadAttachment = $('#submitUploadFile')
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

		btnSubmitUploadAttachment.click(function() {
			submitAttachment();
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
					htmlTableDataDiscuss += `<tr><td class='text-center'>${index + 1}</td><td>${element.title}</td><td>${element.mentor}</td><td class="text-center">${element.created_at}</td><td class="text-center">${element.updated_at}</td><td>
					<button onclick="getDetailDiscuss(${element.id})" class="btn btn-primary btn-sm mr-1"><i class="fa fa-eye"></i>&nbsp;Detail</button>`
					
					if (!isManagement) {
						htmlTableDataDiscuss += `<button onclick="getDataDiscussUpdate(${element.id})" class="btn btn-success btn-sm mr-1"><i class="fa fa-edit"></i>&nbsp;Edit</button>
					<button onclick="hapus(${element.id}, ${taskId})" class="btn btn-danger btn-sm mr-1"><i class="fa fa-trash"></i>&nbsp;Hapus</button>`
					}

					htmlTableDataDiscuss += `<button onclick="addAttachment(${element.id}, ${taskId})" class="btn btn-danger btn-sm"><i class="fa fa-file"></i>&nbsp;Lampiran</button></td></tr>`
				});	
				setTimeout(() => {
					bodyTable.innerHTML = htmlTableDataDiscuss;	
				}, delay)		
			} else {
				setTimeout(() => {
					bodyTable.innerHTML = noDataTable();
				}, delay)
			}
				
		}).catch((e) => {
			console.warn(e);
			setTimeout(() => {
				bodyTable.innerHTML = noDataTable();
			}, delay)
		});

	}

	function noDataTable() {
		return '<tr class="text-center" style="border-bottom: 1px solid #F0F8FF;"><th colspan="6"><h6>Data Tidak Tersedia</h6></th></tr>';
	}

	function loadingDataTable() {
		return '<tr class="text-center" style="border-bottom: 1px solid #F0F8FF;"><th colspan="6"><div class="item"><i class="loader --1"></i></div></th></tr>';
	}

	function loadingContent() {
		return '<div class="item"><i class="loader --1"></i></div>';
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

	function httpRequest(url, data, method = "POST") {
		return fetch(url, {
			method: method,
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

		if (previousPage === undefined || previousPage === null || previousPage == "") {
			if (isManagement) {
				previousPage = "/mingguan/rekap_pekerjaanhead"
			} else {
				previousPage = "/mingguan/rekap_pekerjaan"
			}
		}

		previousPage = previousPage + "?lastData=true"

		if (searchData !== undefined && searchData !== null && searchData !== "") {
			let dataSearch = JSON.parse(searchData)

			let queryUrl = `&isSearch${dataSearch.is_search}&idUser=${dataSearch.id_user}&startDate=${dataSearch.daritanggal}&endDate=${dataSearch.sampaitanggal}&keyword=${dataSearch.katakunci}`
			previousPage = previousPage + queryUrl
		}

		window.location.href = previousPage
	}

	function getUserManager(idMentor = 0) {
		const optionMentors = document.getElementById("list-mentor")
		httpRequestGet('/api/user/manager').then((res) => {
			let data = res.data
			let options = "<option value='0'>Pilih Mentor Diskusi</option>"

			data.forEach((elm,i) => {
				let selected = ""
				if(elm.is_leader && idMentor === 0) selected = "selected";
				if(idMentor !== 0 && idMentor === elm.id) selected = "selected";
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

		let pathSubmit = '/api/discuss/create'
		let method = "POST"
		if (stateForm === "update") {
			pathSubmit = '/api/discuss/update/' + stateIdDiscuss;
			method = "PUT"
		}

		httpRequest(pathSubmit, formData, method).then((res) => {
			elmButtonSubmit.html('Simpan')
			if (res.is_success) {
				notifAlertForm.innerHTML = alertForm("success", res.message);
				setDataTableDiscuss(taskId)
				setTimeout(() => {
					notifAlertForm.innerHTML = "";
					hideModal('createDiscuss')
				}, 1000)
			} else {
				setTimeout(() => {
					notifAlertForm.innerHTML = "";
				}, 5000)
				notifAlertForm.innerHTML = alertForm("danger", res.message);
			}
		}).catch((e) => {
			console.warn(e)
			setTimeout(() => {
				notifAlertForm.innerHTML = "";
			}, 5000)
			notifAlertForm.innerHTML = alertForm("danger", "Terjadi masalah ketika membuat diskusi");
		})
	}

	function setPointTask(taskId) {
		const pointElement = document.getElementById('point-task').innerHTML
		httpRequestGet('/api/discuss/point/task/' + taskId).then((res) => {
			$('#point-task').html(res.data)
		})
	}

	function hapus(id, taskId) {
		const notifAlertForm = document.getElementById('alert-notification')
		alertSwal().then((result) => {
			if (result.value) {
				showModal("loading-prosess")
				setTimeout(() => {
					hideModal("loading-prosess")
				}, 5000)
				httpRequest('/api/discuss/delete/task/' +id, [], "DELETE").then((res) => {
					if (res.is_success) {
						setDataTableDiscuss(taskId)
						setTimeout(() => {
							notifAlertForm.innerHTML = ""
						}, 2000)
						notifAlertForm.innerHTML = alertForm("success", res.message)
					} else {
						setTimeout(() => {
							notifAlertForm.innerHTML = ""
						}, 2000)
						notifAlertForm.innerHTML = alertForm("danger", res.message)
					}

				}).catch((e) => {
					console.warn(e)
					notifAlertForm.innerHTML = alertForm("danger", "Terjadi masalah ketika membuat diskusi");
					setTimeout(() => {
						notifAlertForm.innerHTML = ""
					}, 2000)
				})
			}
		})
	}

	function alertSwal() {
		return Swal({
			title: 'Apakah anda yakin ?',
			text: "data akan dihapus",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Hapus Data!'
		})
	}

	function getDetailDiscuss(id) {
		const content = document.getElementById("content-discuss")
		showModal("detail-discuss")
		httpRequestGet('/api/discuss/task/' + id).then((res) => {
			let data = res.data
			content.innerHTML = `<p>${data.discussion_results}`;

		})
	}

	function getDataDiscussUpdate(id) {
		showModal('createDiscuss')
		stateForm = "update"
		stateIdDiscuss = id

		httpRequestGet('/api/discuss/task/' + id).then((res) => {
			let data = res.data
			if (res.is_success) {
				document.getElementById("title-discuss").value = data.title;
				document.getElementById("results-discuss").value = data.discussion_results;
				getUserManager(data.id_user_mentor)
			}
		})
	}

	function addAttachment(idDiscuss, taskId) {
		showModal("attachments-modal")
		stateTaskId = taskId
		stateIdDiscuss = idDiscuss
		setListAttachments(idDiscuss)
	}

	function deleteAttachment(id, discussId) {
		const notifAlertForm = document.getElementById('alert-form-attachment')
		httpRequest('/api/attachment/delete/' +id, [], "DELETE").then((res) => {
			if (res.is_success) {
				setListAttachments(discussId)
				notifAlertForm.innerHTML = alertForm("success", res.message)
				setTimeout(() => {
					notifAlertForm.innerHTML = ""
				}, 2000)
			} else {
				setTimeout(() => {
					notifAlertForm.innerHTML = ""
				}, 2000)
				notifAlertForm.innerHTML = alertForm("danger", res.message)
			}

		}).catch((e) => {
			console.warn(e)
			notifAlertForm.innerHTML = alertForm("danger", "Terjadi masalah ketika membuat diskusi");
			setTimeout(() => {
				notifAlertForm.innerHTML = ""
			}, 2000)
		})
	}

	function setListAttachments(discussId) {
		const optionMentors = document.getElementById("list-attachments")
		optionMentors.innerHTML = loadingContent();
		httpRequestGet('/api/attachment/list/discuss/' + discussId).then((res) => {
			let data = res.data
			let lists = ""
			data.forEach((elm,i) => {
				lists += `<li class="list-group-item d-flex justify-content-between align-items-center">
							${elm.filename}`
				if (!isManagement) {
					lists += `<button class="btn btn-sm btn-danger" onclick="deleteAttachment(${elm.id}, ${elm.id_discuss})"><i class="fa fa-trash"></i></button>`
				}
					
				lists += `</li>`
			})

			setTimeout(() => {
				optionMentors.innerHTML = lists;
			}, 2000)

		})
	}

	function submitAttachment() {
		const notifAlertForm = document.getElementById('alert-form-attachment')
		const input = document.getElementById('attachment');
		let file = input.files[0];

		uploadFile(file).then((res) => {
			if (res.is_success) {
				notifAlertForm.innerHTML = alertForm("success", res.message)
				setListAttachments(stateIdDiscuss)
				setTimeout(() => {
					notifAlertForm.innerHTML = ""
				}, 2000)
			} else {
				setTimeout(() => {
					notifAlertForm.innerHTML = ""
				}, 2000)
				notifAlertForm.innerHTML = alertForm("danger", res.message)
			}
		}).catch((e) => {
			console.warn(e)
			notifAlertForm.innerHTML = alertForm("danger", "Terjadi masalah ketika membuat diskusi");
			setTimeout(() => {
				notifAlertForm.innerHTML = ""
			}, 2000)
		})
	}

	function uploadFile(file) {
		const fd = new FormData();
		fd.append('file', file);

		return fetch('/api/attachment/upload/task/' + stateTaskId + '/discuss/' + stateIdDiscuss, {
			method: 'POST',
			body: fd
		})
		.then(res => res.json())
		.then(data => data)
	}

</script>
