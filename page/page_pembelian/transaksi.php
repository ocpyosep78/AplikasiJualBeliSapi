<?php
error_reporting(0);
?>
<link type="text/css" href="css/smoothness/jquery-ui-1.8.24.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.24.custom.min.js"></script>
		<script type="text/javascript">
		$(function() {
		$( "#tgl_faktur_pembelian" ).datepicker({
				changeMonth: true,
				changeYear: true,
				maxDate: 0,
				dateFormat: "yy-mm-dd"
			});
		});
		function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }

function Blank_TextField_Validator()
{
if (text_form.kode_sapi.value == "")
{
   alert("Sapi masih kosong ! Silahkan pilih sapi !");
   text_form.kode_sapi.focus();
   return (false);
}
if (text_form.qty.value == "")
{
   alert("Jumlah Sapi tidak boleh kosong !");
   text_form.qty.focus();
   return (false);
}
return (true);
}
		</script>
		<script type='text/javascript' src='autocomplete/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="autocomplete/jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#kode_sapi").autocomplete("autocomplete/get_list.php", {
		width: 260,
		matchContains: true,
		selectFirst: false
	});
});
</script>
<?php
include "pdf/fpdf.php";
include "config/fungsi_alert.php";
$aksi="page/page_pembelian/aksi_transaksi.php";
  include "config/koneksi.php";
  
  //$no_transaksi	= isset($_POST['no_transaksi']) ? $_POST['no_transaksi'] : '';
  
   $ceknomor=mysql_fetch_array(mysql_query("SELECT no_faktur_pembelian FROM faktur_pembelian ORDER BY no_faktur_pembelian DESC LIMIT 1"));
	$cekQ=$ceknomor['no_faktur_pembelian'];
	$awalQ=substr($cekQ,2-7);
	$next=$awalQ+1;
	$jnim=strlen($next);

	if($jnim==1)
	{ $no='BL00000'; }
	elseif($jnim==2)
	{ $no='BL0000'; }
	elseif($jnim==3)
	{ $no='BL000'; }
	elseif($jnim==4)
	{ $no='BL00'; }
	elseif($jnim==5)
	{ $no='BL0'; }
	elseif($jnim==6)
	{ $no='BL'; }
	$idpr=$no.$next;
  $tgl = date('Y-m-d');
if(isset($_GET['pesan'])){
		echo "
		
		<div class=\"ui-widget\">
			<div class=\"ui-state-highlight ui-corner-all\" style=\"margin-top: 20px; padding: 0 .7em;\">
				<span class=\"ui-icon ui-icon-info\" style=\"float: left; margin-right: .3em;\"></span>
				<strong>".$_GET['pesan']."</strong>
			</div>
		</div>";
	}
echo "
          <form method=POST action='?page=pembelian' name=text_form >
		  <br>Sapi : <input type=text name='kode_sapi' id='kode_sapi' value='$_POST[kode_sapi]'>&nbsp;
		Jumlah : <input type=text name='qty' id='qty' size=2 onkeypress=\"return isNumberKey(event)\" value='$_POST[qty]'>&nbsp;
		<input type=submit value='  Tambah  ' name='btnTambah' ><br>";
