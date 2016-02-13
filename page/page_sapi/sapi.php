<script Language="JavaScript">
function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
<!-- 
function Blank_TextField_Validator()
{
if (text_form.kode_sapi.value == "")
{
   alert("Kode sapi tidak boleh kosong !");
   text_form.kode_sapi.focus();
   return (false);
}
if (text_form.kode_jenis_sapi.value == "")
{
   alert("Jenis sapi tidak boleh kosong !");
   text_form.kode_jenis_sapi.focus();
   return (false);
}
if (text_form.harga_sapi.value == "")
{
   alert("Harga sapi tidak boleh kosong !");
   text_form.harga_sapi.focus();
   return (false);
}
if (text_form.berat_sapi.value == "")
{
   alert("Berat sapi tidak boleh kosong !");
   text_form.berat_sapi.focus();
   return (false);
}
if (text_form.jumlah_sapi.value == "")
{
   alert("Jumlah sapi tidak boleh kosong !");
   text_form.jumlah_sapi.focus();
   return (false);
}
return (true);
}
-->
</script>
<?php
include "config/fungsi_alert.php";
$aksi="page/page_sapi/aksi_sapi.php";
switch($_GET[act]){
	// Tampil sapi
  default:
  $offset=$_GET['offset'];
	//jumlah data yang ditampilkan perpage
	$limit = 10;
	if (empty ($offset)) {
		$offset = 0;
	}
  $tampil=mysql_query("SELECT * FROM sapi ORDER BY kode_sapi");
    echo "<h6 class='red'>Data Sapi</h6>
          <img src='images/tambahdata.png' width='40' height='40' style='cursor:pointer' title='Tambah Data Sapi' alt='tambah' onclick=\"window.location.href='?page=sapi&act=tambahsapi';\">";
	$baris=mysql_num_rows($tampil);

	if($baris>0){
	echo" <table width=100% border=1>
          <tr>
		  <th width=5%>No</th>
		  <th width=10%>Kode Sapi</th>
		  <th width=20%>Jenis Sapi</th>
		  <th width=10%>Harga Sapi (Rp.)</th>
		  <th width=15%>Berat Sapi (Kg)</th>
		  <th width=15%>Jumlah Sapi (Ekor)</th>
		  <th width=10%>Aksi</th>
		  </tr>"; 
	$hasil = mysql_query("SELECT * FROM sapi join jenis using(kode_jenis_sapi) ORDER BY kode_sapi limit $offset,$limit");
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
	         <td align=center>$r[kode_sapi]</td>
			 <td>$r[keterangan_sapi]</td>
			 <td align=center>$r[harga_sapi]</td>
			 <td align=center>$r[berat_sapi]</td>
			 <td align=center>$r[jumlah_sapi]</td>
			 <td align=center><a href=?page=sapi&act=editsapi&id=$r[kode_sapi]><img src='images/edit.png' title='Edit' alt='Edit' width='14' height='14'></a> &nbsp;
	               <a href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?page=sapi&act=hapus&id=$r[kode_sapi]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><img src='images/hapus.png' title='Hapus' alt='Hapus' width='14' height='14'></a>
				   
             </td></tr>";
      $no++;
	  $counter++;
    }
    echo "</table>";
	echo "<div class=paging>";

	if ($offset!=0) {
		$prevoffset = $offset-10;
		echo "<span class=prevnext> <a href=$PHP_SELF?page=sapi&offset=$prevoffset>Back</a></span>";
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
			echo "<a href=$PHP_SELF?page=sapi&offset=$newoffset>$i</a>";
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
		echo "<span class=prevnext><a href=$PHP_SELF?page=sapi&offset=$newoffset>Next</a>";
	}
	else {
		echo "<span class=disabled>Next</span>";//cetak halaman tanpa link
	}
	
	echo "</div>";
	}else{
	echo "<br><b>Data Kosong !</b>";
	}
    break;
  
  case "tambahsapi":
  $ceknomor=mysql_fetch_array(mysql_query("SELECT kode_sapi FROM sapi ORDER BY kode_sapi DESC LIMIT 1"));
	$cekQ=$ceknomor['kode_sapi'];
	$awalQ=substr($cekQ,2-4);
	$next=$awalQ+1;
	$jnim=strlen($next);

	if($jnim==1)
	{ $no='SP00'; }
	elseif($jnim==2)
	{ $no='SP0'; }
	elseif($jnim==3)
	{ $no='SP'; }
	$idpr=$no.$next;
    echo "<h6 class='red'>Tambah Data Sapi</h6>
          <form name=text_form method=POST action='$aksi?page=sapi&act=input' onsubmit='return Blank_TextField_Validator()'>
          <table>
          <tr><td>Kode Sapi</td>   <td> : <input type=text id='kode_sapi' name='kode_sapi' size=5 maxlength=5 readonly value=$idpr></td></tr>
		  <tr><td>Jenis Sapi</td>   <td> : <select name='kode_jenis_sapi' id='kode_jenis_sapi'><option value=''>  </option>";
				$hasil4 = mysql_query("SELECT * FROM jenis order by kode_jenis_sapi");
		while($r4=mysql_fetch_array($hasil4)){
			echo "<option value='$r4[kode_jenis_sapi]'>$r4[keterangan_sapi]</option>";
		}
		echo	"</select></td></tr>
		  <tr><td>Harga Sapi (Rp.) </td>   <td> : <input type=text id='harga_sapi' name='harga_sapi' size=10 onkeypress=\"return isNumberKey(event)\"></td></tr>
		  <tr><td>Berat Sapi (Kg) </td>   <td> : <input type=text id='berat_sapi' name='berat_sapi' size=10 onkeypress=\"return isNumberKey(event)\"></td></tr>
		  <tr><td>Jumlah Sapi (Ekor)</td>   <td> : <input type=text id='jumlah_sapi' name='jumlah_sapi' size=10 onkeypress=\"return isNumberKey(event)\" maxlength=4></td></tr>
		  <tr><td colspan=2><input type=image src=images/simpan.png name=submit width='40' height='40' title='Simpan' alt='Simpan'>
							<img src=images/batal.png style='cursor:pointer' width='40' height='40' title='Batal' alt='Batal' onclick=self.history.back() ></td></tr>
          </table></form>";
     break;
    
  case "editsapi":
    $edit=mysql_query("SELECT * FROM sapi WHERE kode_sapi='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	
    echo "<h6 class='red'>Ubah Data Sapi</h6>
          <form name=text_form method=POST action='$aksi?page=sapi&act=update' onsubmit='return Blank_TextField_Validator()'>
          <input type=hidden name=id value='$r[kode_sapi]'>
          <table>
	      <tr><td>Kode Sapi</td> <td> : <input type=text id='kode_sapi' name='kode_sapi' value=\"$r[kode_sapi]\" size=5 maxlength=5 readonly></td></tr>
		  <tr><td>Jenis Sapi</td> <td> : <select name='kode_jenis_sapi' id='kode_jenis_sapi'></option>";
				$hasil4 = mysql_query("SELECT * FROM jenis order by kode_jenis_sapi");
		while($r4=mysql_fetch_array($hasil4)){
			echo "<option value='$r4[kode_jenis_sapi]'"; if($r[kode_jenis_sapi]==$r4[kode_jenis_sapi]) echo "selected";
			echo ">$r4[keterangan_sapi]</option>"; 
		}
		echo	"</select></td></tr>
		  <tr><td>Harga Sapi (Rp.) </td> <td> : <input type=text id='harga_sapi' name='harga_sapi' value=\"$r[harga_sapi]\" size=10 onkeypress=\"return isNumberKey(event)\"></td></tr>
		  <tr><td>Berat Sapi (Kg)</td> <td> : <input type=text id='berat_sapi' name='berat_sapi' value=\"$r[berat_sapi]\" size=10 onkeypress=\"return isNumberKey(event)\"></td></tr>
		  <tr><td>Jumlah Sapi (Ekor)</td> <td> : <input type=text id='jumlah_sapi' name='jumlah_sapi' value=\"$r[jumlah_sapi]\" size=10 onkeypress=\"return isNumberKey(event)\" maxlength=4></td></tr>
          <tr><td colspan=2><input type=image src=images/update.png name=submit width='40' height='40' title='Update' alt='Update'>
							<img src=images/batal.png style='cursor:pointer' width='40' height='40' title='Batal' alt='Batal' onclick=self.history.back() ></td></tr>
          </table></form>";
    break;  
}
?>
