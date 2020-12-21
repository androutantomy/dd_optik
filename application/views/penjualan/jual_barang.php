<div class="row col-md-12">
	<button class="btn btn-sm btn-danger pull-right" onclick="location.reload()">Kembali</button>
</div>
<form id="jual_cairan">
	<form id="penjualan_barang">
		<div class="form-group row">
			<div class="col-md-3">Nama Pelanggan</div>
			<div class="col-md-9">
				<input type="text" name="nama" id="nama" class="form-control form-control-sm input-sm" placeholder="Nama Pelanggan">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-md-3">
				<label>Jenis Barang</label>
				<select class="form-control form-control-sm" name="jenis" id="jenis">
					<option value="0">Pilih Jenis Barang</option>
					<option value="1">Cairan</option>
					<option value="2">Lainnya</option>
				</select>
			</div>
			<div class="col-md-3">
				<label>Pilih</label>
				<div id="select_option">
					<select class="form-control form-control-sm" name="jenis" id="jenis">
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<label>Nominal</label>
				<input type="hidden" name="id_transaksi_barang" id="id_transaksi_barang">
				<input type="text" name="nominal" id="nominal" class="form-control form-control-sm input-sm" placeholder="Rp. ">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-md-12">
				<button class="btn btn-sm btn-success pull-right" type="submit">Simpan Transaksi</button>
			</div>
		</div>
	</form>
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

	$("#penjualan_barang").on('submit', (function(e) {

		$.ajax({
			url: "<?= site_url() ?>Penjualan/simpan_transaksi/"+id,
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			dataType: 'json',
			processData: false,
			success: function(respon) {
				if (respon.s == 'sukses') {
					alert(respon.m);
					if(respon.next == "oke") {
						window.open("<?= site_url('penjualan/nota/') ?>"+respon.url);
					} else {
						window.open("<?= site_url('pesan_lensa/pesan/') ?>"+respon.url);
					}
				} else {
					alert(respon.m);
				}
			},
			error: function() {
				$(':input[type="submit"]').prop('disabled', true);
				alert('Gagal simpan data');
				$(':input[type="submit"]').prop('disabled', false);
				$("#modal_loader").hide();
			}
		});
	}));
</script>