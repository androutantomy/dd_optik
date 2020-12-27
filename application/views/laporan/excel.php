<?php 

$nama = "Laporan Penjualan.xls";
@header("Cache-Control: ");
@header("Pragma: ");
@header("Content-type: application/msexcel");
@header("Content-Disposition: attachment; filename=\"$nama\"");
?>

<table width="100%">
	<tr>
		<td><center>List Penjualan Kacamata</center></td>
	</tr>
</table>

<table width="100%">
	<thead>
		<th></th>
		<th>Toko</th>
		<th>Pelanggan</th>
		<th>Frame</th>
		<th>Lensa</th>
		<th>Tanggal Beli</th>
		<th>Total Harga</th>
	</thead>
	<tbody>
		<?php $no=0; foreach($listnya as $val) { ?>
			<tr>
				<td><?= $no+=1; ?></td>
				<td><?= $this->convertion->nama_toko($val->id_toko) ?></td>
				<td><?= $val->nama ?></td>
				<td><?= $val->nama_frame ?></td>
				<td><?= $val->nama_lensa ?></td>
				<td><?= $val->tanggal_nota ?></td>
				<td><?= "Rp. ".number_format($val->harga_keterangan+$val->harga_frame+$val->harga_lensa); ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>