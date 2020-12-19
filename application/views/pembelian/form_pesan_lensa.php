<div class="page-title text-right">
	<h4>Pesan Lensa <i class="ti-angle-right"></i> Pesan Lensa</h4>
</div>
<div class="container">
	<div class="card">
		<div class="card-block text-dark">
			<h4 class="card-title">Daftar Pesan Lensa</h4>
			<div class="card-body">
				<form id="form_pesan_lensa">
					<hr>
					<div class="form-group row">						
						<div class="col-md-6">
							<label>Jenis Mata</label>
							<select name="jenis_mata" id="jenis_mata" class="form-control form-control-sm input-sm">
								<option value="l">Kiri</option>
								<option value="r">Kanan</option>
							</select>
						</div>
						<div class="col-md-6"></div>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label>Jenis Barang</label>
							<input type="hidden" name="id_pesanan" value="<?= $this->uri->segment(3); ?>">
							<select class="form-control input-sm select2option form-control-sm pilih_jenis_barang" name="jenis_barangl" typeLensa="L" id="jenis_barang">
								<option value="1">Sudah ada</option>
								<option value="2">Baru</option>
							</select>
						</div>
						<div class="col-md-6" id="lensaL">
							<label>Lensa</label>
							<select class="form-control input-sm form-control-sm select2option" name="lensal" id="lensa_pesan">
								<option value="0">Pilih Lensa</option>
								<?php foreach($master_lensa as $val) { ?>
									<option value="<?= $val->id ?>"><?= $val->nama ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-6" id="nama_lensa_L">
							<label>Nama Lensa</label>
							<input type="text" name="nama_lensal" id="nama_lensal" class="form-control form-control-sm input-sm" placeholder="Nama Lensa">
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-6">
							<label>Jenis Lensa</label>
							<select class="form-control form-control-sm select2option input-sm" name="tipe_lensal" id="tipe_lensal" placeholder="Pilih Tipe Lensa">
								<option value="0">Pilih Jenis Lensa</option>
								<option value="1">Biasa</option>
								<option value="2">Kroptik</option>
							</select>
						</div>
						<div class="col-md-6">
							<label>Tipe Lensa</label>
							<select class="form-control form-control-sm" name="type_lensal" id="type_lensal">
								<option value="">Pilih Tipe Lensa</option>
								<option value="1">Minus</option>
								<option value="2">Plus</option>
								<option value="3">Minus & Plus</option>
								<option value="4">Minus & Additional</option>
								<option value="5">Plus & Additional</option>
							</select>
						</div>		
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label></label>
							<input type="text" name="minusl" id="minusl" class="form-control form-control-sm input-sm" placeholder="Minus">
						</div>
						<div class="col-md-6">
							<label></label>
							<input type="text" name="plusl" id="plusl" class="form-control form-control-sm input-sm" placeholder="Plus">
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-4">
							<label>SPH</label>
							<input type="text" name="sphl" id="sphl" class="form-control form-control-sm input-sm" placeholder="SPH">
						</div>
						<div class="col-md-4">
							<label>CYL</label>
							<input type="text" name="cyll" id="cyll" class="form-control form-control-sm input-sm" placeholder="CYL">
						</div>
						<div class="col-md-4">
							<label>ADD</label>
							<input type="text" name="addl" id="addl" class="form-control form-control-sm input-sm" placeholder="ADD">
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-6">
							<label>Harga Beli</label>
							<input type="text" name="harga_belil" id="harga_belil" class="form-control form-control-sm input-sm" placeholder="Harga beli">						
						</div>
						<div class="col-md-6">
							<label>Harga Jual</label>
							<input type="text" name="harga_juall" id="harga_juall" class="form-control form-control-sm input-sm" placeholder="Harga jual">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<a href="<?= site_url('Pesan_lensa') ?>" role="button" class="btn btn-sm btn-danger pull-right">Selesai</a>
							<button class="btn btn-sm btn-success pull-right" type="submit"><i class="fa fa-paper-plane-o"></i> Pesan Lensa</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>	
	$("#nama_lensa_L").hide();
	$("#nama_lensa_R").hide();

	$(".pilih_jenis_barang").on("change", function() {
		var jenis = $(this).attr("typeLensa");
		var val = $(this).val();

		if(val == "2") {
			$("#lensa"+jenis).hide();
			$("#nama_lensa_"+jenis).show();
		} else {
			$("#lensa"+jenis).show();
			$("#nama_lensa_"+jenis).hide();
		}
	});

	$("#form_pesan_lensa").on('submit', (function(e) {
		e.preventDefault(e);
		var id = "<?= isset($penjualan) ? md5($penjualan->id) : ''; ?>";
		$("#modal_loader").show();

		$.ajax({
			url: "<?= site_url() ?>Pesan_lensa/simpan_data/",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			dataType: 'json',
			processData: false,
			success: function(respon) {
				if (respon.s == 'sukses') {
					alert(respon.m);
					$("#lensa_pesan").val(0);
					$("#lensa_pesan").trigger("change");
					$("#nama_lensal").val("");
					$("#tipe_lensal").val(0);
					$("#tipe_lensal").trigger("change");
					$("#type_lensal").val(0);
					$("#type_lensal").trigger("change");
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