<table id="table_<?= $type ?>_<?= $id != '' ? $id : ''; ?>" class="table-overflow table table-striped" width="100%">
	<thead>
		<th>No</th>
		<th>Nama</th>
		<th>Stok</th>
        <th>SPH</th>
        <th>CYL</th>
        <th>ADD</th>
        <?php if($this->session->userdata("id_level") == 3) { ?>
          <th>Harga Beli</th>
          <th>Harga Jual</th>
      <?php } ?>
      <th>Aksi</th>
  </thead>
  <tbody>

  </tbody>
</table>

<script>
	$(document).ready(function() {
        table = $('#table_<?= $type ?>_<?= $id != '' ? $id : ''; ?>').DataTable({
            "processing": true, 
            "serverSide": true, 
            "order": [], 

            "ajax": {

                "url": "<?= site_url('master/master_data/ajax_list_lensa/').$id ?>",
                "type": "POST"
            },

            "columnDefs": [{
                "targets": [0], 
                "orderable": false, 
            }, ],
        });

    });
</script>