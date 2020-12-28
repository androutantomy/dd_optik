
<link href="<?php echo base_url('assets/select2/css/select2.min.css')?>" rel="stylesheet">
<script src="<?php echo base_url('assets/select2/js/select2.full.min.js') ?>"></script>
<div class="row col-md-12">
	<button class="btn btn-sm btn-danger pull-right" onclick="location.reload()">Kembali</button>
</div>
<form id="penjualan_barang">
	<div class="form-group row">
		<div class="col-md-3">Nama Pelanggan</div>
		<div class="col-md-9">
			<input type="text" name="nama" id="nama" required="required" value="<?= $pembelian != '' ? $pembelian->nama : ''; ?>" class="form-control form-control-sm input-sm" placeholder="Nama Pelanggan">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-3">Alamat Pelanggan</div>
		<div class="col-md-9">
			<input type="text" name="alamat" id="alamat" required="required" value="<?= $pembelian != '' ? $pembelian->alamat : ''; ?>" class="form-control form-control-sm input-sm" placeholder="Alamat Pelanggan">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-3">Telepon</div>
		<div class="col-md-9">
			<input type="text" name="telp" id="telp" class="form-control form-control-sm input-sm" value="<?= $pembelian != '' ? $pembelian->telp : ''; ?>" required="required" placeholder="Telepon Pelanggan">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-3">
			<label>Jenis Barang</label>
			<select class="form-control form-control-sm inputan_user" name="jenis" id="jenis">
				<option value="">Pilih Jenis Barang</option>
				<option value="1">Cairan</option>
				<option value="2">Softlense</option>
			</select>
		</div>
		<div class="col-md-3">
			<label>Pilih</label>
			<div id="select_option">
				<select class="form-control form-control-sm">
				</select>
			</div>
		</div>
		<div class="col-md-3" id="isSoftlense">
			<label>SPH</label>
			<select name="sph" id="sph" class="form-control input-sm select2option">
				<?php for($i=10; $i>0; $i-=0.25) { $current = strlen($i)<= 1 ? '-'.$i.'.00' : '-'.$i; ?>
					<option value="<?= strlen($i) <= 1 ? '-'.$i.'.00' : '-'.$i; ?>" <?= $pembelian != '' ? $pembelian->sph == $current ? 'selected' : '' : '' ?>> <?= strlen($i) <= 1 ? '-'.$i.'.00' : '-'.$i; ?></option>
				<?php } ?>

				<?php for($i=0; $i<10; $i+=0.25) { $current1 = strlen($i) <= 1 ? $i.'.00' : $i; ?>
					<option value="<?= strlen($i) <= 1 ? '+'.$i.'.00' : '+'.$i; ?>" <?= $pembelian != '' ? $pembelian->sph == $current1 ? 'selected' : '' : '' ?>><?= strlen($i) <= 1 ? '+'.$i.'.00' : '+'.$i; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-md-3">
			<label>Jumlah Barang</label>
			<input type="text" value="<?= $pembelian != '' ? $pembelian->qty : ''; ?>" name="qty" id="qty" class="form-control form-control-sm input-sm inputan_user" placeholder="QTY Barang">
		</div>
		<div class="col-md-3"><br><br>
			<label id="pesan_cairan"></label>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-3"></div>
		<div class="col-md-3">
			<br><br>
			<span id="harga_barang"></span>
		</div>
		<div class="col-md-6">
			<label>Nominal</label>
			<input type="hidden" name="id_transaksi_barang" id="id_transaksi_barang" value="<?= $pembelian != '' ? md5($pembelian->id) : ''; ?>">
			<input type="text" name="nominal" id="nominal" class="form-control form-control-sm input-sm inputan_user" value="<?= $pembelian != '' ? $pembelian->nominal : ''; ?>" placeholder="Rp. ">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-12">
			<button class="btn btn-sm btn-success pull-right" type="submit">Simpan Transaksi</button>
		</div>
	</div>
</form>

<script>
	$(".select2option").select2();
	$("#add_penjualan").hide();
	$("#add_jual_cairan").hide();
	$("#isSoftlense").hide();
	$("#pesan_cairan").text("");

	$(document).ready(function() {
		var jenis_brg = "<?= $pembelian != '' ? $pembelian->id_jenis : ''; ?>";

		if(jenis_brg != '') {
			setTimeout(function() {
				$("#jenis").val(jenis_brg);
				$("#jenis").trigger("change");
			}, 1000);

			if(jenis_brg == 1) {
				var id = "<?= $pembelian != '' ? $pembelian->id_barang : ''; ?>";
				setTimeout(function() {
					$("#cairan").val(id);
					$("#cairan").trigger("change");
				}, 2000);
			} else {				
				var id = "<?= $pembelian != '' ? $pembelian->id_barang : ''; ?>";
				setTimeout(function() {
					$("#softlense").val(id);
					$("#softlense").trigger("change");
				}, 2000);
			}
		}
	});

	$("#qty").keyup(function() {
		var id_jns = $("#jenis").val();

		if(id_jns == 1) {
			var id = $("#cairan").val();
			var qty = $(this).val();
			$.post("<?= site_url('penjualan/harga_barang/') ?>"+id+"/"+qty+"/cairan", '', function(data) {
				if(data.s == 'sukses') {
					$("#harga_barang").text("Harga Barang Rp."+data.harga);
					$("#nominal").val(data.total);
				} else {
					alert(data.m);
				}
			}, 'json');
		} else {
			var id = $("#softlense").val();
			var qty = $(this).val();
			$.post("<?= site_url('penjualan/harga_barang/') ?>"+id+"/"+qty+"/softlense", '', function(data) {
				if(data.s == 'sukses') {
					$("#harga_barang").text("Harga Barang Rp."+data.harga);
					$("#nominal").val(data.total);
				} else {
					alert(data.m);
				}
			}, 'json');
		}
	});

	$("#jenis").on("change", function() {
		var id = $(this).val();

		if(id == '1') {
			$("#isSoftlense").hide();
			$("#pesan_cairan").text("");
			$.post("<?= site_url('penjualan/option_cairan') ?>", '', function(data) {
				if(data.s == 'sukses') {
					$("#select_option").html(data.option);
					$("#sph").removeAttr("required");
				};
			}, 'json');
		} else {
			$("#isSoftlense").show();
			$("#pesan_cairan").text("");
			$.post("<?= site_url('penjualan/option_softlense') ?>", '', function(data) {
				if(data.s == 'sukses') {
					$("#select_option").html(data.option);
					$("#sph").attr("required", "required");
				};
			}, 'json');
		}
	});

	$(document).on('change', "#cairan, #softlense", function() {
		$.post("<?= site_url('penjualan/cek_expired/') ?>"+$(this).val(), "", function(data) {
			if(data.s == true) {
				$("#pesan_cairan").text(data.m);
			}
		}, 'json');
	});

	$("#penjualan_barang").on('submit', (function(e) {
		e.preventDefault(e);
		$.ajax({
			url: "<?= site_url() ?>Penjualan/simpan_transaksi/",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			dataType: 'json',
			processData: false,
			success: function(respon) {
				if (respon.s == 'sukses') {
					var pembelian = "<?= $pembelian != '' ? 'yes' : 'no'; ?>";
					alert(respon.m);
					if(pembelian == 'no') {
						window.open("<?= site_url('penjualan/nota_barang/') ?>"+respon.url);
					} else {
						location.reload();
						window.open("<?= site_url('penjualan/nota_barang/') ?>"+respon.url);
					}
					$(".inputan_user").val("");
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