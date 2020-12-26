<script>
	window.onload(window.print());
</script>
<style>
	
	/*@page
	{
		size:13cm 10cm; 
		font-size: 4px;
		padding: 0px;
	}*/
</style>
<table width="50%" style="margin-left:auto; margin-right:auto; border-collapse: collapse;" style="font-size:4px;">
	<tr>
		<td valign="bottom" align='right' width='40%'><img src="<?= $data_toko != "" ? $data_toko->logo != "" ? $data_toko->nama_toko : base_url()."uploads/logo/_173431.png" : base_url()."uploads/logo/_173431.png" ?>" width="60px"></td>
		<td valign="top" align='right' width='60%' style="padding:0px 0px 0px 0px; line-height:5px">
			<table border="0">
				<h5><center><?= $data_toko != "" ? $data_toko->nama_toko : "Ruko Kalinangka"; ?><br><br><br><br><br> <?= $data_toko != "" ? $data_toko->alamat : "Jl. Osamaliki 43 E salatiga"; ?> <br><br><br><br><br><?= $data_toko != "" ? "Telp. ".$data_toko->telp : "Telp. 0823 2493 6595"; ?></center></h5>
			</table>
		</td>
	</tr>
</table>
<br>
<table border="0" width="100%">
	<tr>
		<td colspan="3"  style="text-align: right;">
			<u>Tgl. <?= date('d-m-Y', strtotime($pembelian->tanggal_nota)) ?></u>
		</td>
	</tr>
	<tr>
		<td width="20%">Nama</td>
		<td width="2%"> : </td>
		<td><?= $pembelian->nama == "" ? "-" : $pembelian->nama; ?></td>
	</tr>
	<tr>
		<td width="20%">Alamat</td>
		<td width="2%"> : </td>
		<td><?= $pembelian->alamat == "" ? "-" : $pembelian->alamat; ?></td>
	</tr>
	<tr>
		<td width="20%">Telp</td>
		<td width="2%"> : </td>
		<td><?= $pembelian->telp == "" ? "-" : $pembelian->telp; ?></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>
			<?= $pembelian->tipe_pembelian == 2 ? "<u>Peserta BPJS</u>" : ""; ?>
		</td>
	</tr>
</table>
<br>
<table width="100%" style="border-collapse: collapse;">
	<tr>
		<th width="5%" style="text-align: center; border: 1px solid black;"></th>
		<th width="15%" style="text-align: center; border: 1px solid black;">SPH</th>
		<th width="15%" style="text-align: center; border: 1px solid black;">CYL</th>
		<th width="15%" style="text-align: center; border: 1px solid black;">AXIS</th>
		<th width="15%" style="text-align: center; border: 1px solid black;">ADD</th>
		<th style="text-align: center; border: 1px solid black;" rowspan="3">
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
					<td>Dekat <?= $pembelian->pd_dekat; ?></td>
					<td>m/m</td>
				</tr>
			</table>
		</th>
	</tr>
	<tr>
		<td style="border: 1px solid black;"><center>R</center></td>
		<td style="text-align: center;border: 1px solid black;"><?= $pembelian->rsph; ?></td>
		<td style="text-align: center;border: 1px solid black;"><?= $pembelian->rcyl; ?></td>
		<td style="text-align: center;border: 1px solid black;"><?= $pembelian->raxis; ?></td>
		<td style="text-align: center;border: 1px solid black;"><?= $pembelian->radd; ?></td>
	</tr>
	<tr>
		<td style="border: 1px solid black;"><center>L</center></td>
		<td style="text-align: center;border: 1px solid black;"><?= $pembelian->lsph; ?></td>
		<td style="text-align: center;border: 1px solid black;"><?= $pembelian->lcyl; ?></td>
		<td style="text-align: center;border: 1px solid black;"><?= $pembelian->laxis; ?></td>
		<td style="text-align: center;border: 1px solid black;"><?= $pembelian->ladd; ?></td>
	</tr>
</table><br>
<table border="0" width="100%">
	<tr>
		<td width="20%">Frame</td>
		<td width="2%"> : </td>
		<td width="50%"><?= $this->convertion->nama_barang("frame", $pembelian->id_frame); ?></td>
		<td width="5%"> Rp. </td>
		<td style="text-align: right;"><?= number_format($pembelian->harga_frame); ?></td>
	</tr>
	<tr>
		<td width="20%">Lensa</td>
		<td width="2%"> : </td>
		<td width="50%"><?= $this->convertion->nama_barang("lensa", $pembelian->id_lensa); ?></td>
		<td width="5%"> Rp. </td>
		<td style="text-align: right;"><?= number_format($pembelian->harga_lensa); ?></td>
	</tr>
	<tr>
		<td width="20%">Keterangan</td>
		<td width="2%"> : </td>
		<td width="50%"><?= $pembelian->keterangan; ?></td>
		<td width="5%"> Rp. </td>
		<td style="text-align: right;"><?= number_format($pembelian->harga_keterangan); ?><br><hr></td>
	</tr>
</table>
<br>
<table border="0" width="100%">
	<tr>
		<td width="50%">&nbsp;</td>
		<td width="2%">&nbsp;</td>
		<td width="20%">Jumlah</td>
		<td width="5%"> Rp. </td>
		<td style="text-align: right;"><?= number_format($pembelian->harga_frame + $pembelian->harga_lensa + $pembelian->harga_keterangan); ?></td>	
	</tr>
	<tr>
		<td width="50%">&nbsp;</td>
		<td width="2%">&nbsp;</td>
		<td width="20%">Uang Muka</td>
		<td width="5%"> Rp. </td>
		<td style="text-align: right;"><?= number_format($pembelian->uang_muka); ?></td>	
	</tr>
	<tr>
		<td width="50%">&nbsp;</td>
		<td width="2%">&nbsp;</td>
		<td width="20%">Sisa</td>
		<td width="5%"> Rp. </td>
		<td style="text-align: right;"><?= number_format($pembelian->sisa); ?></td>	
	</tr>
</table>
<table border="0" width="100%">
	<tr>
		<td style="padding-top: 20px; ">
			<center>Sales</center><br><br><br>
			<center>(...............................)</center>
		</td>
	</tr>
</table>