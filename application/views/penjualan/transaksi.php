
<link href="<?php echo base_url('assets/select2/css/select2.min.css')?>" rel="stylesheet">
<script src="<?php echo base_url('assets/select2/js/select2.full.min.js') ?>"></script>
<div class="row col-md-12">
	<button class="btn btn-sm btn-danger pull-right" onclick="location.reload()">Kembali</button>
</div>
<form id="input_penjualan">

	<div class="form-group row">
		<div class="col-md-1">
			<label>Nama</label>
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
				<option value="2" <?= isset($penjualan) ? $penjualan->tipe_pembelian == 2 ? 'selected' : '' : '' ?>>BPJS</option>
			</select>
		</div>
		<div class="col-md-5" id="isBPJS">
			<!-- <input type="date" name="is_bpjs" id="is_bpjs" value="<?= isset($penjualan) ? $penjualan->is_bpjs : '' ?>" class="form-control input-sm"> -->
		</div>
	</div>
	<div class="form-group">
		<table border="1">
			<tr>
				<th width="5%"></th>
				<th width="15%" style="text-align: center;">SPH</th>
				<th width="15%" style="text-align: center;">CYL</th>
				<th width="15%" style="text-align: center;">AXIS</th>
				<th width="15%" style="text-align: center;">ADD</th>
				<th  style="text-align: center;" rowspan="3">
					<table border="0">
						<tr>
							<td rowspan="5"><span style="font-size: 25px;">PD</span></td>
						</tr>
						<tr>									
							<td>Jauh</td>
							<td><input type="text" name="pd_jauh" id="pd_jauh" value="<?= isset($penjualan) ? $penjualan->pd_jauh : '' ?>" class="form-control input-sm"></td>
							<td>m/m</td>
						</tr>
						<tr>
							<td >Dekat</td>
							<td><input type="text" name="pd_dekat" id="pd_dekat" class="form-control input-sm" value="<?= isset($penjualan) ? $penjualan->pd_dekat : '' ?>"></td>
							<td>m/m</td>
						</tr>
					</table>
				</th>
			</tr>
			<tr>
				<td><center>R</center></td>
				<td>
					<select name="sphr" id="sphr" class="form-control input-sm select2option">
						<?php for($i=10; $i>0; $i-=0.25) { $current = strlen($i)<= 1 ? '-'.$i.'.00' : '-'.$i; ?>
						<option value="<?= strlen($i) <= 1 ? '-'.$i.'.00' : '-'.$i; ?>" <?= isset($penjualan) ? $penjualan->rsph == $current ? 'selected' : '' : '' ?>> <?= strlen($i) <= 1 ? '-'.$i.'.00' : '-'.$i; ?></option>
					<?php } ?>

					<?php for($i=0; $i<10; $i+=0.25) { $current1 = strlen($i) <= 1 ? $i.'.00' : $i; ?>
					<option value="<?= strlen($i) <= 1 ? '+'.$i.'.00' : '+'.$i; ?>" <?= isset($penjualan) ? $penjualan->rsph == $current1 ? 'selected' : '' : '' ?>><?= strlen($i) <= 1 ? '+'.$i.'.00' : '+'.$i; ?></option>
				<?php } ?>
			</select>
		</td>
		<td>
			<select name="cylr" id="cylr" class="form-control input-sm select2option">
				<?php for($i=10; $i>0; $i-=0.25) { $current2 = strlen($i) <= 1 ? '-'.$i.'.00' : '-'.$i; ?>
				<option value="<?= strlen($i) <= 1 ? '-'.$i.'.00' : '-'.$i; ?>" <?= isset($penjualan) ? $penjualan->rcyl == $current2 ? 'selected' : '' : '' ?> ><?= strlen($i) <= 1 ? '-'.$i.'.00' : '-'.$i; ?></option>
			<?php } ?>
			<?php for($i=0; $i<10; $i+=0.25) { $current3 = strlen($i) <= 1 ? $i.'.00' : $i; ?>
			<option value="<?= strlen($i) <= 1 ? '+'.$i.'.00' : '+'.$i; ?>" <?= isset($penjualan) ? $penjualan->rcyl == $current3 ? 'selected' : '' : '' ?>><?= strlen($i) <= 1 ? '+'.$i.'.00' : '+'.$i; ?></option>
		<?php } ?>
	</select>
</td>
<td>
	<input type="text" name="axisr" id="axisr" value="<?= isset($penjualan) ? $penjualan->raxis : '' ?>" class="form-control input-sm">
