<script Language="JavaScript">
<!-- 
function Blank_TextField_Validator()
{
if (text_form.username.value == "")
{
   alert("Username tidak boleh kosong !");
   text_form.username.focus();
   return (false);
}
if (text_form.password.value == "")
{
   alert("Password tidak boleh kosong !");
   text_form.password.focus();
   return (false);
}
if (text_form.level.value == "")
{
   alert("Level tidak boleh kosong !");
   text_form.level.focus();
   return (false);
}
return (true);
}
-->
</script>
<?php
include "config/fungsi_alert.php";
$aksi="page/page_pengguna/aksi_pengguna.php";
switch($_GET[act]){
	// Tampil pengguna
  default:
  $offset=$_GET['offset'];
	//jumlah data yang ditampilkan perpage
	$limit = 10;
	if (empty ($offset)) {
		$offset = 0;
	}
  $tampil=mysql_query("SELECT * FROM pengguna ORDER BY username");
    echo "<h6 class='red'>Data Pengguna</h6>
          <img src='images/tambahdata.png' width='40' height='40' style='cursor:pointer' title='Tambah Pengguna' alt='tambah' onclick=\"window.location.href='?page=pengguna&act=tambahpengguna';\">";
	$baris=mysql_num_rows($tampil);

	if($baris>0){
	echo" <table width=100% border=1>
          <tr>
		  <th width=10%>No</th>
		  <th width=60%>Username</th>
		  <th width=20%>Level</th>
		  <th width=10%>Aksi</th>
		  </tr>"; 
	$hasil = mysql_query("SELECT * FROM pengguna ORDER BY username limit $offset,$limit");
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
	         <td>$r[username]</td>
			 <td align=center>$r[level]</td>
			 <td align=center><a href=?page=pengguna&act=editpengguna&id=$r[username]><img src='images/edit.png' title='Edit' alt='Edit' width='14' height='14'></a> &nbsp;
	               <a href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?page=pengguna&act=hapus&id=$r[username]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><img src='images/hapus.png' title='Hapus' alt='Hapus' width='14' height='14'></a>
				   
             </td></tr>";
      $no++;
	  $counter++;
    }
    echo "</table>";
	echo "<div class=paging>";

	if ($offset!=0) {
		$prevoffset = $offset-10;
		echo "<span class=prevnext> <a href=$PHP_SELF?page=pengguna&offset=$prevoffset>Back</a></span>";
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
			echo "<a href=$PHP_SELF?page=pengguna&offset=$newoffset>$i</a>";
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
		echo "<span class=prevnext><a href=$PHP_SELF?page=pengguna&offset=$newoffset>Next</a>";
	}
	else {
		echo "<span class=disabled>Next</span>";//cetak halaman tanpa link
	}
	
	echo "</div>";
	}else{
	echo "<br><b>Data Kosong !</b>";
	}
    break;
  
  case "tambahpengguna":
    echo "<h6 class='red'>Tambah Data Pengguna</h6>
          <form name=text_form method=POST action='$aksi?page=pengguna&act=input' onsubmit='return Blank_TextField_Validator()'>
          <table>
          <tr><td>Username</td>   <td> : <input type=text id='username' name='username' size=30 maxlength=10></td></tr>
		<tr><td>Password</td>   <td> : <input type=password id='password' name='password' size=30></td></tr>
		<tr><td>Level</td> <td> : <select name=level id=level><option value=''></option>";
			$arr=array( "admin", 
						"kabag" );
			foreach ($arr as $arrdata) {
				echo "<option value='$arrdata'";
				echo ">$arrdata</option>";                   
            }
			echo "</select></td></tr>
		  <tr><td colspan=2><input type=image src=images/simpan.png name=submit width='40' height='40' title='Simpan' alt='Simpan'>
							<img src=images/batal.png style='cursor:pointer' width='40' height='40' title='Batal' alt='Batal' onclick=self.history.back() ></td></tr>
          </table></form>";
     break;
    
  case "editpengguna":
    $edit=mysql_query("SELECT * FROM pengguna WHERE username='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	
    echo "<h6 class='red'>Ubah Data Pengguna</h6>
          <form name=text_form method=POST action='$aksi?page=pengguna&act=update' onsubmit='return Blank_TextField_Validator()'>
          <input type=hidden name=id value='$r[username]'>
          <table>
	      <tr><td>Username</td> <td> : <input type=text id='username' name='username' value=\"$r[username]\" size=30 maxlength=10></td></tr>
		  <tr><td>Level</td> <td> : <select name=level id=level></option>";
			$arr=array( "admin", 
						"kabag" );
			foreach ($arr as $arrdata) {
				echo "<option value='$arrdata'"; if($r[level]==$arrdata) echo "selected";
				echo ">$arrdata</option>";                   
            }
			echo "</select></td></tr>
          <tr><td colspan=2><input type=image src=images/update.png name=submit width='40' height='40' title='Update' alt='Update'>
							<img src=images/batal.png style='cursor:pointer' width='40' height='40' title='Batal' alt='Batal' onclick=self.history.back() ></td></tr>
          </table></form>";
    break;  
}
?>
