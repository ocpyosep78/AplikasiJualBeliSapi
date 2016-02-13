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
if (text_form.kode_pembeli.value == "")
{
   alert("Kode Pembeli tidak boleh kosong !");
   text_form.kode_pembeli.focus();
   return (false);
}
if (text_form.nama_pembeli.value == "")
{
   alert("Nama Pembeli tidak boleh kosong !");
   text_form.nama_pembeli.focus();
   return (false);
}
if (text_form.alamat_pembeli.value == "")
{
   alert("Alamat Pembeli tidak boleh kosong !");
   text_form.alamat_pembeli.focus();
   return (false);
}
if (text_form.no_telp_pembeli.value == "")
{
   alert("No Telp Pembeli tidak boleh kosong !");
   text_form.no_telp_pembeli.focus();
   return (false);
}
return (true);
}
-->
</script>
<?php
include "config/fungsi_alert.php";
$aksi="page/page_pembeli/aksi_pembeli.php";
switch($_GET[act]){
	// Tampil pembeli
  default:
  $offset=$_GET['offset'];
	//jumlah data yang ditampilkan perpage
	$limit = 10;
	if (empty ($offset)) {
		$offset = 0;
	}
  $tampil=mysql_query("SELECT * FROM pembeli ORDER BY kode_pembeli");
    echo "<h6 class='red'>Data Pembeli</h6>
          <img src='images/tambahdata.png' width='40' height='40' style='cursor:pointer' title='Tambah pembeli' alt='tambah' onclick=\"window.location.href='?page=pembeli&act=tambahpembeli';\">";
	$baris=mysql_num_rows($tampil);

	if($baris>0){
	echo" <table width=100% border=1>
          <tr>
		  <th width=5%>No</th>
		  <th width=10%>Kode Pembeli</th>
		  <th width=20%>Nama Pembeli</th>
		  <th width=40%>Alamat Pembeli</th>
		  <th width=15%>No Telp Pembeli</th>
		  <th width=10%>Aksi</th>
		  </tr>"; 
	$hasil = mysql_query("SELECT * FROM pembeli ORDER BY kode_pembeli limit $offset,$limit");
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
	         <td align=center>$r[kode_pembeli]</td>
			 <td>$r[nama_pembeli]</td>
			 <td>$r[alamat_pembeli]</td>
			 <td align=center>$r[no_telp_pembeli]</td>
			 <td align=center><a href=?page=pembeli&act=editpembeli&id=$r[kode_pembeli]><img src='images/edit.png' title='Edit' alt='Edit' width='14' height='14'></a> &nbsp;
	               <a href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?page=pembeli&act=hapus&id=$r[kode_pembeli]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><img src='images/hapus.png' title='Hapus' alt='Hapus' width='14' height='14'></a>
				   
             </td></tr>";
      $no++;
	  $counter++;
    }
    echo "</table>";
	echo "<div class=paging>";

	if ($offset!=0) {
		$prevoffset = $offset-10;
		echo "<span class=prevnext> <a href=$PHP_SELF?page=pembeli&offset=$prevoffset>Back</a></span>";
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
			echo "<a href=$PHP_SELF?page=pembeli&offset=$newoffset>$i</a>";
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
		echo "<span class=prevnext><a href=$PHP_SELF?page=pembeli&offset=$newoffset>Next</a>";
	}
	else {
		echo "<span class=disabled>Next</span>";//cetak halaman tanpa link
	}
	
	echo "</div>";
	}else{
	echo "<br><b>Data Kosong !</b>";
	}
    break;
  
  case "tambahpembeli":
  $ceknomor=mysql_fetch_array(mysql_query("SELECT kode_pembeli FROM pembeli ORDER BY kode_pembeli DESC LIMIT 1"));
	$cekQ=$ceknomor['kode_pembeli'];
	$awalQ=substr($cekQ,2-4);
	$next=$awalQ+1;
	$jnim=strlen($next);

	if($jnim==1)
	{ $no='PB00'; }
	elseif($jnim==2)
	{ $no='PB0'; }
	elseif($jnim==3)
	{ $no='PB'; }
	$idpr=$no.$next;
    echo "<h6 class='red'>Tambah Data Pembeli</h6>
          <form name=text_form method=POST action='$aksi?page=pembeli&act=input' onsubmit='return Blank_TextField_Validator()'>
          <table>
          <tr><td>Kode Pembeli</td>   <td> : <input type=text id='kode_pembeli' name='kode_pembeli' size=5 maxlength=5 readonly value=$idpr></td></tr>
		  <tr><td>Nama Pembeli</td>   <td> : <input type=text id='nama_pembeli' name='nama_pembeli' size=30 ></td></tr>
		  <tr><td>Alamat Pembeli</td>   <td> : <input type=text id='alamat_pembeli' name='alamat_pembeli' size=30 ></td></tr>
		  <tr><td>No Telp Pembeli</td>   <td> : <input type=text id='no_telp_pembeli' name='no_telp_pembeli' size=15 maxlength=15 onkeypress=\"return isNumberKey(event)\"></td></tr>
		  <tr><td colspan=2><input type=image src=images/simpan.png name=submit width='40' height='40' title='Simpan' alt='Simpan'>
							<img src=images/batal.png style='cursor:pointer' width='40' height='40' title='Batal' alt='Batal' onclick=self.history.back() ></td></tr>
          </table></form>";
     break;
    
  case "editpembeli":
    $edit=mysql_query("SELECT * FROM pembeli WHERE kode_pembeli='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	
    echo "<h6 class='red'>Ubah Data Pembeli</h6>
          <form name=text_form method=POST action='$aksi?page=pembeli&act=update' onsubmit='return Blank_TextField_Validator()'>
          <input type=hidden name=id value='$r[kode_pembeli]'>
          <table>
	      <tr><td>Kode Pembeli</td> <td> : <input type=text id='kode_pembeli' name='kode_pembeli' value=\"$r[kode_pembeli]\" size=5 maxlength=5 readonly></td></tr>
		  <tr><td>Nama Pembeli</td> <td> : <input type=text id='nama_pembeli' name='nama_pembeli' value=\"$r[nama_pembeli]\" size=30></td></tr>
		  <tr><td>Alamat Pembeli</td> <td> : <input type=text id='alamat_pembeli' name='alamat_pembeli' value=\"$r[alamat_pembeli]\" size=30></td></tr>
		  <tr><td>No Telp Pembeli</td> <td> : <input type=text id='no_telp_pembeli' name='no_telp_pembeli' value=\"$r[no_telp_pembeli]\" size=15 maxlength=15 onkeypress=\"return isNumberKey(event)\"></td></tr>
          <tr><td colspan=2><input type=image src=images/update.png name=submit width='40' height='40' title='Update' alt='Update'>
							<img src=images/batal.png style='cursor:pointer' width='40' height='40' title='Batal' alt='Batal' onclick=self.history.back() ></td></tr>
          </table></form>";
    break;  
}
?>
