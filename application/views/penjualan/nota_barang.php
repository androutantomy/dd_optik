<script>
	window.onload(window.print());
</script>
<style>
	.vl {
		border-right: 1px black;
		height: 30px;
	}

	@page
	{
		size:16.5cm 10.8cm; 
		font-size: 4px;
		padding: 0px;
	}
</style>
<table width="100%" border="0">
	<tr>
		<td width="30%" style=" text-align: center;">
			<img src="<?= $data_toko != "" ? $data_toko->logo != "" ? $data_toko->nama_toko : base_url()."uploads/logo/_173431.png" : base_url()."uploads/logo/_173431.png" ?>" width="60px">
		</td>
		<td width="40%" class="vl">
			<h4><?= $data_toko != "" ? $data_toko->nama_toko : "Ruko Kalinangka"; ?></h4>
			<h5><?= $data_toko != "" ? $data_toko->alamat : "Jl. Osamaliki 43 E salatiga"; ?> <br>
			<?= $data_toko != "" ? "Telp. ".$data_toko->telp : "Telp. 0823 2493 6595"; ?></h6>
		</td>
		<td width="30%">
			<h5><u>Tanggal. <?= date("d-m-Y", strtotime($pembelian[0]->tgl_transaksi)) ?></u></h5> <br>
			Kepada Tuan / Nyonya <br>
			<?= ucfirst($pembelian[0]->nama) ?> <br>
			di <br>
			<?= $pembelian[0]->alamat; ?>
			</h5>
		</td>
	</tr>
</table>
<hr>

<table width="100%" style="border-collapse: collapse;">
	<thead>
		<th style="border: 1px solid black;">No</th>
		<th style="border: 1px solid black;">Jenis Barang</th>
		<th style="border: 1px solid black;">Nama Barang</th>
		<th style="border: 1px solid black;">QTY</th>
		<th style="border: 1px solid black;">Jumlah</th>
	</thead>
	<tbody>
		<?php $no=0; foreach($pembelian as $val) { ?>
			<tr>
				<td style="border: 1px solid black;"><center><?= $no+=1; ?></center></td>
				<td style="border: 1px solid black;"><?= $val->id_jenis == 1 ? 'Cairan' : 'Softlense'; ?></td>
				<td style="border: 1px solid black;"><?= $val->nama_barang ?></td>
				<td style="border: 1px solid black;"><?= $val->qty; ?></td>
				<td style="border: 1px solid black; text-align: right;"><?= $val->nominal; ?></td>
			</tr>
		<?php } ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4" style="border: 1px solid black;"><center>Total</center></td>
			<th style="border: 1px solid black;"><?= $pembelian[0]->nominal; ?></th>
		</tr>
	</tfoot>
</table>
<table width="100%">
	<tr>
		<td width="70%">&nbsp;</td>
		<td width="30%">
			<center>
				Hormat Kami <br><br><br><br>
				(............................) 

			</center>

		</td>
	</tr>
</table>