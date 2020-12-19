<div class="page-title text-right">
	<h4>Pembelian <i class="ti-angle-right"></i> Pembelian</h4>
</div>
<div class="container">
	<div class="card">
		<div class="card-block text-dark">
			<h4 class="card-title">Transaksi Pembelian</h4>
			<div class="card-body">
				<button class="btn btn-sm btn-success" id="add_pembelian">Transaksi Pembelian</button>

				<div id="transaksi_pembelian">
					<table id="list_pembelian" class="table-overflow table table-striped table-overflow">
						<thead>
							<th></th>
							<th>Nama Distributor</th>
							<th>Tanggal Transaksi</th>
							<th>Aksi</tg>
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
	$("#add_pembelian").on('click', function() {
		$("#transaksi_pembelian").load("<?= site_url('pembelian/add') ?>");
		$(this).hide();
	});

	$(document).on('click', '.nota, .nota_produksi', function() {
		var id = $(this).attr('id');
		var type = $(this).attr('type');

		if(type == 'nota') {
			location.href = ("<?= site_url('pembelian/nota/') ?>"+id);
		} else {
			location.href = ("<?= site_url('pembeliannota_produksi/') ?>"+id);
		}
	});

	$(document).on('click', '.pelunasan', function() {
		var id = $(this).attr('id');

		$("#transaksi_pembelian").load("<?= site_url('pembelian/add/') ?>"+id);
		$(this).hide();
	});


	$(document).ready(function() {
		table = $('#list_pembelian').DataTable({
			"processing": true, 
			"serverSide": true, 
			"order": [], 

			"ajax": {

				"url": "<?= site_url('pembelian/list_data') ?>",
				"type": "POST"
			},

			"columnDefs": [{
				"targets": [0], 
				"orderable": false, 
			}, ],
		});
	});
</script>