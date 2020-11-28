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
		<td width="50%"><?= $pembelian->nama_frame; ?></td>
		<td width="5%"> Rp. </td>
		<td style="text-align: right;"><?= $pembelian->harga_frame; ?></td>
	</tr>
	<tr>
		<td width="20%">Lensa</td>
		<td width="2%"> : </td>
		<td width="50%"><?= $pembelian->nama_lensa; ?></td>
		<td width="5%"> Rp. </td>
		<td style="text-align: right;"><?= $pembelian->harga_lensa; ?></td>
	</tr>
	<tr>
		<td width="20%">Keterangan</td>
		<td width="2%"> : </td>
		<td width="50%"><?= $pembelian->keterangan; ?></td>
		<td width="5%"> Rp. </td>
		<td style="text-align: right;"><?= $pembelian->harga_keterangan; ?><br><hr></td>
	</tr>
</table>
<br>
<table border="0" width="100%">
	<tr>
		<td width="50%">&nbsp;</td>
		<td width="2%">&nbsp;</td>
		<td width="20%">Jumlah</td>
		<td width="5%"> Rp. </td>
		<td style="text-align: right;"><?= $pembelian->harga_frame + $pembelian->harga_lensa + $pembelian->harga_keterangan; ?></td>	
	</tr>
	<tr>
		<td width="50%">&nbsp;</td>
		<td width="2%">&nbsp;</td>
		<td width="20%">Uang Muka</td>
		<td width="5%"> Rp. </td>
		<td style="text-align: right;"><?= $pembelian->uang_muka; ?></td>	
	</tr>
	<tr>
		<td width="50%">&nbsp;</td>
		<td width="2%">&nbsp;</td>
		<td width="20%">Sisa</td>
		<td width="5%"> Rp. </td>
		<td style="text-align: right;"><?= $pembelian->sisa; ?></td>	
	</tr>
</table>
<table border="0" width="100%">
	<tr>
		<td width="20%">Selesai Tgl</td>
		<td width="2%"> : </td>
		<td><?= date("d-m-Y", strtotime($pembelian->tgl_selesai)); ?></td>
		<td style="padding-top: 20px; ">
			<center>Sales</center><br><br><br>
			<center>(...............................)</center>
		</td>
	</tr>
</table>