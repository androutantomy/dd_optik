<script>
	window.onload(window.print());
</script>
<header>
	<table width="50%" style="margin-left:auto; margin-right:auto; border-collapse: collapse;" style="font-size:11px;">
		<tr>
			<th valign="bottom" align='right' width='40%'><img src="<?= $data_toko != "" ? $data_toko->logo != "" ? $data_toko->logo : base_url()."uploads/logo/_173431.png" : base_url()."uploads/logo/_173431.png" ?>" width="100px"></th>
			<th valign="top" align='right' width='60%' style="padding:0px 0px 0px 0px; line-height:5px">
				<table border="0">
					<h5><center><?= $data_toko != "" ? $data_toko->nama_toko : "Ruko Kalinangka"; ?><br><br><br><br><br> <?= $data_toko != "" ? $data_toko->alamat : "Jl. Osamaliki 43 E salatiga"; ?> <br><br><br><br><br><?= $data_toko != "" ? "Telp. ".$data_toko->telp : "Telp. 0823 2493 6595"; ?></center></h5>
				</table>
			</th>
		</tr>
	</table>
</header><br>
<table border="0" width="100%">
	<tr>
		<td colspan="3"  style="text-align: right;">
			<u>Tgl. <?= date('d-m-Y', strtotime($pembelian->tanggal_nota)) ?></u>
		</td>
	</tr>
	<tr>
		<td width="20%">Nama</td>
		<td width="2%"> : </td>
		<td><?= $pembelian->nama; ?></td>
	</tr>
	<tr>
		<td width="20%">Alamat</td>
		<td width="2%"> : </td>
		<td><?= $pembelian->alamat; ?></td>
	</tr>
	<tr>
		<td width="20%">Telp</td>
		<td width="2%"> : </td>
		<td><?= $pembelian->telp; ?></td>
	</tr>
</table>
<br>
<table border="1" width="100%">
	<tr>
		<th width="5%"></th>
		<th width="15%" style="text-align: center;">SPH</th>
		<th width="15%" style="text-align: center;">CYL</th>
		<th width="15%" style="text-align: center;">AXIS</th>
		<th width="15%" style="text-align: center;">ADD</th>
		<th  style="text-align: center;" rowspan="3">
			<table border="0" width="100%">
				<tr>
					<td rowspan="5"><span style="font-size: 25px;">PD</span></td>
				</tr>
				<tr>									
					<td>Jauh <?= $pembelian->pd_jauh; ?></td>
					<td>m/m</td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr>
					<td >Dekat <?= $pembelian->pd_dekat; ?></td>
					<td>m/m</td>
				</tr>
			</table>
		</th>
	</tr>
	<tr>
		<td><center>R</center></td>
		<td style="text-align: center;"><?= $pembelian->rsph; ?></td>
		<td style="text-align: center;"><?= $pembelian->rcyl; ?></td>
		<td style="text-align: center;"><?= $pembelian->raxis; ?></td>
		<td style="text-align: center;"><?= $pembelian->radd; ?></td>
	</tr>
	<tr>
		<td><center>L</center></td>
		<td style="text-align: center;"><?= $pembelian->lsph; ?></td>
		<td style="text-align: center;"><?= $pembelian->lcyl; ?></td>
		<td style="text-align: center;"><?= $pembelian->laxis; ?></td>
		<td style="text-align: center;"><?= $pembelian->ladd; ?></td>
	</tr>
</table><br>
<table border="0" width="100%">
	<tr>
		<td width="20%">Frame</td>
		<td width="2%"> : </td>
		<td width="50%"><?= $this->convertion->nama_barang("frame", $pembelian->id_frame); ?></td>
		<td width="5%"></td>
		<td rowspan="3">
			<center>Penerima</center><br><br><br>
			<center>(...............................)</center>
		</td>
	</tr>
	<tr>
		<td width="20%">Lensa</td>
		<td width="2%"> : </td>
		<td width="50%"><?= $this->convertion->nama_barang("lensa", $pembelian->id_lensa); ?></td>
		<td width="5%"></td>
		<td></td>
	</tr>
	<tr>
		<td width="20%">Keterangan</td>
		<td width="2%"> : </td>
		<td width="50%"><?= $pembelian->keterangan; ?></td>
		<td width="5%"></td>
		<td></td>
	</tr>
</table>