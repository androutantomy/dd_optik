<div class="page-title text-right">
	<h4>Master Data <i class="ti-angle-right"></i> Master Data Gudang</h4>
</div>
<div class="container">
	<div class="card">
		<div class="card-block text-dark">
			<h4 class="card-title">Master Data Gudang</h4>
			<div class="card-body" id="data_gudang">
				<button class="btn btn-sm btn-success" id="tambah_data">Tambah Barang</button>
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" id="btn_frame" href="#home">Frame</a></li>
					<li><a data-toggle="tab" href="#menu1" id="btn_lensa">Lensa</a></li>
					<li><a data-toggle="tab" href="#menu2" id="btn_cairan">Cairan</a></li>
				</ul>

				<div class="tab-content">
					<div id="home" class="tab-pane fade in active">
						<h3>DATA FRAME</h3>
						<div id="data_frame"></div>
					</div>
					<div id="menu1" class="tab-pane fade">
						<h3>DATA LENSA</h3>
						<div id="data_lensa"></div>
					</div>
					<div id="menu2" class="tab-pane fade">
						<h3>DATA CAIRAN</h3>
						<div id="data_cairan"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$("#data_frame").load("<?= site_url('master/master_data/list_data_frame') ?>");
	});

	$("#tambah_data").on("click", function() {
		$("#data_gudang").load("<?= site_url('master/master_data/input_gudang') ?>");
	});

	$("#btn_frame").on("click", function() {
		$("#data_frame").load("<?= site_url('master/master_data/list_data_frame') ?>");
	});

	$("#btn_lensa").on("click", function() {
		$("#data_lensa").load("<?= site_url('master/master_data/list_data_lensa') ?>");
	});

	$("#btn_cairan").on("click", function() {
		$("#data_cairan").load("<?= site_url('master/master_data/list_data_cairan') ?>");
	});

	$(document).on("click", "#kembali", function() {
		location.reload();
	});
</script>