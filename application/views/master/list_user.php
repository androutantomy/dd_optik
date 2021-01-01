<div class="page-title text-right">
	<h4>SI-POS OPTIK DD <i class="ti-angle-right"></i> User </h4>
</div>
<div class="container">
    <div class="card">
        <div class="card-block text-dark">
            <h4 class="card-title">Data User</h4>
            <div class="card-body">
                <button data-toggle="modal" data-target="#modal_tambah" class="btn btn-sm btn-success">TAMBAH USER BARU</button>

                <div class="table-overflow">
                    <table class="table-overflow table table-striped">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="30%">Nama Lengkap</th>
                                <th width="10%">username</th>
                                <th width="13%">level</th>
                                <th width="15%">toko</th>
                                <th>Foto Profil</th>
                                <th width="15">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($user as $row) { ?>
                                <tr>
                                  <td><?= $no+=1; ?></td>
                                  <td><?=$row->nama_lengkap ?></td>
                                  <td><?=$row->username ?></td>
                                  <td><?=$row->nama_level ?></td>
                                  <td><?=$row->nama_toko ?></td>
                                  <td><img src="<?= $row->logo ?>" width="30"></td>
                                  <td><button id="<?= md5($row->id) ?>" data-toggle="modal" data-target="#modal_edit" class="btn btn-sm btn-info edit">Edit</button><td>
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
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="xyz">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="form-1-1" class="col-md-2 control-label">Nama Lengkap</label>
                            <div class="col-md-10">
                                <input type="text" id="nama"  class="form-control" required="required" name="nama_lengkap" placeholder="masukkan nama lengkap">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="form-1-1" class="col-md-2 control-label">username</label>
                            <div class="col-md-10">
                                <input type="text" id="username"  required="required" class="form-control"name="username" placeholder="masukkan username">
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <label for="form-1-1" class="col-md-2 control-label">Level User</label>
                            <div class="col-md-10">
                                <input type="text" id="id_level" class="form-control" maxlength="25" name="id_level" placeholder="level user">
                            </div>
                        </div> -->
                        <div class="form-group row">
                        <label for="form-1-1" class="col-md-2 control-label">Level User</label>
                        <div class="col-md-10">
                            <select class="form-control" name="id_level" id="id_level">
                                <option value="">Pilih Level User</option>
                                <?php foreach($level as $val) { ?>
                                <option value="<?= $val->id ?>"><?= $val->nama_level ?></option>
                                <?php } ?>
                            </select>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <label for="form-1-1" class="col-md-2 control-label">Toko</label>
                            <div class="col-md-10">
                                <input type="text" id="id_toko" class="form-control" maxlength="25" name="id_toko" placeholder="telp">
                            </div>
                        </div> -->
                        <div class="form-group row">
                        <label for="form-1-1" class="col-md-2 control-label">Pilih Toko</label>
                        <div class="col-md-10">
                            <select class="form-control" name="id_toko" id="id_toko">
                                <option value="">Pilih Toko</option>
                                <?php foreach($toko as $val) { ?>
                                <option value="<?= $val->id ?>"><?= $val->nama_toko ?></option>
                                <?php } ?>
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="form-1-1" class="col-md-2 control-label">password</label>
                            <div class="col-md-10">
                                <input type="password" id="password" class="form-control" required="required" maxlength="25" name="password" placeholder="isikan password baru">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="form-1-1" class="col-md-2 control-label">Foto Profil</label>
                            <div class="col-md-10">
                                <input type="file" id="logo" required="required" class="form-control" name="logo">
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
                        <button type="submit" name="submit" class="btn btn-success">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MENU TAMBAH -->
    <!-- MENU edit -->
    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="xxx" class="form-horizontal mrg-top-40 pdd-right-30">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="form-1-1" class="col-md-2 control-label">Nama Lengkap</label>
                            <div class="col-md-10">
                                <input type="hidden" name="id_edit" id="id_edit" value="">
                                <input type="text" id="nama_lengkap_edit"  class="form-control" required="required" name="nama_lengkap_edit" placeholder="masukkan nama lengkap">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="form-1-1" class="col-md-2 control-label">username</label>
                            <div class="col-md-10">
                                <input type="text" id="username_edit"  required="required" class="form-control"name="username_edit" placeholder="masukkan username">
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <label for="form-1-1" class="col-md-2 control-label">Level User</label>
                            <div class="col-md-10">
                                <input type="text" id="id_level" class="form-control" maxlength="25" name="id_level" placeholder="level user">
                            </div>
                        </div> -->
                        <div class="form-group row">
                        <label for="form-1-1" class="col-md-2 control-label">Level User</label>
                        <div class="col-md-10">
                            <select class="form-control" name="id_level_edit" id="id_level_edit">
                                <option value="">Pilih Level User</option>
                                <?php foreach($level as $val) { ?>
                                <option value="<?= $val->id ?>"><?= $val->nama_level ?></option>
                                <?php } ?>
                            </select>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <label for="form-1-1" class="col-md-2 control-label">Toko</label>
                            <div class="col-md-10">
                                <input type="text" id="id_toko" class="form-control" maxlength="25" name="id_toko" placeholder="telp">
                            </div>
                        </div> -->
                        <div class="form-group row">
                        <label for="form-1-1" class="col-md-2 control-label">Pilih Toko</label>
                        <div class="col-md-10">
                            <select class="form-control" name="id_toko_edit" id="id_toko_edit">
                                <option value="">Pilih Toko</option>
                                <?php foreach($toko as $val) { ?>
                                <option value="<?= $val->id ?>"><?= $val->nama_toko ?></option>
                                <?php } ?>
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="form-1-1" class="col-md-2 control-label">password</label>
                            <div class="col-md-10">
                                <input type="password" id="password_edt" required="required" class="form-control" maxlength="25" name="password_edit" placeholder="isikan password baru/lama anda">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="form-1-1" class="col-md-2 control-label">Foto Profil</label>
                            <div class="col-md-10">
                                <input type="file" id="logo_edit" class="form-control" name="logo_edit">
                            </div>

                        </div>
                        <div id="letak_gambar"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
                        <button type="submit" name="submit" class="btn btn-success">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MENU edit -->
    <script>
        $(".keluar_").on('click', function() {
            $("#modal_edit").modal('hide');
            $("#modal_tambah").modal('hide');
        });

        $("#xyz").on('submit', (function(e) {
            e.preventDefault(e);
            $("#modal_loader").show();

            $.ajax({
                url: "<?= site_url() ?>User/Master_user/add",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                dataType: 'json',
                processData: false,
                success: function(respon) {
                    if (respon.s == 'sukses') {
                       alert(respon.m);
                       location.reload();
                    } else {
                        alert(respon.m);
                    }
                },
                error: function() {
                    alert('Upps, terjadi masalah, refresh halaman dan coba kembali ');
                }
            });
        }));

        $(".hapus").on("click", function() {
            var id = $(this).attr("id");
            var conf = confirm("Apakah anda yakin ?");

            if(conf == true) {
                $.post("<?= site_url('User/Master_user/hapus_user/') ?>"+id, '', function(d) {
                    if(d.s == 'sukses') {
                        alert(d.m);
                        location.reload();
                    } else {
                        alert(d.m);
                    }
                }, "json");
            }
        });

        $("#xxx").on('submit', (function(e) {
            e.preventDefault(e);
            $("#modal_loader").show();

            $.ajax({
                url: "<?= site_url() ?>User/Master_user/edit",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                dataType: 'json',
                processData: false,
                success: function(respon) {
                    if (respon.s == 'sukses') {
                       alert(respon.m);
                       location.reload();
                    } else {
                        alert(respon.m);
                    }
                },
                error: function() {
                    alert('Upps, terjadi masalah, refresh halaman dan coba kembali ');
                }
            });
        }));

        $(document).on('click', '.edit', function() {
            var id  = $(this).attr('id');

            $.post("<?= site_url('User/Master_user/get_data_user/') ?>"+id, '', function(d) {
                if(d.s == 'sukses') {
                    $.each(d.m, function(key, val) {
                        if(key == 'id') {
                            $("#id_edit").val(val);
                        } else if(key == 'nama_lengkap') {
                            $("#nama_lengkap_edit").val(val);
                        } else if(key == 'username') {
                            $("#username_edit").val(val);
                        } else if(key == 'id_level') {
                            $("#id_level_edit").val(val);
                        } else if(key == 'id_toko') {
                            $("#id_toko_edit").val(val);
                        } else if(key == 'password') {
                            $("#password_edit").val(val);  
                        } else if(key == 'logo') {
                            var appen = "<img src='"+val+"' width='150'>";
                            $("#letak_gambar").html(appen);
                        }
                    });
                }
            }, 'json');
        });
    </script>