</td>
<td>
	<select name="addr" id="addr" class="form-control input-sm select2option">
		<!-- <?php for($i=10; $i>0; $i-=0.25) { $current4 = strlen($i) <= 1 ? '-'.$i.'.00' : '-'.$i; ?>
		<option value="<?= strlen($i) <= 1 ? '-'.$i.'.00' : '-'.$i; ?>" <?= isset($penjualan) ? $penjualan->radd == $current4 ? 'selected' : '' : '' ?> ><?= strlen($i) <= 1 ? '-'.$i.'.00' : '-'.$i; ?></option>
	<?php } ?> -->
	<?php for($i=0; $i<10; $i+=0.25) { $current5 = strlen($i) <= 1 ? $i.'.00' : $i; ?>
	<option value="<?= strlen($i) <= 1 ? '+'.$i.'.00' : '+'.$i; ?>" <?= isset($penjualan) ? $penjualan->radd == $current5 ? 'selected' : '' : '' ?>><?= strlen($i) <= 1 ? '+'.$i.'.00' : '+'.$i; ?></option>
<?php } ?>
</select>
</td>
</tr>
<tr>
	<td><center>L</center></td>
	<td>
		<select name="sphl" id="sphl" class="form-control input-sm select2option">
			<?php for($i=10; $i>0; $i-=0.25) { $current6 = strlen($i) <= 1 ? '-'.$i.'.00' : '-'.$i; ?>
			<option value="<?= strlen($i) <= 1 ? '-'.$i.'.00' : '-'.$i; ?>" <?= isset($penjualan) ? $penjualan->lsph == $current6 ? 'selected' : '' : '' ?> ><?= strlen($i) <= 1 ? '-'.$i.'.00' : '-'.$i; ?></option>
		<?php } ?>
		<?php for($i=0; $i<10; $i+=0.25) { $current7 = strlen($i) <= 1 ? $i.'.00' : $i; ?>
		<option value="<?= strlen($i) <= 1 ? '+'.$i.'.00' : '+'.$i; ?>" <?= isset($penjualan) ? $penjualan->lsph == $current7 ? 'selected' : '' : '' ?>><?= strlen($i) <= 1 ? '+'.$i.'.00' : '+'.$i; ?></option>
	<?php } ?>
</select>
</td>
<td>
	<select name="cyll" id="cyll" class="form-control input-sm select2option">
		<?php for($i=10; $i>0; $i-=0.25) { $current8 = strlen($i) <= 1 ? '-'.$i.'.00' : '-'.$i; ?>
		<option value="<?= strlen($i) <= 1 ? '-'.$i.'.00' : '-'.$i; ?>" <?= isset($penjualan) ? $penjualan->lcyl == $current8 ? 'selected' : '' : '' ?> ><?= strlen($i) <= 1 ? '-'.$i.'.00' : '-'.$i; ?></option>
	<?php } ?>
	<?php for($i=0; $i<10; $i+=0.25) { $current9 = strlen($i) <= 1 ? $i.'.00' : $i; ?>
	<option value="<?= strlen($i) <= 1 ? '+'.$i.'.00' : '+'.$i; ?>" <?= isset($penjualan) ? $penjualan->lcyl == $current9 ? 'selected' : '' : '' ?>><?= strlen($i) <= 1 ? '+'.$i.'.00' : '+'.$i; ?></option>
<?php } ?>
</select>
</td>
<td>
	<input type="text" name="axisl" id="axisl" value="<?= isset($penjualan) ? $penjualan->laxis : '' ?>" class="form-control input-sm">
