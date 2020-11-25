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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Toko</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="xyz">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="form-1-1" class="col-md-2 control-label">Nama Toko</label>
                            <div class="col-md-10">
                                <input type="text" id="nama"  class="form-control" maxlength="25" name="nama_toko" placeholder="nama toko">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="form-1-1" class="col-md-2 control-label">Alamat Toko</label>
                            <div class="col-md-10">
                                <input type="text" id="alamat" onkeyup="checkLetter()" class="form-control"name="alamat" placeholder="alamat">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="form-1-1" class="col-md-2 control-label">No. Telp</label>
                            <div class="col-md-10">
                                <input type="text" id="telp" class="form-control" maxlength="25" name="telp" placeholder="telp">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="form-1-1" class="col-md-2 control-label">Logo</label>
                            <div class="col-md-10">
                                <input type="file" id="logo" class="form-control" name="logo">
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Toko</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="xxx" class="form-horizontal mrg-top-40 pdd-right-30">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="form-1-1" class="col-md-2 control-label">Nama Toko</label>
                            <div class="col-md-10">
                                <input type="hidden" name="id_edit" id="id_edit" value="">
                                <input type="text" id="nama_toko_edit" class="form-control" name="nama_toko_edit" placeholder="nama toko">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="form-1-1" class="col-md-2 control-label">Alamat Toko</label>
                            <div class="col-md-10">
                                <input type="text" id="alamat_edit" class="form-control"name="alamat_edit" placeholder="alamat">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="form-1-1" class="col-md-2 control-label">No. Telp</label>
                            <div class="col-md-10">
                                <input type="text" id="telp_edit" class="form-control" name="telp_edit" placeholder="telp">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="form-1-1" class="col-md-2 control-label">Logo</label>
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
                url: "<?= site_url() ?>/Toko/add",
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
                $.post("<?= site_url('toko/hapus_toko/') ?>"+id, '', function(d) {
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
                url: "<?= site_url() ?>/Toko/edit",
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

            $.post("<?= site_url('toko/get_data_toko/') ?>"+id, '', function(d) {
                if(d.s == 'sukses') {
                    $.each(d.m, function(key, val) {
                        if(key == 'id') {
                            $("#id_edit").val(val);
                        } else if(key == 'nama_toko') {
                            $("#nama_toko_edit").val(val);
                        } else if(key == 'alamat') {
                            $("#alamat_edit").val(val);
                        } else if(key == 'telp') {
                            $("#telp_edit").val(val);
                        } else if(key == 'logo') {
                            var appen = "<img src='"+val+"' width='150'>";
                            $("#letak_gambar").html(appen);
                        }
                    });
                }
            }, 'json');
        });
    </script>










