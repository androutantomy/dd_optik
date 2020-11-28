<div class="page-title text-right">
	<h4>Penjualan <i class="ti-angle-right"></i> Penjualan</h4>
</div>
<div class="container">
	<div class="card">
		<div class="card-block text-dark">
			<h4 class="card-title">Transaksi Penjualan</h4>
			<div class="card-body">
				<button class="btn btn-sm btn-success" id="add_penjualan">Transaksi Penjualan</button>

				<div id="transaksi_penjualan">
					<table id="list_penjualan" class="table-overflow table table-striped table-overflow">
						<thead>
							<th></th>
							<th>Nama Pelanggan</th>
							<th>Tanggal Transaksi</th>
							<th>Tanggal Selesai</th>
							<td></td>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$("#add_penjualan").on('click', function() {
		$("#transaksi_penjualan").load("<?= site_url('penjualan/add') ?>");
		$(this).hide();
	});

	$(document).on('click', '.nota, .nota_produksi', function() {
		var id = $(this).attr('id');
		var type = $(this).attr('type');

		if(type == 'nota') {
			location.href = ("<?= site_url('penjualan/nota/') ?>"+id);
		} else {
			location.href = ("<?= site_url('penjualan/nota_produksi/') ?>"+id);
		}
	});

	$(document).on('click', '.pelunasan', function() {
		var id = $(this).attr('id');

		$("#transaksi_penjualan").load("<?= site_url('penjualan/add/') ?>"+id);
		$(this).hide();
	});


	$(document).ready(function() {
		table = $('#list_penjualan').DataTable({
			"processing": true, 
			"serverSide": true, 
			"order": [], 

			"ajax": {

				"url": "<?= site_url('penjualan/list_data') ?>",
				"type": "POST"
			},

			"columnDefs": [{
				"targets": [0], 
				"orderable": false, 
			}, ],
		});
	});
</script>