echo" <table>
          <tr>
		  <th>No</th>
		  <th width=75>Kode Sapi</th>
		  <th width=200>Keterangan Sapi</th>
		  <th width=100>Harga</th>
		  <th width=50>Jumlah</th>
		  <th width=100>Subtotal</th>
		  <th width=70>Hapus</th>
		  </tr>"; 
    $tampil=mysql_query("SELECT * FROM _tmp_pembelian join sapi using(kode_sapi)");
	$no=1;

	$counter = 1;
    while ($r=mysql_fetch_array($tampil)){
	$s=mysql_query("SELECT * FROM jenis join sapi using(kode_jenis_sapi) where kode_sapi='$r[kode_sapi]'");
	$rs=mysql_fetch_array($s);
	if ($counter % 2 == 0) $warna = $warnaGenap;
	else $warna = $warnaGanjil;
       echo "<tr bgcolor='".$warna."'>
			 <td align=center>$no</td>
			 <td align=center>$r[kode_sapi]</td>
			 <td>$rs[keterangan_sapi]</td>
             <td align=right>$rs[harga_sapi]</td>
			 <td align=center>$r[jumlah]</td>";
			 $subtotal = $rs[harga_sapi] * $r[jumlah];
		echo "
			<td align=right>$subtotal</td>
			 <td align=center>
	               <a href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?page=pembelian&act=hapus&id=$r[id]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><img src='images/hapus.png' title='Hapus' alt='Hapus' width='14' height='14'></a>
				   
             </td></tr>";
      $no++;
	  $counter++;
    }
	$sql2=mysql_query("SELECT sum(jumlah) as jml FROM _tmp_pembelian");
	$rs2=mysql_fetch_array($sql2);
	$sql3=mysql_query("SELECT sum(subtotal) as jml FROM _tmp_pembelian");
	$rs3=mysql_fetch_array($sql3);
    echo "
	<tr>
    <td colspan='4' align='right'><b>Grand Total : </b></td>
    <td align='center'><b>$rs2[jml]</b></td>
    <td align='right'><b>$rs3[jml]</b><input type=hidden name=jml id=jml value=$rs3[jml] /></td>
    <td align='center'>&nbsp;</td>
	</tr>
	</table>
          <table>
		  <tr><td>No Faktur Pembelian</td>   <td> : <input type=text name='no_faktur_pembelian' id='no_faktur_pembelian' value='$idpr' readonly></td></tr>
          <tr><td>Tgl Faktur Pembelian</td>   <td> : <input type=text id='tgl_faktur_pembelian' name='tgl_faktur_pembelian' value='$tgl'></td></tr>
		  <tr><td>Penyuplai</td>   <td> : <select name='kode_penyuplai' id='kode_penyuplai'></option>";
				$hasil4 = mysql_query("SELECT * FROM penyuplai order by kode_penyuplai");
		while($r4=mysql_fetch_array($hasil4)){
			echo "<option value='$r4[kode_penyuplai]'>$r4[nama_penyuplai]</option>";
		}
		echo	"</select></td></tr>
		  
          </table>
		
		<input type=submit value='  Simpan Transaksi  ' name='btnSimpan' ></form><br>
		";

	
	//if($_GET) {
	
		if($_POST) {
			
			if(isset($_POST['btnTambah'])){
			if(trim($_POST[kode_sapi])==""){
				header('location:main.php?page=pembelian&pesan=Isi dulu Sapi !');
			}else if(trim($_POST[qty])==""){
				header('location:main.php?page=pembelian&pesan=Isi dulu Jumlah !');
			}else{
			$prod=substr($_POST[kode_sapi],0,5);
			$sql=mysql_query("SELECT * FROM sapi where kode_sapi='$prod'");
				$rs=mysql_fetch_array($sql);
				$harga=$rs[harga_sapi];
				$subtotal=$harga * $_POST[qty];
				mysql_query("INSERT INTO _tmp_pembelian
							VALUES('',
								'$prod',
								'$_POST[qty]',
								'$subtotal')");
				echo "<meta http-equiv='refresh' content='0; url=?page=pembelian'>";
			}
			}
			
			# JIKA TOMBOL SIMPAN DIKLIK
			if(isset($_POST['btnSimpan'])){
			$sqlcek=mysql_query("SELECT * FROM _tmp_pembelian");
			$rscek=mysql_num_rows($sqlcek);
			if($rscek > 0){
				mysql_query("INSERT INTO faktur_pembelian(
								  no_faktur_pembelian,
								  tgl_faktur_pembelian,
								  kode_penyuplai,
								  total_pembelian) 
							VALUES(
								'$_POST[no_faktur_pembelian]',
								'$_POST[tgl_faktur_pembelian]',
								'$_POST[kode_penyuplai]',
								'$rs3[jml]')");
				$sql=mysql_query("SELECT * FROM _tmp_pembelian");
				while($rs=mysql_fetch_array($sql)){
					mysql_query("INSERT INTO transaksi_pembelian
							VALUES('',
								'$_POST[no_faktur_pembelian]',
								'$rs[kode_sapi]',
								'$_POST[tgl_faktur_pembelian]',
								'$rs[jumlah]')");
					$sqlcek2=mysql_query("SELECT * FROM sapi where kode_sapi='$rs[kode_sapi]'");
					$rscek2=mysql_fetch_array($sqlcek2);
					$stok = $rscek2['jumlah_sapi'] + $rs['jumlah'];
					mysql_query("update sapi set jumlah_sapi='$stok' where kode_sapi='$rs[kode_sapi]'");
				}
				
				mysql_query("delete from _tmp_pembelian");
				
				echo "<meta http-equiv='refresh' content='0; url=?page=pembelian'>";
				header('location:main.php?page=pembelian&pesan=Data transaksi berhasil disimpan ! ');
				
				}
				else{
					header('location:main.php?page=pembelian&pesan=Data Kosong !');
				}
			}

		} // Penutup POST
	//} // Penutup GET

	
?>
