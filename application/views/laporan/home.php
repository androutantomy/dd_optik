<div class="page-title text-right">
	<h4>Laporan Toko <i class="ti-angle-right"></i> Data Laporan Toko</h4>
</div>
<div class="container">
	<div class="card">
		<div class="card-block text-dark">
			<h4 class="card-title">Laporan</h4>
			<div class="card-body" id="data_gudang">
				<form method="GET" action="<?= site_url('laporan') ?>">
					<div class="form-group row">
						<div class="col-md-2">
							<label>Toko</label>
							<select class="form-control form-control-sm input-sm" name="toko" id="toko">
								<option value="-">Pilih Toko</option>
								<?php foreach($toko as $val) { ?>
									<option value="<?= $val->id ?>"><?= $val->nama_toko ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-2">
							<label>Tanggal Mulai</label>
							<input type="date" name="tgl_mulai" id="tgl_mulai" value="<?= $start != '-' ? $start : ''; ?>" class="form-control form-control-sm input-sm" placeholder="Tanggal Mulai">
						</div>
						<div class="col-md-2">
							<label>Tanggal Selesai</label>
							<input type="date" name="tgl_selesai" id="tgl_selesai" value="<?= $end != '-' ? $end : ''; ?>" class="form-control form-control-sm input-sm" placeholder="Tanggal Selesai">
						</div>
						<div class="col-md-3" style="margin-top: 5px;">
							<button class="btn btn-sm btn-success pull-right" style="margin-top: 15px;" name="submit" value="tampilkan"><i class="ei-right-chevron-circle"></i> Tampilkan</button>
						</div>
					</div>
				</form>

				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" id="btn_frame" href="#home">Kacamata</a></li>
					<li><a data-toggle="tab" href="#menu1" id="btn_lensa">Cairan & Softlense</a></li>
				</ul>

				<div class="tab-content">
					<div id="home" class="tab-pane fade in active">
						<div class="form-group row">
							<div class="col-md-12">
								<a role="button" class="btn btn-sm btn-success pull-right" href="<?= site_url('laporan/download_excel/'.$id_toko.'/'.$start.'/'.$end) ?>" target="_blank">Download</a>
							</div>
						</div>
						<table id="tabel_list_laporan" class="table-overflow table table-striped table-overflow">
							<thead>
								<th></th>
								<th>Toko</th>
								<th>Pelanggan</th>
								<th>Frame</th>
								<th>Lensa</th>
								<th>Tanggal Beli</th>
								<th>Total Harga</th>
							</thead>
							<tbody></tbody>
						</table>
					</div>
					<div id="menu1" class="tab-pane fade">
						<div class="form-group row">
							<div class="col-md-12">
								<a role="button" class="btn btn-sm btn-success pull-right" href="<?= site_url('laporan/download_excel_cairan/'.$id_toko.'/'.$start.'/'.$end) ?>" target="_blank">Download</a>
							</div>
						</div>
						<table id="tabel_list_laporan_cairan" class="table-overflow table table-striped table-overflow" width="100%">
							<thead>
								<th></th>
								<th>Toko</th>
								<th>Tipe Barang</th>
								<th>Pelanggan</th>
								<th>Barang</th>
								<th>Tanggal Beli</th>
								<th>Total Harga</th>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		var toko = "<?= $id_toko ?>";
		var start = "<?= $start ?>";
		var end = "<?= $end ?>";
		table = $('#tabel_list_laporan').DataTable({
			dom: 'Bfrtip',
			buttons: [
			'excelHtml5',
			],
			"processing": true, 
			"serverSide": true, 
			"order": [], 

			"ajax": {

				"url": "<?= site_url('laporan/list_data/') ?>"+toko+'/'+start+'/'+end,
				"type": "POST"
			},

			"columnDefs": [{
				"targets": [0], 
				"orderable": false, 
			}, ],
		});

		table = $('#tabel_list_laporan_cairan').DataTable({
			dom: 'Bfrtip',
			buttons: [
			'excelHtml5',
			],
			"processing": true, 
			"serverSide": true, 
			"order": [], 

			"ajax": {

				"url": "<?= site_url('laporan/list_data_cairan/') ?>"+toko+'/'+start+'/'+end,
				"type": "POST"
			},

			"columnDefs": [{
				"targets": [0], 
				"orderable": false, 
			}, ],
		});


		$("#laporan").on("change", function() {
			var val = $(this).val();
			if(val == 1) {
				$("#tanggal_mulai").removeAttr("readonly");
			} else {
				$("#tanggal_mulai").attr("readonly", "readonly");
			}
		})

		$("#jenis").on("change", function() {
			var val = $(this).val();
			if(val == 1) {
				$.post("<?= site_url('master/master_data/option_frame/') ?>", '', function(data) {
					if(data.s == 'sukses') {
						$("#daftar_option").html(data.option);
					}
				}, 'json');
			} else if(val == 2) {
				$.post("<?= site_url('master/master_data/option_lensa/') ?>", '', function(data) {
					if(data.s == 'sukses') {
						$("#daftar_option").html(data.option);
					}
				}, 'json');
			} else if(val == 3) {
				$.post("<?= site_url('master/master_data/option_cairan/') ?>", '', function(data) {
					if(data.s == 'sukses') {
						$("#daftar_option").html(data.option);
					}
				}, 'json');
			} else {
				$.post("<?= site_url('master/master_data/option_frame/') ?>", '', function(data) {
					if(data.s == 'sukses') {
						$("#daftar_option").html(data.option);
					}
				}, 'json');
			}
		});
	});
</script>