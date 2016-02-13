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
if (text_form.no_faktur_pembelian.value == "")
{
   alert("Kode pembelian tidak boleh kosong !");
   text_form.no_faktur_pembelian.focus();
   return (false);
}
return (true);
}
-->
</script>
<?php
include "config/fungsi_alert.php";

switch($_GET[act]){
	// Tampil pembelian
  default:
  $offset=$_GET['offset'];
	//jumlah data yang ditampilkan perpage
	$limit = 10;
	if (empty ($offset)) {
		$offset = 0;
	}
	echo "<h6 class='red'>Transaksi Pembelian</h6>";
	
  include "transaksi.php";
	$aksi="page/page_pembelian/aksi_pembelian.php";
  $tampil=mysql_query("SELECT * FROM faktur_pembelian ORDER BY no_faktur_pembelian");
	$baris=mysql_num_rows($tampil);
	echo"<hr>";
	echo "<h6 class='red'>Faktur Pembelian</h6>";
	if($baris>0){
	echo" <table width=100% border=1>
          <tr>
		  <th width=5%>No</th>
		  <th width=20%>No Faktur Pembelian</th>
		  <th width=25%>Kode Penyuplai</th>
		  <th width=30%>Tgl Faktur Pembelian</th>
		  <th width=20%>Total Pembelian</th>
		  <th width=10%>Aksi</th>
		  </tr>"; 
	$hasil = mysql_query("SELECT * FROM faktur_pembelian join penyuplai using(kode_penyuplai) ORDER BY no_faktur_pembelian limit $offset,$limit");
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
	         <td align=center>$r[no_faktur_pembelian]</td>
			 <td align=center>$r[kode_penyuplai] - $r[nama_penyuplai]</td>
			 <td align=center>$r[tgl_faktur_pembelian]</td>
			 <td align=center>$r[total_pembelian]</td>
			 <td align=center>
	               <a href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?page=pembelian&act=hapus&id=$r[no_faktur_pembelian]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><img src='images/hapus.png' title='Hapus' alt='Hapus' width='14' height='14'></a>
				   
             </td></tr>";
      $no++;
	  $counter++;
    }
    echo "</table>";
	echo "<div class=paging>";

	if ($offset!=0) {
		$prevoffset = $offset-10;
		echo "<span class=prevnext> <a href=$PHP_SELF?page=pembelian&offset=$prevoffset>Back</a></span>";
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
			echo "<a href=$PHP_SELF?page=pembelian&offset=$newoffset>$i</a>";
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
		echo "<span class=prevnext><a href=$PHP_SELF?page=pembelian&offset=$newoffset>Next</a>";
	}
	else {
		echo "<span class=disabled>Next</span>";//cetak halaman tanpa link
	}
	
	echo "</div>";
	}else{
	echo "<br><b>Data Kosong !</b>";
	}
    break;  
}
?>
