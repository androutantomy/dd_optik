<div class="card border-info text-dark">
    <div class="card-heading bg-info border bottom">
        <h4 class="card-title">Form Edit Level User</h4>
    </div>
    <div class="card-block">
        <div class="card-block">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto">
                    <?php
                    echo form_open('Level_user/edit');
                    echo form_hidden('id',$edit['id']);
                    ?>
                    <form role="form" id="form-validation" novalidate="novalidate">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Level <small class="text-normal">*Minimum 20 characters</small></label>
                                    <input type="text" value="<?php echo $edit['nama_level'] ?>" id="nama" onkeyup="checkLetter()"  class="form-control" maxlength="20" name="nama_level" placeholder="nama level" required="" minlength="8" aria-required="true">
                                </div>
                            </div>
                        <button type="submit" name="submit" class="btn btn-success btn-rounded swal-success">UPDATE</button>
                        <?php echo anchor('Level_user', 'KEMBALI', array('class' =>"btn btn-danger btn-rounded")) ?>
                    </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> <script type="text/javascript">
            function hanyaAngka(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
            }
            function hanyaAngka(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
            }

            function checkLetter()
            {
                var validasiHuruf = /^[a-zA-Z ]+$/;
                var namaKota = document.getElementById("nama");
                if (namaKota.value.match(validasiHuruf)) {
                } else {
                    swal("WAJIB HURUF", "TIDAK BISA DIMASUKAN ANGKA", "warning");
                }
            }
        </script>
