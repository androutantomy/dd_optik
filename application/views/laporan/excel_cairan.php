<?php 

/*$nama = "Laporan Penjualan Cairan.xls";
@header("Cache-Control: ");
@header("Pragma: ");
@header("Content-type: application/msexcel");
@header("Content-Disposition: attachment; filename=\"$nama\"");*/
?>

<table width="100%">
	<tr>
		<td><center>List Penjualan Cairan</center></td>
	</tr>
</table>

<table width="100%">
	<thead>
		<th></th>
		<th>Toko</th>
		<th>Pelanggan</th>
		<th>Barang</th>
		<th>Tanggal Beli</th>
		<th>Total Harga</th>
	</thead>
	<tbody>
		<?php $no=0; foreach($listnya as $val) { ?>
			<tr>
				<td><?= $no+=1; ?></td>
				<td><?= $this->convertion->nama_toko($val->id_toko) ?></td>
				<td><?= $val->nama ?></td>
				<td><?= $val->nama_barang ?></td>
				<td><?= $val->tgl_transaksi ?></td>
				<td><?= "Rp. ".number_format($val->nominal); ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>