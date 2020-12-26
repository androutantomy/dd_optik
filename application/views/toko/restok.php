<form id="restok_toko">
	<div class="form-group row" <?= $this->session->userdata("id_level") != 3 ? "hidden" : "";  ?>>
		<div class="col-md-2">
			<label>Pilih Tipe Transaksi</label>
		</div>
		<div class="col-md-5">
			<select class="form-control form-control-sm" id="tipe" name="tipe">
				<option value="1">Dari Gudang</option>
				<option value="2" <?= $this->session->userdata("id_level") != 3 ? "" : "selected"; ?>>Dari Toko</option>
			</select>
		</div>
		<div class="col-md-5">
			<select class="form-control form-control-sm" id="toko_asal" name="toko_asal">
				<?php foreach($daftar_toko as $val) { ?>
					<option value="<?= $val->id ?>"><?= $val->nama_toko; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-2">
			<label class="control-label">Pilih Jenis Barang</label>
		</div>
		<div class="col-md-5">
			<select class="form-control form-control-sm" id="jenis" name="jenis" required="required">
				<option value="">Pilih Jenis Barang</option>
				<option value="1">Frame</option>
				<option value="2">Lensa</option>
				<option value="3">Cairan</option>
			</select>
		</div>		
		<div class="col-md-5" id="selected_jenis">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-2"><label class="control-label"></label></div>
		<div class="col-md-5">
			<select class="form-control form-control-sm" name="toko" id="toko" required="required">
				<option value="">Pilih Toko</option>
				<?php foreach($toko as $val) { ?>
					<option value="<?= $val->id ?>"><?= $val->nama_toko ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-md-5">
			<input type="text" name="stok" id="stok" class="form-control form-control-sm" placeholder="Isikan banyak produk" required="required">
		</div>
	</div>
	<div id="message"></div>
	<button class="btn btn-sm btn-success pull-right" type="submit">Restok Toko</button>
</form>

<script>
	$(document).ready(function() {
		$("#message").html("");
		$("#toko_asal").hide();

		$("#tipe").on("change", function() {
			var id = $(this).val();
			if(id == 2) {
				$("#toko_asal").show();
			} else {
				$("#toko_asal").hide();
			}
		});
	});

	$("#jenis").on("change", function() {
		var selected = $(this).val();

		$.post("<?= site_url('toko/list_barang/') ?>"+selected, "", function(d) {
			if(d.s == "sukses") {
				$("#selected_jenis").html(d.option);
			} else {
				var msg = '<i class="fa fa-times-circle"></i> '+d.m;
				$("#message").html(msg);
				$("#message").attr('style', 'color: red;');
			}
		}, "json");
	});

	$('#restok_toko').on('submit', function(e) {
		e.preventDefault();
		$("#message").html("");

		$.ajax({
			url: "<?= site_url('toko/simpan_data_restok_toko') ?>",
			type: "POST",
			data:  $("#restok_toko").serialize(),
			cache: false,
			dataType: 'json',
			processData:false,
			success: function(respon){
				if(respon.s == 'sukses') {
					var msg = '<i class="fa fa-check-circle-o"></i> '+respon.m;
					$("#message").html(msg);
					$("#message").attr('style', 'color: green;');
					$("#jenis").val();
					$("#jenis").trigger("change");
				} else {
					var msg = '<i class="fa fa-times-circle"></i> '+respon.m;
					$("#message").html(msg);
					$("#message").attr('style', 'color: red;');
				}
			},
			error: function(){        
				alert('Upss, Terjadi Kesalahan, Silahkan coba kembali');
			}
		});
	});
</script>