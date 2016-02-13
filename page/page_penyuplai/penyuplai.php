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
if (text_form.kode_penyuplai.value == "")
{
   alert("Kode penyuplai tidak boleh kosong !");
   text_form.kode_penyuplai.focus();
   return (false);
}
if (text_form.nama_penyuplai.value == "")
{
   alert("Nama penyuplai tidak boleh kosong !");
   text_form.nama_penyuplai.focus();
   return (false);
}
if (text_form.alamat_penyuplai.value == "")
{
   alert("Alamat penyuplai tidak boleh kosong !");
   text_form.alamat_penyuplai.focus();
   return (false);
}
if (text_form.no_telp_penyuplai.value == "")
{
   alert("No Telp penyuplai tidak boleh kosong !");
   text_form.no_telp_penyuplai.focus();
   return (false);
}
return (true);
}
-->
</script>
<?php
include "config/fungsi_alert.php";
$aksi="page/page_penyuplai/aksi_penyuplai.php";
switch($_GET[act]){
	// Tampil penyuplai
  default:
  $offset=$_GET['offset'];
	//jumlah data yang ditampilkan perpage
	$limit = 10;
	if (empty ($offset)) {
		$offset = 0;
	}
  $tampil=mysql_query("SELECT * FROM penyuplai ORDER BY kode_penyuplai");
    echo "<h6 class='red'>Data Penyuplai</h6>
          <img src='images/tambahdata.png' width='40' height='40' style='cursor:pointer' title='Tambah Data Penyuplai' alt='tambah' onclick=\"window.location.href='?page=penyuplai&act=tambahpenyuplai';\">";
	$baris=mysql_num_rows($tampil);

	if($baris>0){
	echo" <table width=100% border=1>
          <tr>
		  <th width=5%>No</th>
		  <th width=15%>Kode Penyuplai</th>
		  <th width=20%>Nama Penyuplai</th>
		  <th width=35%>Alamat Penyuplai</th>
		  <th width=15%>No Telp Penyuplai</th>
		  <th width=10%>Aksi</th>
		  </tr>"; 
	$hasil = mysql_query("SELECT * FROM penyuplai ORDER BY kode_penyuplai limit $offset,$limit");
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
	         <td align=center>$r[kode_penyuplai]</td>
			 <td>$r[nama_penyuplai]</td>
			 <td>$r[alamat_penyuplai]</td>
			 <td align=center>$r[no_telp_penyuplai]</td>
			 <td align=center><a href=?page=penyuplai&act=editpenyuplai&id=$r[kode_penyuplai]><img src='images/edit.png' title='Edit' alt='Edit' width='14' height='14'></a> &nbsp;
	               <a href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?page=penyuplai&act=hapus&id=$r[kode_penyuplai]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><img src='images/hapus.png' title='Hapus' alt='Hapus' width='14' height='14'></a>
				   
             </td></tr>";
      $no++;
	  $counter++;
    }
    echo "</table>";
	echo "<div class=paging>";

	if ($offset!=0) {
		$prevoffset = $offset-10;
		echo "<span class=prevnext> <a href=$PHP_SELF?page=penyuplai&offset=$prevoffset>Back</a></span>";
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
			echo "<a href=$PHP_SELF?page=penyuplai&offset=$newoffset>$i</a>";
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
		echo "<span class=prevnext><a href=$PHP_SELF?page=penyuplai&offset=$newoffset>Next</a>";
	}
	else {
		echo "<span class=disabled>Next</span>";//cetak halaman tanpa link
	}
	
	echo "</div>";
	}else{
	echo "<br><b>Data Kosong !</b>";
	}
    break;
  
  case "tambahpenyuplai":
  $ceknomor=mysql_fetch_array(mysql_query("SELECT kode_penyuplai FROM penyuplai ORDER BY kode_penyuplai DESC LIMIT 1"));
	$cekQ=$ceknomor['kode_penyuplai'];
	$awalQ=substr($cekQ,2-4);
	$next=$awalQ+1;
	$jnim=strlen($next);

	if($jnim==1)
	{ $no='PY00'; }
	elseif($jnim==2)
	{ $no='PY0'; }
	elseif($jnim==3)
	{ $no='PY'; }
	$idpr=$no.$next;
    echo "<h6 class='red'>Tambah Data Penyuplai</h6>
          <form name=text_form method=POST action='$aksi?page=penyuplai&act=input' onsubmit='return Blank_TextField_Validator()'>
          <table>
          <tr><td>Kode Penyuplai</td>   <td> : <input type=text id='kode_penyuplai' name='kode_penyuplai' size=5 maxlength=5 readonly value=$idpr></td></tr>
		  <tr><td>Nama Penyuplai</td>   <td> : <input type=text id='nama_penyuplai' name='nama_penyuplai' size=30 ></td></tr>
		  <tr><td>Alamat Penyuplai</td>   <td> : <input type=text id='alamat_penyuplai' name='alamat_penyuplai' size=30 ></td></tr>
		  <tr><td>No Telp Penyuplai</td>   <td> : <input type=text id='no_telp_penyuplai' name='no_telp_penyuplai' size=15 maxlength=15 onkeypress=\"return isNumberKey(event)\"></td></tr>
		  <tr><td colspan=2><input type=image src=images/simpan.png name=submit width='40' height='40' title='Simpan' alt='Simpan'>
							<img src=images/batal.png style='cursor:pointer' width='40' height='40' title='Batal' alt='Batal' onclick=self.history.back() ></td></tr>
          </table></form>";
     break;
    
  case "editpenyuplai":
    $edit=mysql_query("SELECT * FROM penyuplai WHERE kode_penyuplai='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	
    echo "<h6 class='red'>Ubah Data Penyuplai</h6>
          <form name=text_form method=POST action='$aksi?page=penyuplai&act=update' onsubmit='return Blank_TextField_Validator()'>
          <input type=hidden name=id value='$r[kode_penyuplai]'>
          <table>
	      <tr><td>Kode Penyuplai</td> <td> : <input type=text id='kode_penyuplai' name='kode_penyuplai' value=\"$r[kode_penyuplai]\" size=5 maxlength=5 readonly></td></tr>
		  <tr><td>Nama Penyuplai</td> <td> : <input type=text id='nama_penyuplai' name='nama_penyuplai' value=\"$r[nama_penyuplai]\" size=30></td></tr>
		  <tr><td>Alamat Penyuplai</td> <td> : <input type=text id='alamat_penyuplai' name='alamat_penyuplai' value=\"$r[alamat_penyuplai]\" size=30></td></tr>
		  <tr><td>No Telp Penyuplai</td> <td> : <input type=text id='no_telp_penyuplai' name='no_telp_penyuplai' value=\"$r[no_telp_penyuplai]\" size=15 maxlength=15 onkeypress=\"return isNumberKey(event)\"></td></tr>
          <tr><td colspan=2><input type=image src=images/update.png name=submit width='40' height='40' title='Update' alt='Update'>
							<img src=images/batal.png style='cursor:pointer' width='40' height='40' title='Batal' alt='Batal' onclick=self.history.back() ></td></tr>
          </table></form>";
    break;  
}
?>
