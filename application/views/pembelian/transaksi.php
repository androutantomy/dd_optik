<div class="row col-md-12">
	<button class="btn btn-sm btn-danger pull-right" onclick="location.reload()">Kembali</button>
</div>
<form id="input_pembelian">

	<div class="form-group row">
		<div class="col-md-1">
			<label>Nama Distributor</label>
		</div>
		<div class="col-md-1"> : </div>
		<div class="col-md-10">
			<input type="text" name="nama" id="nama" class="form-control input-sm" value="<?= isset($penjualan) ? $penjualan->nama : '' ?>" required="required">
		</div>
	</div>				
	<div class="form-group row">
		<div class="col-md-1">
			<label>Alamat</label>
		</div>
		<div class="col-md-1"> : </div>
		<div class="col-md-10">
			<input type="text" name="alamat" id="alamat" class="form-control input-sm" value="<?= isset($penjualan) ? $penjualan->alamat : '' ?>" required="required">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-1">
			<label>Telp</label>
		</div>
		<div class="col-md-1"> : </div>
		<div class="col-md-10">
			<input type="text" name="telp" id="telp" class="form-control input-sm" value="<?= isset($penjualan) ? $penjualan->telp : '' ?>" required="required">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-1">
			<label>Tipe Pembelian</label>
		</div>
		<div class="col-md-1"> : </div>
		<div class="col-md-5">
			<select class="form-control form-control-sm" name="tipe_pembelian" id="tipe_pembelian" required="required">
				<option value="1" <?= isset($penjualan) ? $penjualan->tipe_pembelian == 1 ? 'selected' : 'selected' : 'selected' ?>>Cash</option>
				<!-- <option value="2" <?= isset($penjualan) ? $penjualan->tipe_pembelian == 2 ? 'selected' : '' : '' ?>>BPJS</option> -->
			</select>
		</div>
		<div class="col-md-5" id="isBPJS">
			<input type="date" name="is_bpjs" id="is_bpjs" value="<?= isset($penjualan) ? $penjualan->is_bpjs : '' ?>" class="form-control input-sm">
		</div>
	</div>

	<div class="form-group row">
		<div class="col-md-2">Frame</div>
		<div class="col-md-5">
			<select class="form-control input-sm selectx" name="frame" id="frame">
				<option value="0">Pilih Frame</option>
				<?php foreach($frame as $val) { ?>
					<option value="<?= $val->id ?>" <?= isset($penjualan) ? $penjualan->id_frame == $val->id ? 'selected' : '' : '' ?> harga="<?= $val->harga_jual ?>">[ <?= $val->stok ?> ] <?= $val->nama ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-md-1">Rp.</div>
		<div class="col-md-2" style="text-align: right;">
			<input type="text" readonly="" name="harga_frame_asli"  id="harga_frame_asli" value="<?= isset($penjualan) ? $penjualan->harga_frame : '' ?>" class="form-control input-sm">
		</div>
		<div class="col-md-2" style="text-align: right;">
			<input type="text" name="harga_frame" style="text-align: right;" id="harga_frame" value="<?= isset($penjualan) ? $penjualan->potongan_frame : '' ?>" class="form-control potongan input-sm" value="0">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-2">Lensa</div>
		<div class="col-md-5">
			<select class="form-control input-sm selectx" name="lensa" id="lensa">
				<option value="0">Pilih Lensa</option>
				<?php foreach($lensa as $val) { 
					$type_lensa = "";	
					if($val->type_lensa == 1) {
						$type_lensa = "- MINUS - ".$val->min_max;;
					} elseif($val->type_lensa == 2) {
						$type_lensa = "- PLUS -".$val->min_max;;
					} elseif($val->type_lensa == 3) {
						$type_lensa = "- MINUS - PLUS -".$val->min_max;
					} elseif($val->type_lensa == 4) {
						$type_lensa = "- MINUS - ADD -".$val->min_max;
					} else {
						$type_lensa = "- PLUS - ADD -".$val->min_max;
					}
					?>
					<option value="<?= $val->id ?>" harga="<?= $val->harga_jual ?>" <?= isset($penjualan) ? $penjualan->id_lensa == $val->id ? 'selected' : '' : '' ?>>[ <?= $val->stok ?> ] <?= $type_lensa; ?> <?= $val->nama ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-md-1">Rp.</div>
		<div class="col-md-2" style="text-align: right;">
			<input type="text" readonly name="harga_lensa_asli" value="<?= isset($penjualan) ? $penjualan->harga_lensa : '' ?>" id="harga_lensa_asli" class="form-control input-sm">
		</div>
		<div class="col-md-2" style="text-align: right;">
			<input type="text" name="harga_lensa" style="text-align: right;" id="harga_lensa" value="<?= isset($penjualan) ? $penjualan->potongan_lensa : '' ?>" class="form-control potongan input-sm" value="0">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-2">Keterangan</div>
		<div class="col-md-5">
			<input type="text" name="keterangan" id="keterangan" value="<?= isset($penjualan) ? $penjualan->keterangan : '' ?>" class="form-control input-sm">
		</div>
		<div class="col-md-1">Rp.</div>
		<div class="col-md-4" style="text-align: right;">
			<input type="text" name="harga_keterangan" style="text-align: right;" value="<?= isset($penjualan) ? $penjualan->harga_keterangan : '' ?>" id="harga_keterangan" class="form-control input-sm" value="0"><br>
			<hr>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-5"></div>
		<div class="col-md-2">
			Jumlah
		</div>
		<div class="col-md-1">Rp.</div>
		<div class="col-md-2" style="text-align: right;" id="total_asli">
			<?= isset($penjualan) ? $penjualan->harga_frame+$penjualan->harga_lensa+$penjualan->harga_keterangan : '...............................' ?>
		</div>
		<div class="col-md-2" style="text-align: right;" id="total">
			
			<?= isset($penjualan) ? $penjualan->potongan_frame+$penjualan->potongan_lensa : '...............................' ?>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-5"></div>
		<div class="col-md-2">
			Uang Muka
		</div>
		<div class="col-md-1">Rp. </div>
		<div class="col-md-4">
			<input type="text" style="text-align: right;" value="<?= isset($penjualan) ? $penjualan->uang_muka : '' ?>" name="uang_muka" id="uang_muka" class="form-control input-sm" value="0">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-2">
			<label>Selesai Tgl</label>
		</div>
		<div class="col-md-3">
			<input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control input-sm" value="<?= isset($penjualan) ? $penjualan->tgl_selesai : '' ?>" required="required">
		</div>
		<div class="col-md-2">
			Sisa
		</div>
		<div class="col-md-1">Rp. </div>
		<div class="col-md-4">
			<input type="text" readonly style="text-align: right;" name="sisa" value="<?= isset($penjualan) ? $penjualan->sisa : '' ?>" id="sisa" class="form-control input-sm">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-12">
			<button class="btn btn-sm btn-success pull-right" type="submit"><?= isset($penjualan) ? 'Update' : 'Buat' ?> Nota</button>
		</div>
	</div>
</form>

<script>
	$("#isBPJS").hide();
	$("#add_penjualan").hide();

	$("#tipe_pembelian").on("change", function() {
		if($(this).val() == 2) {
			$("#isBPJS").show();
			$("#is_bpjs").attr("required", "required");
		} else {
			$("#isBPJS").hide();
			$("#is_bpjs").removeAttr("required");
		}
	});

	$("#frame").on("change", function() {
		var harga = $("#frame option:selected").attr("harga");
		format_angkat("harga_frame_asli", harga);
		format_angkat("total_asli", harga);
	});

	$("#lensa").on("change", function() {
		var harga = $("#lensa option:selected").attr("harga");
		format_angkat("harga_lensa_asli", harga);
		format_angkat("total_asli", harga);
	});

	$("#harga_keterangan").keyup(function() {
		var harga = $(this).val();
		format_angkat("total_asli_", harga);

	});

	$("#uang_muka").keyup(function() {
		var harga = $(this).val();
		format_angkat("sisa", harga);
	});

	$(".potongan").keyup(function() {
		var harga_lensa = parseInt($("#harga_lensa").val());
		var harga_frame = parseInt($("#harga_frame").val());
		var total = harga_frame+harga_lensa;
		format_angkat("total", total);
	})

	function format_angkat(target, harga) 
	{
		var harga_frame = parseInt($("#frame option:selected").attr("harga"));
		var harga_lensa = parseInt($("#lensa option:selected").attr("harga"));
		if(target == 'total_asli' && harga_lensa != NaN && harga_frame != NaN) {
			harga = harga_frame+harga_lensa;
		} else if(target == 'total_asli' && harga_frame != NaN && harga_lensa == NaN) {
			harga = harga_frame;
		} else if(target == 'total_asli' && harga_frame == NaN && harga_lensa != NaN) {
			harga = harga_lensa;
		} else if(target == 'sisa') {
			var potongan_lensa = parseInt($("#harga_lensa").val());
			var potongan_frame = parseInt($("#harga_frame").val());
			var harga_keterangan = parseInt($("#harga_keterangan").val());
			var total_potongan = potongan_frame+potongan_lensa;
			harga = harga_lensa+harga_frame-harga-total_potongan+harga_keterangan;
		} else if(target == 'total_asli_') {			
			harga = harga_lensa+harga_frame+harga_keterangan;
		}

		var	number_string = harga.toString(),

		sisa 	= number_string.length % 3,
		rupiah 	= number_string.substr(0, sisa),
		ribuan 	= number_string.substr(sisa).match(/\d{3}/g);

		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		$("#"+target).val(rupiah);
		if(target == 'total_asli' || target == 'total') {
			$("#"+target).html(rupiah);
		} else if(target == 'total_asli_') {
			$("#total_asli").html(rupiah);
		}
	}



	$("#input_pembelian").on('submit', (function(e) {
		e.preventDefault(e);
		var id = "<?= isset($penjualan) ? md5($penjualan->id) : ''; ?>";
		$("#modal_loader").show();

		$.ajax({
			url: "<?= site_url() ?>Penjualan/simpan_data/"+id,
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			dataType: 'json',
			processData: false,
			success: function(respon) {
				if (respon.s == 'sukses') {
					alert(respon.m);
					window.open("<?= site_url('penjualan/nota/') ?>"+respon.url);
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