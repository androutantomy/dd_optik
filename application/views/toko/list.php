<?php
?>
<div class="page-title text-right">
	<h4>SI-POS OPTIK DD <i class="ti-angle-right"></i> Toko </h4>
</div>
<div class="container">
<div class="card">
    <div class="card-block text-dark">
            <h4 class="card-title">Data Toko</h4>
			<div class="card-body">
            <button data-toggle="modal" data-target="#modal_tambah" class="btn btn-sm btn-success">TAMBAH TOKO BARU</button>
            
            <div class="table-overflow">
                <table class="table-overflow table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama Toko</th>
                            <th width="25%">Alamat</th>
                            <th>No Telp</th>
                            <th>Logo</th>
                            <th width="15">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($toko as $row) { ?>
                            <tr>
                          <td><?= $no+=1; ?></td>
                          <td><?=$row->nama_toko ?></td>
                          <td><?=$row->alamat ?></td>
                          <td><?=$row->telp ?></td>
                          <td><?=$row->logo ?></td>
						  <td><button id="<?= $row->id ?>" data-toggle="modal" data-target="#modal_edit" class="btn btn-sm btn-info edit">Edit</button><td>
                          <button class="btn btn-sm btn-danger hapus" id="<?= md5($row->id) ?>">Hapus</button>
                          <!-- <td>" . anchor('Toko/edit/' . $row->id, 'Edit', array('class' => 'btn btn-info')) . "</td> -->
                          <!-- <td>" . anchor('Toko/Hapus/' . $row->id, '<i class="btn btn-danger swal-function">Hapus</i>') . "</td> -->
                         </tr>
                      <?php  } ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- MENU TAMBAH -->
<div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <?php
            echo form_open('Toko/add', 'id="form-validation" novalidate="novalidate"');
            ?>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Toko</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
	            <?php echo form_open_multipart('Toko/add');?>
                    <div class="form-group row">
                        <label for="form-1-1" class="col-md-2 control-label">Nama Toko</label>
                        <div class="col-md-10">
                            <small class="text-normal">*Maximal 25 characters</small>
                            <input type="text" id="nama"  class="form-control" maxlength="25" name="nama_toko" placeholder="nama toko">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="form-1-1" class="col-md-2 control-label">Alamat Toko</label>
                        <div class="col-md-10">
                            <input type="text" id="nama" onkeyup="checkLetter()" class="form-control"name="alamat" placeholder="alamat">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="form-1-1" class="col-md-2 control-label">No. Telp</label>
                        <div class="col-md-10">
                            <small class="text-normal">*Maximal 25 characters</small>
                            <input type="text" id="nama" class="form-control" maxlength="25" name="telp" placeholder="telp">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="form-1-1" class="col-md-2 control-label">Logo</label>
                        <div class="col-md-10">
                            <!-- <input type="text" id="nama" onkeyup="checkLetter()" class="form-control" name="logo" placeholder="logo"> -->
                           
                        <div class="file-field">
                            <input type="file" id="nama" class="form-control" name="logo" placeholder="logo">
                            </div>
                        </div>
                        
                        </div>
                    </div>
                    
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
                <button type="submit" name="submit" onclick="tambah()" class="btn btn-success">SIMPAN</button>
            </div>
            </div>
        </div>
        </form>
        </div>
        </div>
        <!-- END MENU TAMBAH -->
        <!-- MENU edit -->
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <?php
            echo form_open('Toko/edit', 'id="form-validation" novalidate="novalidate"');
            ?>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Toko</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mrg-top-40 pdd-right-30">
                    <div class="form-group row">
                        <label for="form-1-1" class="col-md-2 control-label">Nama Toko</label>
                        <div class="col-md-10">
                            <small class="text-normal">*Maximal 25 characters</small>
                            <input type="text" id="nama" onkeyup="checkLetter()" class="form-control" maxlength="25" name="nama_toko" placeholder="nama_toko">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="form-1-1" class="col-md-2 control-label">Alamat Toko</label>
                        <div class="col-md-10">
                            <input type="text" id="nama" onkeyup="checkLetter()" class="form-control"name="alamat" placeholder="alamat">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="form-1-1" class="col-md-2 control-label">No. Telp</label>
                        <div class="col-md-10">
                            <small class="text-normal">*Maximal 25 characters</small>
                            <input type="text" id="nama" onkeyup="checkLetter()" class="form-control" maxlength="25" name="telp" placeholder="telp">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="form-1-1" class="col-md-2 control-label">Logo</label>
                        <div class="col-md-10">
                            <input type="text" id="nama" onkeyup="checkLetter()" class="form-control" name="logo" placeholder="logo">
                            <!-- <form class="md-form">
                        <div class="file-field">
                            <input type="file" id="nama" onkeyup="checkLetter()" class="form-control" name="logo" placeholder="logo">
                            </div>
                        </div>
                        </form> -->
                        </div>
                    </div>
                    
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
                <button type="submit" name="submit" onclick="tambah()" class="btn btn-success">SIMPAN</button>
            </div>
            </div>
        </div>
        </form>
        <!-- END MENU edit -->
        <script>
            $(".keluar_").on('click', function() {
		$("#modal_edit").modal('hide');
		$("#modal_tambah").modal('hide');
	});
        </script>










