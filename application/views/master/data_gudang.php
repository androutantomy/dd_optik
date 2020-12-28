<div class="page-title text-right">
	<h4>Master Data <i class="ti-angle-right"></i> Master Data Gudang</h4>
</div>
<div class="container">
	<div class="card">
		<div class="card-block text-dark">
			<h4 class="card-title">Master Data Gudang</h4>
			<div class="card-body" id="data_gudang">
				<button class="btn btn-sm btn-success" id="tambah_data" type="">Tambah Barang</button>
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" id="btn_frame" href="#home">Frame</a></li>
					<li><a data-toggle="tab" href="#menu1" id="btn_lensa">Lensa</a></li>
					<li><a data-toggle="tab" href="#menu2" id="btn_cairan">Cairan</a></li>
					<li><a data-toggle="tab" href="#menu3" id="btn_softlense">Softlense</a></li>
				</ul>

				<div class="tab-content">
					<div id="home" class="tab-pane fade in active">
						<h3>DATA FRAME</h3>
						<div id="data_frame"></div>
					</div>
					<div id="menu1" class="tab-pane fade">
						<h3>DATA LENSA</h3>
						<div id="data_lensa"></div>
					</div>
					<div id="menu2" class="tab-pane fade">
						<h3>DATA CAIRAN</h3>
						<div id="data_cairan"></div>
					</div>
					<div id="menu3" class="tab-pane fade">
						<h3>DATA SOFTLENSE</h3>
						<div id="data_softlense"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$("#data_frame").load("<?= site_url('master/master_data/list_data_frame') ?>");
	});


    $(document).on("click", ".hapus", function() {
        var id = $(this).attr("id");
        var type = $(this).attr("type");
        var conf = confirm("Apakah anda yakin?");

        if(conf == true) {
            $.post("<?= site_url('master/master_data/hapus_list_data/') ?>"+type+'/'+id, '' , function(d) {
                if(d.s == "sukses") {
                    alert(d.m);
                    if(type == "frame") {
                    	$("#data_frame").load("<?= site_url('master/master_data/list_data_frame') ?>");
                    } else if(type == "lensa") {
                    	$("#data_lensa").load("<?= site_url('master/master_data/list_data_lensa') ?>");
                    } else if(type == 'cairan') {
                    	$("#data_cairan").load("<?= site_url('master/master_data/list_data_cairan') ?>");
                    } else {
                    	$("#data_softlense").load("<?= site_url('master/master_data/list_data_softlense') ?>");
                    }                    
                } else {
                	alert(d.m);
                }
            }, "json")
        }

    });


	$(document).on("click", "#tambah_data, .tambah_data", function() {
		var type = $(this).attr("type");
		var id = $(this).attr("id");

		$("#data_gudang").load("<?= site_url('master/master_data/input_gudang/') ?>"+type+'/'+id);
	});

	$("#btn_frame").on("click", function() {
		$("#data_frame").load("<?= site_url('master/master_data/list_data_frame') ?>");
	});

	$("#btn_lensa").on("click", function() {
		$("#data_lensa").load("<?= site_url('master/master_data/list_data_lensa') ?>");
	});

	$("#btn_cairan").on("click", function() {
		$("#data_cairan").load("<?= site_url('master/master_data/list_data_cairan') ?>");
	});

	$("#btn_softlense").on("click", function() {
		$("#data_softlense").load("<?= site_url('master/master_data/list_data_softlense') ?>");
	});

	$(document).on("click", "#kembali", function() {
		location.reload();
	});
</script>