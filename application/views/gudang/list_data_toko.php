
<ul class="nav nav-tabs">
	<?php $no = 0; foreach($toko as $val) { ?>
		<li class=""><a data-toggle="tab" id="<?= md5($val->id) ?>" href="#toko_<?= $val->id ?>"><?= $val->nama_toko; ?></a></li>
	<?php $no++; } ?>
</ul>
<div class="tab-content">
	<?php $no = 0; foreach($toko as $val) { ?>
		<div id="toko_<?= $val->id ?>" class="tab-pane fade in ">
			<h3>Data Barang <?= $val->nama_toko?></h3>
			<div id="data_<?= md5($val->id) ?>"></div>
			<ul class="nav nav-tabs">
				<li><a data-toggle="tab" class="btn_data_toko" id="<?= md5($val->id) ?>" type="frame" href="#home_<?= md5($val->id) ?>">Frame</a></li>
				<li><a data-toggle="tab" href="#menu1_<?= md5($val->id) ?>" id="<?= md5($val->id) ?>" type="lensa" class="btn_data_toko" id="btn_lensa_<?= md5($val->id) ?>">Lensa</a></li>
				<li><a data-toggle="tab" href="#menu2_<?= md5($val->id) ?>" id="<?= md5($val->id) ?>" type="cairan" class="btn_data_toko" id="btn_cairan_<?= md5($val->id) ?>">Cairan</a></li>
			</ul>

			<div class="tab-content">
				<div id="home_<?= md5($val->id) ?>" class="tab-pane fade in">
					<h3>DATA FRAME</h3>
					<div id="data_frame_<?= md5($val->id) ?>"></div>
				</div>
				<div id="menu1_<?= md5($val->id) ?>" class="tab-pane fade">
					<h3>DATA LENSA</h3>
					<div id="data_lensa_<?= md5($val->id) ?>"></div>
				</div>
				<div id="menu2_<?= md5($val->id) ?>" class="tab-pane fade">
					<h3>DATA CAIRAN</h3>
					<div id="data_cairan_<?= md5($val->id) ?>"></div>
				</div>
			</div>
		</div>
	<?php $no++; } ?>
</div>