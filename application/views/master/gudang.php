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
				<option value="1">Minus & Plus</option>
				<option value="2">Minus & Additional</option>
				<option value="3">Plus & Additional</option>
			</select>
		</div>
		<div class="col-md-2 maxMin">
			<input type="hidden" name="id_update" id="id_update">
			<input type="number" name="minus" class="form-control form-control-sm emptyy" id="minus" placeholder="Isikan nilai minus" >
		</div>
		<div class="col-md-2 maxMin">
			<input type="number" name="plus" class="form-control form-control-sm emptyy" id="plus" placeholder="Isikan nilai plus">
		</div>
	</div>
	<div id="message" style="color: green;"></div>
	<button class="btn btn-sm btn-success pull-right" value="<?= $type == 'tambah_data' ? 'simpan' : 'update' ?>"><?= $type == 'tambah_data' ? 'Simpan' : 'Update'; ?></button>
</form>

<script>
	$(document).ready(function() {
		$(".maxMin").hide();
		$("#message").html("");
		var type = "<?= $type ?>";
		var id  = "<?= $id ?>";

		if(type == "frame") {
			var idy = "<?= isset($data) && $type == 'frame' ?  $data->id : ''; ?>";
			var idx = "<?= isset($data) && $type == 'frame' ?  $data->id_frame : ''; ?>";
			setTimeout(function(){
				$("#selectJenis").val(1);
				$("#selectJenis").trigger("change");
			},500)

			setTimeout(function(){
				$("#frame").val(idx);;
			},800)

			var stok = "<?= isset($data) ?  $data->stok : ''; ?>";

			$("#id_update").val(idy);
			$("#stok").val(stok);
		} else if(type == "lensa") {
			var idy = "<?= isset($data) && $type == 'lensa' ?  $data->id : ''; ?>";
			var idx = "<?= isset($data) && $type == 'lensa' ?  $data->id_lensa : ''; ?>";
			var stok = "<?= isset($data) && $type == 'lensa' ?  $data->stok : ''; ?>";
			var max_min = "<?= isset($data) && $type == 'lensa' ?  $data->min_max : ''; ?>";
			var type = "<?= isset($data) && $type == 'lensa' ?  $data->type_lensa : ''; ?>";
			var split = max_min.split(",");

			setTimeout(function(){
				$("#selectJenis").val(2);
				$("#selectJenis").trigger("change");
			},500)

			setTimeout(function(){
				$("#type").val(type);
				$("#selectJenis").trigger("change");
			},700)	

			setTimeout(function(){
				$("#lensa").val(idx);
			},900)
		

			$("#id_update").val(idy);
			$("#minus").val(split[0]);
			$("#plus").val(split[1]);
			$("#stok").val(stok);
		} else if(type == "cairan") {
			var idy = "<?= isset($data) && $type == 'cairan' ?  $data->id : ''; ?>";
			var idx = "<?= isset($data) && $type == 'cairan' ?  $data->id_cairan : ''; ?>";			
			setTimeout(function(){
				$("#selectJenis").val(3);
				$("#selectJenis").trigger("change");
			},500)

			setTimeout(function(){
				$("#cairan").val(idx);
			},800)

			var stok = "<?= isset($data) ?  $data->stok : ''; ?>";

			$("#id_update").val(idy);
			$("#stok").val(stok);
		}

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
		var type = "<?= $type ?>";
		var url = "";
		type == "tambah_data" ? url = "<?= site_url('master/master_data/simpan_data_gudang') ?>" : url = "<?= site_url('master/master_data/update_data_gudang') ?>";

		$.ajax({
			url: url,
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