<button class="btn btn-sm btn-danger" id="kembali">Kembali</button><br>
<br><br>
<form id="xxy">
	<div class="form-group row">
		<div class="col-md-2">
			<label for="form-1-1" class="control-label">Jenis Barang</label>
		</div>
		<div class="col-md-5">
			<select class="form-control form-control-sm" name="jenis" id="selectJenis">
				<option value="">Pilih Jenis Barang</option>
				<option value="1">Frame</option>
				<option value="2">Lensa</option>
				<option value="3">Cairan</option>
			</select>
		</div>	
		<div class="col-md-5 row" id="dataOption">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-2">
			<label for="form-1-1" class="control-label">Jumlah Stok</label>
		</div>
		<div class="col-md-2">
			<input type="text" name="stok" class="form-control form-control-sm emptyy" id="stok" placeholder="Isikan jumlah stok">
		</div>
		<div class="col-md-4 maxMin">
			<select class="form-control emptyy" name="type" id="type">
				<option value="">Pilih Tipe Lensa</option>
				<option value="1">Minus & Additional</option>
				<option value="2">Minus & Plus</option>
			</select>
		</div>
		<div class="col-md-2 maxMin">
			<input type="number" name="minus" class="form-control form-control-sm emptyy" id="minus" placeholder="Isikan nilai minus" >
		</div>
		<div class="col-md-2 maxMin">
			<input type="number" name="plus" class="form-control form-control-sm emptyy" id="plus" placeholder="Isikan nilai plus">
		</div>
	</div>
	<div id="message" style="color: green;"></div>
	<button class="btn btn-sm btn-success pull-right">Simpan</button>
</form>

<script>
	$(document).ready(function() {
		$(".maxMin").hide();
		$("#message").html("");
	});

	$(document).on("change", "#selectJenis", function() {
		if($(this).val() == 1) {
			$.post("<?= site_url('master/master_data/option_frame/') ?>", '', function(d) {
				if(d.s == "sukses") {
					$("#dataOption").html(d.option);
					$(".maxMin").hide();
					$("#message").html("");
				}
			}, "json");
		} else if($(this).val() == 2) {
			$.post("<?= site_url('master/master_data/option_lensa/') ?>", '', function(d) {
				if(d.s == "sukses") {
					$("#dataOption").html(d.option);
					$(".maxMin").show();
					$("#message").html("");
				}
			}, "json");
		} else if($(this).val() == 3) {
			$.post("<?= site_url('master/master_data/option_cairan/') ?>", '', function(d) {
				if(d.s == "sukses") {
					$("#dataOption").html(d.option);
					$(".maxMin").hide();
					$("#message").html("");
				}
			}, "json");
		} else {

		}
	});

	$('#xxy').on('submit', function(e) {
		e.preventDefault();
		$("#message").html("");

		$.ajax({
			url: "<?= site_url('master/master_data/simpan_data_gudang') ?>",
			type: "POST",
			data:  $("#xxy").serialize(),
			cache: false,
			dataType: 'json',
			processData:false,
			success: function(respon){
				if(respon.s == 'sukses') {
					var msg = '<i class="fa fa-check-circle-o"></i> '+respon.m;
					$("#message").html(msg);
					$("#message").attr('style', 'color: green;');
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