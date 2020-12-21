<header>
	<table width="50%" style="margin-left:auto; margin-right:auto; border-collapse: collapse;" style="font-size:11px;">
		<tr>
			<th valign="bottom" align='right' width='40%'><img src="./uploads/logo/_173431.png" width="100px"></th>
			<th valign="top" align='right' width='60%' style="padding:0px 0px 0px 0px; line-height:5px">
				<h5 style="margin: 10px;"><center>Ruko Kalinongko</center></h5><br>
				<h5 style="margin: 10px;"><center>Jl. Osamaliki 43 E Salatiga</center></h5><br>
				<h5 style="margin: 10px;"><center>Telp. 0823 2493 6595</center></h5><br>
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

<table border="0" width="100%">
	<tr>
		<td width="20%">Frame</td>
		<td width="2%"> : </td>
		<td width="50%"><?= $pembelian->nama_frame; ?></td>
		<td width="5%"> Rp. </td>
		<td style="text-align: right;"><?= $pembelian->harga_frame; ?></td>
	</tr>
	<tr>
		<td width="20%">Lensa</td>
		<td width="2%"> : </td>
		<td width="50%"><?= $pembelian->nama; ?></td>
		<td width="5%"> Rp. </td>
		<td style="text-align: right;"><?= $pembelian->harga_lensa; ?></td>
	</tr>
</table>
<br>
<table border="0" width="100%">
	<tr>
		<td width="50%">&nbsp;</td>
		<td width="2%">&nbsp;</td>
		<td width="20%">Jumlah</td>
		<td width="5%"> Rp. </td>
		<td style="text-align: right;"><?= $pembelian->harga_frame + $pembelian->harga_lensa; ?></td>	
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