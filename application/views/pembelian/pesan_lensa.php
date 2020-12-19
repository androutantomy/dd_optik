<div class="page-title text-right">
	<h4>Pesan Lensa <i class="ti-angle-right"></i> Pesan Lensa</h4>
</div>
<div class="container">
	<div class="card">
		<div class="card-block text-dark">
			<h4 class="card-title">Daftar Pesan Lensa</h4>
			<div class="card-body">
				<table id="list_pesan_lensa" class="table-overflow table table-striped table-overflow">
					<thead>
						<th>No</th>
						<th>Nama Pemesan</th>
						<th>Nama Lensa</th>
						<th>SPH</th>
						<th>CYL</th>
						<th>ADD</th>
						<th>Harga Beli</th>
						<th>Harga Jual</th>
						<th>Aksi</th>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {

		$(document).on("click", ".selesai", function() {
			var id = $(this).attr("id");
			var conf = confirm("Apakah anda yakin ?");

			if(conf == true) {
				$.post("<?= site_url('pesan_lensa/selesai/') ?>"+id, '', function(d) {
					if(d.s == 'sukses') {
						alert(d.m);
						location.reload();
					} else {
						alert(d.m);
					}
				}, 'json');
			}
		});

		table = $('#list_pesan_lensa').DataTable({
			"processing": true, 
			"serverSide": true, 
			"order": [], 

			"ajax": {

				"url": "<?= site_url('pesan_lensa/list_data') ?>",
				"type": "POST"
			},

			"columnDefs": [{
				"targets": [0], 
				"orderable": false, 
			}, ],
		});
	});
</script>