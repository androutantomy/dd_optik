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
						<div class="col-md-3">
							<input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control input-sm" placeholder="Isikan tanggal mulai">
						</div>
						<div class="col-md-3">
							<input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control form-control-sm input-sm" placeholder="Isikan tanggal selesai">
						</div>
						<div class="col-md-2">
							<select class="form-control form-control-sm input-sm" name="jenis" id="jenis">
								<option value="0">Pilih Jenis</option>
								<option value="1">Frame</option>
								<option value="2">Lensa</option>
								<option value="3">Cairan</option>
								<option value="4">Lain</option>
							</select>
						</div>
						<div class="col-md-2" id="daftar_option">
						</div>
						<div class="col-md-2">
							<button class="btn btn-sm btn-success"><i class="ei-right-chevron-circle"></i> Tampilkan</button>
						</div>
					</div>
				</form>
				<br>
				<div id="diagram">
					
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
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