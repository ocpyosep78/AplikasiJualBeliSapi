<script Language="JavaScript">
<!-- 
function Blank_TextField_Validator()
{
if (text_form.kode_jenis_sapi.value == "")
{
   alert("Kode jenis sapi tidak boleh kosong !");
   text_form.kode_jenis_sapi.focus();
   return (false);
}
if (text_form.keterangan_sapi.value == "")
{
   alert("Keterangan sapi tidak boleh kosong !");
   text_form.keterangan_sapi.focus();
   return (false);
}
return (true);
}
-->
</script>
<?php
include "config/fungsi_alert.php";
$aksi="page/page_jenis/aksi_jenis.php";
switch($_GET[act]){
	// Tampil jenis
  default:
  $offset=$_GET['offset'];
	//jumlah data yang ditampilkan perpage
	$limit = 10;
	if (empty ($offset)) {
		$offset = 0;
	}
  $tampil=mysql_query("SELECT * FROM jenis ORDER BY kode_jenis_sapi");
    echo "<h6 class='red'>Data Jenis Sapi</h6>
          <img src='images/tambahdata.png' width='40' height='40' style='cursor:pointer' title='Tambah Data Jenis Sapi' alt='tambah' onclick=\"window.location.href='?page=jenis&act=tambahjenis';\">";
	$baris=mysql_num_rows($tampil);

	if($baris>0){
	echo" <table width=100% border=1>
          <tr>
		  <th width=5%>No</th>
		  <th width=10%>Kode Jenis Sapi</th>
		  <th width=20%>Keterangan Sapi</th>
		  <th width=10%>Aksi</th>
		  </tr>"; 
	$hasil = mysql_query("SELECT * FROM jenis ORDER BY kode_jenis_sapi limit $offset,$limit");
	$no = 1;
	$no = 1 + $offset;
	$warnaGenap = "#B2CCFF";   // warna tua
	$warnaGanjil = "#E0EBFF";  // warna muda
	$counter = 1;
    while ($r=mysql_fetch_array($hasil)){
	if ($counter % 2 == 0) $warna = $warnaGenap;
	else $warna = $warnaGanjil;
       echo "<tr bgcolor='".$warna."'>
			 <td align=center>$no</td>
	         <td align=center>$r[kode_jenis_sapi]</td>
			 <td>$r[keterangan_sapi]</td>
			 <td align=center><a href=?page=jenis&act=editjenis&id=$r[kode_jenis_sapi]><img src='images/edit.png' title='Edit' alt='Edit' width='14' height='14'></a> &nbsp;
	               <a href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?page=jenis&act=hapus&id=$r[kode_jenis_sapi]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><img src='images/hapus.png' title='Hapus' alt='Hapus' width='14' height='14'></a>
				   
             </td></tr>";
      $no++;
	  $counter++;
    }
    echo "</table>";
	echo "<div class=paging>";

	if ($offset!=0) {
		$prevoffset = $offset-10;
		echo "<span class=prevnext> <a href=$PHP_SELF?page=jenis&offset=$prevoffset>Back</a></span>";
	}
	else {
		echo "<span class=disabled>Back</span>";//cetak halaman tanpa link
	}
	//hitung jumlah halaman
	$halaman = intval($baris/$limit);//Pembulatan

	if ($baris%$limit){
		$halaman++;
	}
	for($i=1;$i<=$halaman;$i++){
		$newoffset = $limit * ($i-1);
		if($offset!=$newoffset){
			echo "<a href=$PHP_SELF?page=jenis&offset=$newoffset>$i</a>";
			//cetak halaman
		}
		else {
			echo "<span class=current>".$i."</span>";//cetak halaman tanpa link
		}
	}

	//cek halaman akhir
	if(!(($offset/$limit)+1==$halaman) && $halaman !=1){

		//jika bukan halaman terakhir maka berikan next
		$newoffset = $offset + $limit;
		echo "<span class=prevnext><a href=$PHP_SELF?page=jenis&offset=$newoffset>Next</a>";
	}
	else {
		echo "<span class=disabled>Next</span>";//cetak halaman tanpa link
	}
	
	echo "</div>";
	}else{
	echo "<br><b>Data Kosong !</b>";
	}
    break;
  
  case "tambahjenis":
  	$ceknomor=mysql_fetch_array(mysql_query("SELECT kode_jenis_sapi FROM jenis ORDER BY kode_jenis_sapi DESC LIMIT 1"));
	$cekQ=$ceknomor['kode_jenis_sapi'];
	$awalQ=substr($cekQ,2-4);
	$next=$awalQ+1;
	$jnim=strlen($next);

	if($jnim==1)
	{ $no='JS00'; }
	elseif($jnim==2)
	{ $no='JS0'; }
	elseif($jnim==3)
	{ $no='JS'; }
	$idpr=$no.$next;
    echo "<h6 class='red'>Tambah Data Jenis Sapi</h6>
          <form name=text_form method=POST action='$aksi?page=jenis&act=input' onsubmit='return Blank_TextField_Validator()'>
          <table>
          <tr><td>Kode Jenis Sapi</td>   <td> : <input type=text id='kode_jenis_sapi' name='kode_jenis_sapi' size=5 maxlength=5 readonly value=$idpr></td></tr>
		  <tr><td>Keterangan Sapi</td>   <td> : <input type=text id='keterangan_sapi' name='keterangan_sapi' size=30 ></td></tr>
		  <tr><td colspan=2><input type=image src=images/simpan.png name=submit width='40' height='40' title='Simpan' alt='Simpan'>
							<img src=images/batal.png style='cursor:pointer' width='40' height='40' title='Batal' alt='Batal' onclick=self.history.back() ></td></tr>
          </table></form>";
     break;
    
  case "editjenis":
    $edit=mysql_query("SELECT * FROM jenis WHERE kode_jenis_sapi='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	
    echo "<h6 class='red'>Ubah Data jenis</h6>
          <form name=text_form method=POST action='$aksi?page=jenis&act=update' onsubmit='return Blank_TextField_Validator()'>
          <input type=hidden name=id value='$r[kode_jenis_sapi]'>
          <table>
	      <tr><td>Kode Jenis Sapi</td> <td> : <input type=text id='kode_jenis_sapi' name='kode_jenis_sapi' value=\"$r[kode_jenis_sapi]\" size=5 maxlength=5 readonly></td></tr>
		  <tr><td>Keterangan Sapi</td> <td> : <input type=text id='keterangan_sapi' name='keterangan_sapi' value=\"$r[keterangan_sapi]\" size=30></td></tr>
          <tr><td colspan=2><input type=image src=images/update.png name=submit width='40' height='40' title='Update' alt='Update'>
							<img src=images/batal.png style='cursor:pointer' width='40' height='40' title='Batal' alt='Batal' onclick=self.history.back() ></td></tr>
          </table></form>";
    break;  
}
?>
