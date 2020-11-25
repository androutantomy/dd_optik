<div class="page-title text-right">
	<h4>Master Data <i class="ti-angle-right"></i> Master Frame</h4>
</div>
<div class="container">
	<div class="card">
		<div class="card-block text-dark">
			<h4 class="card-title">Master Frame</h4>
			<div class="card-body">
				<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal_tambah" >Tambah Barang</button>
				<table class="table-overflow table table-striped">
					<thead>
						<th width="5%">No</th>
						<th width="40%">Merk Frame</th>
						<th width="10%">Aksi</th>
					</thead>
					<tbody>
						<?php $no=0; foreach($barang as $val) { ?>
							<tr>
								<td><?= $no+=1; ?></td>
								<td><?= $val->nama ?></td>
								<td>
									<button class="btn btn-sm btn-info edit" id="<?= md5($val->id) ?>" data-toggle="modal" data-target="#modal_edit" id="">Edit</button>
									<button class="btn btn-sm btn-danger hapus" id="<?= md5($val->id) ?>">Hapus</button>
								</td>
							</tr>
						<?php } ?>
					</tbody> 
				</table>
			</div>
		</div>
	</div>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Master Frame</h5>
				<button type="button" class="close keluar_" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form id="xyz">
				<div class="modal-body">
					<div class="form-group row">
						<label for="form-1-1" class="col-md-2 control-label">Nama Barang</label>
						<div class="col-md-10">
							<input type="text" id="nama" class="form-control form-control-sm" maxlength="25" name="nama" placeholder="Isikan nama barang">
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger btn-sm keluar_">BATAL</button>
					<button type="submit" name="submit" class="btn btn-success btn-sm">SIMPAN</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL UPDATE-->
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Update Master Frame</h5>
				<button type="button" class="close keluar_" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form id="xyy">
				<div class="modal-body">
					<div class="form-group row">
						<label for="form-1-1" class="col-md-2 control-label">Nama Barang</label>
						<div class="col-md-10">
							<input type="hidden" name="id" id="id_edit">
							<input type="text" id="nama_edit" class="form-control form-control-sm" maxlength="25" name="nama_edit" placeholder="Isikan nama barang">
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger btn-sm keluar_">BATAL</button>
					<button type="submit" name="submit" class="btn btn-success btn-sm">SIMPAN</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(".keluar_").on('click', function() {
		$("#modal_edit").modal('hide');
		$("#modal_tambah").modal('hide');
	});

	$(document).on('click', '.hapus', function() {
		var id = $(this).attr("id");
		var conf = confirm("Apakah anda yakin");

		if(conf == true) {
			$.post("<?= site_url('master/master_data/hapus_jenis_barang/frame/') ?>"+id, '', function(d) {
				if(d.s == 'sukses') {
					alert(d.m);
					location.reload();
				} else {
					alert(d.m);
				}
			}, "json");
		}
	});

	$(document).on('click', '.edit', function() {
		var id  = $(this).attr('id');

		$.post("<?= site_url('master/master_data/get_data_jenis/frame/') ?>"+id, '', function(d) {
			if(d.s == 'sukses') {
				$("#nama_edit").val(d.nama)
				$("#id_edit").val(d.id)
			}
		}, 'json');
	});

	$('#xyy').on('submit', function(e) {
		e.preventDefault();

		$.ajax({
			url: "<?= site_url('master/master_data/update_jenis_barang/frame') ?>",
			type: "POST",
			data:  $("#xyy").serialize(),
			cache: false,
			dataType: 'json',
			processData:false,
			success: function(respon){
				if(respon.s == 'sukses') {
					alert(respon.m);
					location.reload();
				} else {
					alert(respon.m);
				}
			},
			error: function(){        
				alert('Upss, Terjadi Kesalahan, Silahkan coba kembali');
			}
		});
	});	

	$('#xyz').on('submit', function(e) {
		e.preventDefault();

		$.ajax({
			url: "<?= site_url('master/master_data/simpan_jenis_barang/frame') ?>",
			type: "POST",
			data:  $("#xyz").serialize(),
			cache: false,
			dataType: 'json',
			processData:false,
			success: function(respon){
				if(respon.s == 'sukses') {
					alert(respon.m);
					location.reload();
				} else {
					alert(respon.m);
				}
			},
			error: function(){        
				alert('Upss, Terjadi Kesalahan, Silahkan coba kembali');
			}
		});
	});	
</script>