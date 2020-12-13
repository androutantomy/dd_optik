<div class="row col-md-12">
	<button class="btn btn-sm btn-danger pull-right" onclick="location.reload()">Kembali</button>
</div>
<form id="jual_cairan">
	<div class="form-group row">
		<div class="col-md-6 row">
			<div class="col-md-6">
				<select class="form-control form-control-sm" name="jenis" id="jenis">
					<option value="0">Pilih Jenis Barang</option>
					<option value="1">Cairan</option>
					<option value="2">Lainnya</option>
				</select>
			</div>
			<div class="col-md-6" id="select_option">
				<select class="form-control form-control-sm" name="jenis" id="jenis">
				</select>
			</div>
		</div>
	</div>
</form>

<script>
	$("#add_penjualan").hide();
	$("#add_jual_cairan").hide();

	$("#jenis").on("change", function() {
		var id = $(this).val();

		if(id == '1') {
			$.post("<?= site_url('master/master_data/option_cairan') ?>", '', function(data) {
				if(data.s == 'sukses') {
					$("#select_option").html(data.option);
				};
			}, 'json');
		}
	});
</script>