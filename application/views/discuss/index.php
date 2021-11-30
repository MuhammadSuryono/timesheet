<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><a href="#"><i class="fa fa-arrow-left"></i></a> &nbsp;&nbsp;<i class="fa fa-comments"></i> Diskusi</h1>
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
							<div class="numberCircle">100</div>
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
									<tr>
										<td>Keterlambatan Pekerjaan</td>
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
						<button class="btn btn-primary" data-toggle="modal" data-target="#createDiscuss"><i class="fa fa-plus"></i> Tambah Diskusi</button>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="table-responsive">
								<table class="table table-bordered table-hover table-striped" >
									<thead>
										<tr class="bg-light text-center">
											<th>No</th>
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
			<form action="proses.php" method="POST" enctype="multipart/form-data">
			<div class="modal-body">
				<div class="form-group">
    				<label>Judul Diskusi</label>
    				<input type="text" class="form-control" id="title_discuss" min="2" placeholder="Judul Diskusi" required>
					<div class="invalid-feedback">
						Please choose a username.
					</div>
  				</div>
				  <div class="form-group">
    				<label>Diskusi Dengan</label>
    				<select class="form-control" required>
						<option>Pilih Mentor Diskusi</option>
					</select>
  				</div>
				<div>
					<label>Pilih Dokumen Pendukung</label> <br>
					<input type="file" name="listGambar[]" accept="*" multiple>
					<small id="emailHelp" class="form-text text-muted">Anda dapat menambahkan beberapa file pendukung</small>
				</div>
				<div class="form-group">
					<label for="message-text" class="col-form-label">Hasil Diskusi</label>
					<textarea class="form-control" id="results_discuss" minlength="23"></textarea>
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
	const idTask = <?= json_encode($id_task) ?>
	$(document).ready(function() {
		console.log(idTask)
		const bodyTable = document.getElementById("data-diskusi")
		bodyTable.innerHTML = loadingDataTable();

		// getDataDiscussByTask();

		setTimeout(function() {
			bodyTable.innerHTML = noDataTable();
		}, 5000)
  	});

	function noDataTable() {
		return '<tr class="text-center" style="border-bottom: 1px solid #F0F8FF;"><th colspan="6"><h6>Data Tidak Tersedia</h6></th></tr>';
	}

	function loadingDataTable() {
		return '<tr class="text-center" style="border-bottom: 1px solid #F0F8FF;"><th colspan="6"><div class="item"><i class="loader --1"></i></div></th></tr>';
	}

	function getDataDiscussByTask() {
		fetch('http://localhost:8000/api/discuss/2707')
			.then((response) => response.json())
			.then(data => console.log(data));
	}

</script>
