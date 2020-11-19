<?php
if ($this->session->flashdata('message')) {
    echo "<div class='alert alert-success'>";
    echo $this->session->flashdata('message');
    echo "</div>";
} elseif ($this->session->flashdata('pesan')){
    echo "<div class='alert alert-danger'>";
    echo $this->session->flashdata('pesan');
    echo "</div>";
}
?>
<div class="page-title text-right">
	<h4>USER<i class="ti-angle-right"></i> Master User Level </h4>
</div>
<div class="container">
<div class="card">
    <div class="card-block text-dark">
            <h4 class="card-title">Data Role User</h4>
            <div class="card-body">
            <button data-toggle="modal" data-target="#modal-tambah" class="btn btn-sm btn-success">TAMBAH ROLE USER</button>
            <div class="table-overflow">
                <table class="table">
                    <thead>
                            <th width="5%">NO</th>
                            <th width="70%">NAMA ROLE USER</th>
                            <th width="10">AKSI</th>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($level_user as $row) {?>
                        <tr>
                          <td><?= $no+=1;?> </td>
                          <td><?= $row->nama_level?></td>
                          <td>
								<button class="btn btn-sm btn-info edit" id="<?= md5($row->id) ?>" data-toggle="modal" data-target="#modal_edit" id="">Edit</button>
                                <button class="btn btn-sm btn-danger hapus" id="<?= md5($row->id) ?>">Hapus</button>
                          </td>
                          <!-- <td>" . anchor('Level_user/edit/' . $row->id, 'Edit', array('class' => 'btn btn-info')) . "</td>
                          <td>" . anchor('Level_user/Hapus/' . $row->id, '<i class="btn btn-danger swal-function">Hapus</i>') . "</td> -->
                         </tr>
                      <?php  }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- MENU UPDATE -->
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Level User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mrg-top-40 pdd-right-30">
                    <div class="form-group row">
                        <label for="form-1-1" class="col-md-2 control-label">Nama Level User</label>
                        <div class="col-md-10">
                            <small class="text-normal">*Maximal 25 characters</small>
                            <input type="text" id="nama" onkeyup="checkLetter()" class="form-control" maxlength="25" name="nama_level" placeholder="nama_level">
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
                <button type="submit" name="submit" onclick="tambah()" class="btn btn-primary">SIMPAN</button>
            </div>
        </div>
        </form>
</div>
</div>
        <!-- END MENU UPDATE -->
<!-- MENU TAMBAH -->
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Level User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mrg-top-40 pdd-right-30">
                    <div class="form-group row">
                        <label for="form-1-1" class="col-md-2 control-label">Nama Level User</label>
                        <div class="col-md-10">
                            <small class="text-normal">*Maximal 25 characters</small>
                            <input type="text" id="nama" onkeyup="checkLetter()" class="form-control" maxlength="25" name="nama_level" placeholder="nama_level">
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
                <button type="submit" name="submit" onclick="tambah()" class="btn btn-success">SIMPAN</button>
            </div>
        </div>
        </form>
</div>
</div>
        <!-- END MENU TAMBAH -->
        
        <script>
        $(".keluar_").on('click', function() {
		$("#modal_edit").modal('hide');
		$("#modal_tambah").modal('hide');
	});

    $(document).on('click', '.hapus', function() {
		var id = $(this).attr("id");
		var conf = confirm("Apakah anda yakin");

		if(conf == true) {
			$.post("<?= site_url('master/master_level/hapus_jenis_level/jenis_level') ?>"+id, '', function(d) {
				if(d.s == 'sukses') {
					alert(d.m);
					location.reload();
				} else {
					alert(d.m);
				}
			}, "json");
		}
	});
        </script>










