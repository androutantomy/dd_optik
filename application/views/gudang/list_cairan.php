<table id="table_<?= $type ?>_<?= $id != '' ? $id : ''; ?>" class="table-overflow table table-striped" width="100%">
	<thead>
		<th>No</th>
		<th>Nama</th>
		<th>Stok</th>
		<th>Harga Beli</th>
		<th>Harga Jual</th>
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

                "url": "<?= site_url('master/master_data/ajax_list_cairan/').$id ?>",
                "type": "POST"
            },

            "columnDefs": [{
                "targets": [0], 
                "orderable": false, 
            }, ],
        });

    });
</script>