</td>
<td>
	<select name="addl" id="addl" class="form-control input-sm select2option">
		<!-- <?php for($i=10; $i>0; $i-=0.25) { $current10 = strlen($i) <= 1 ? '-'.$i.'.00' : '-'.$i; ?>
		<option value="<?= strlen($i) <= 1 ? '-'.$i.'.00' : '-'.$i; ?>" <?= isset($penjualan) ? $penjualan->ladd == $current10 ? 'selected' : '' : '' ?> ><?= strlen($i) <= 1 ? '-'.$i.'.00' : '-'.$i; ?></option>
	<?php } ?> -->
	<?php for($i=0; $i<10; $i+=0.25) { $current11 = strlen($i) <= 1 ? $i.'.00' : $i; ?>
	<option value="<?= strlen($i) <= 1 ? '+'.$i.'.00' : '+'.$i; ?>" <?= isset($penjualan) ? $penjualan->ladd == $current11 ? 'selected' : '' : '' ?>><?= strlen($i) <= 1 ? '+'.$i.'.00' : '+'.$i; ?></option>
<?php } ?>
</select>
</td>
</tr>
</table>
</div>
<div class="form-group row">
	<div class="col-md-2">Frame</div>
	<div class="col-md-5">
		<select class="form-control input-sm selectx select2option" name="frame" id="frame">
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
		<select class="form-control input-sm selectx select2option" name="lensa" id="lensa">
			<option value="0">Pilih Lensa</option>
			<?php foreach($lensa as $val) { ?>
				<option value="<?= $val->id_data_lensa ?>" harga="<?= $val->harga_jual ?>" <?= isset($penjualan) ? $penjualan->id_lensa == $val->id_data_lensa ? 'selected' : '' : '' ?>>[ <?= $val->stok ?> ] <?= $val->nama ?></option>
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
		<input type="text" name="keterangan" id="keterangan" value="<?= isset($penjualan) ? $penjualan->keterangan : '' ?>" class="form-control input-sm"><br>
		<div class="checkbox checkbox-inline checkbox-primary">
			<input id="form-4-1" name="pesan_lensa" id="pesan_lensa" value="1" stateA="0" type="checkbox">
			<label for="form-4-1">Pilih jika harus pesan lensa</label>
		</div>
	</div>
	<div class="col-md-1">Rp.</div>
	<div class="col-md-2" style="text-align: right;">
		<input type="text" name="harga_keterangan" style="text-align: right;" value="<?= isset($penjualan) ? $penjualan->harga_keterangan : '' ?>" id="harga_keterangan" class="form-control input-sm" value="0"><br>
	</div>
	<div class="col-md-2">
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
		<!-- <label>Selesai Tgl</label> -->
	</div>
	<div class="col-md-3">
		<!-- <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control input-sm" value="<?= isset($penjualan) ? $penjualan->tgl_selesai : '' ?>" required="required"> -->
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
		<button <?= isset($penjualan) ? $penjualan->id_toko != $this->session->userdata('id_toko') ? 'disabled' : '' : '' ?> class="btn btn-sm btn-success pull-right" type="submit"><?= isset($penjualan) ? 'Update' : 'Buat' ?> Nota</button>
	</div>
</div>
</form>
<script>
	$(".select2option").select2();
	$("#isBPJS").hide();
	$("#add_penjualan").hide();
	$("#add_jual_cairan").hide();
	$("#nama_lensa_").hide();
	$("#ifOrderLensa").hide();

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
		var harga_lensa2 = isNaN(harga_lensa) ? 0 : harga_lensa;
		var harga_frame2 = isNaN(harga_frame) ? 0 : harga_frame;
		var total = harga_frame2+harga_lensa2;
		format_angkat("total", total);
	})

	function format_angkat(target, harga) 
	{
		var harga_frame = isNaN(parseInt($("#frame option:selected").attr("harga"))) ? 0 : parseInt($("#frame option:selected").attr("harga"));
		var harga_lensa = isNaN(parseInt($("#lensa option:selected").attr("harga"))) ? 0 : parseInt($("#lensa option:selected").attr("harga"));
		var harga_keterangan = isNaN(parseInt($("#harga_keterangan").val())) ? 0 : parseInt($("#harga_keterangan").val());
		
		if(target == 'total_asli' && harga_lensa > 0 && harga_frame > 0 ) {
			harga = harga_frame+harga_lensa;
		} else if(target == 'total_asli' && harga_frame > 0 && harga_lensa <= 0) {
			harga = harga_frame;
		} else if(target == 'total_asli' && harga_frame <= 0 && harga_lensa > 0) {
			harga = harga_lensa;
		} else if(target == 'sisa') {
			var potongan_lensa = isNaN(parseInt($("#harga_lensa").val())) ? 0 : parseInt($("#harga_lensa").val());
			var potongan_frame = isNaN(parseInt($("#harga_frame").val())) ? 0 : parseInt($("#harga_frame").val());
			var harga_keterangan = isNaN(parseInt($("#harga_keterangan").val())) ? 0 : parseInt($("#harga_keterangan").val());
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



	$("#input_penjualan").on('submit', (function(e) {
		e.preventDefault(e);
		var id = "<?= isset($penjualan) ? md5($penjualan->id) : ''; ?>";
		$("#modal_loader").show();
		var fd = new FormData(this);
		fd.append('nama_lensa', $("#lensa option:selected").html());
		fd.append('nama_frame', $("#frame option:selected").html());

		$.ajax({
			url: "<?= site_url() ?>Penjualan/simpan_data/"+id,
			type: "POST",
			data: fd,
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