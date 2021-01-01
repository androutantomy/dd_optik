<div class="page-title text-right">
	<h4>Penjualan <i class="ti-angle-right"></i> Penjualan</h4>
</div>
<div class="container">
	<div class="card">
		<div class="card-block text-dark">
			<h4 class="card-title">Transaksi Penjualan</h4>
			<div class="card-body">
				<button class="btn btn-sm btn-success" id="add_penjualan">Kacamata</button>
				<button class="btn btn-sm btn-success" id="add_jual_cairan">Cairan & Softlense</button>

				<div id="transaksi_penjualan">


					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" id="btn_frame" href="#home">Kacamata</a></li>
						<li><a data-toggle="tab" href="#menu1" id="btn_lensa">Cairan</a></li>
					</ul>

					<div class="tab-content">
						<div id="home" class="tab-pane fade in active">
							<table id="list_penjualan" class="table-overflow table table-striped table-overflow">
								<thead>
									<th></th>
									<th>Nama Pelanggan</th>
									<th>Tanggal Transaksi</th>
									<!-- <th>Tanggal Selesai</th> -->
									<th>Status Transaksi</th>
									<th></th>
								</thead>
								<tbody>

								</tbody>
							</table>
						</div>
						<div id="menu1" class="tab-pane fade">
							<table id="list_penjualan_cairan" width="100%" class="table-overflow table table-striped table-overflow">
								<thead>
									<th></th>
									<th>Nama Pelanggan</th>
									<th>Tanggal Transaksi</th>
									<th>Jenis Barang</th>
									<th></th>
								</thead>
								<tbody>

								</tbody>
							</table>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$("#add_penjualan").on('click', function() {
		$("#transaksi_penjualan").load("<?= site_url('penjualan/add') ?>");
		$(this).hide();
	});

	$("#add_jual_cairan").on('click', function() {
		$("#transaksi_penjualan").load("<?= site_url('penjualan/cairan') ?>");
	});

	$(document).on('click', '.nota, .nota_produksi', function() {
		var id = $(this).attr('id');
		var type = $(this).attr('type');

		if(type == 'nota') {
			location.href = ("<?= site_url('penjualan/nota/') ?>"+id);
		} else {
			location.href = ("<?= site_url('penjualan/nota_produksi/') ?>"+id);
		}
	});

	$(document).on("click", ".transaksi_selesai", function() {
		var id = $(this).attr("id");
		var conf = confirm("Apakah anda yakin ?");

		if(conf == true){
			$.post("<?= site_url('penjualan/transaksi_selesai/') ?>"+id, "", function(data) {
				if(data.s == "sukses") {
					alert(data.m);
					location.reload();
				} else {
					alert(data.m);
				}
			}, "json"); 
		}
	});

	$(document).on('click', '.pelunasan', function() {
		var id = $(this).attr('id');

		$("#transaksi_penjualan").load("<?= site_url('penjualan/add/') ?>"+id);
	});

	$(document).on('click', '.pelunasan_cairan', function() {
		var id = $(this).attr('id');

		$("#transaksi_penjualan").load("<?= site_url('penjualan/cairan/') ?>"+id);
	});


	$(document).ready(function() {
		table = $('#list_penjualan').DataTable({
			dom: 'Bfrtip',
			buttons: [
			'excelHtml5',
			],
			"processing": true, 
			"serverSide": true, 
			"order": [], 

			"ajax": {

				"url": "<?= site_url('penjualan/list_data') ?>",
				"type": "POST"
			},

			"columnDefs": [{
				"targets": [0], 
				"orderable": false, 
			}, ],
		});
	});

	$(document).ready(function() {
		table = $('#list_penjualan_cairan').DataTable({
			dom: 'Bfrtip',
			buttons: [
			'excelHtml5',
			],
			"processing": true, 
			"serverSide": true, 
			"order": [], 

			"ajax": {

				"url": "<?= site_url('penjualan/list_data_cairan') ?>",
				"type": "POST"
			},

			"columnDefs": [{
				"targets": [0], 
				"orderable": false, 
			}, ],
		});
	});
</script>