<?php
session_start();
include "../../config/koneksi.php";

$page=$_GET[page];
$act=$_GET[act];

// Hapus penyuplai
if ($page=='penyuplai' AND $act=='hapus'){
  mysql_query("DELETE FROM penyuplai WHERE kode_penyuplai='$_GET[id]'");
  header('location:../../main.php?page='.$page);
}

// Input penyuplai
elseif ($page=='penyuplai' AND $act=='input'){
$kode_penyuplai=mysql_real_escape_string($_POST[kode_penyuplai]);
$nama_penyuplai=mysql_real_escape_string($_POST[nama_penyuplai]);
$alamat_penyuplai=mysql_real_escape_string($_POST[alamat_penyuplai]);
$no_telp_penyuplai=mysql_real_escape_string($_POST[no_telp_penyuplai]);
mysql_query("INSERT INTO penyuplai
	                       VALUES(
				'$kode_penyuplai',
				'$nama_penyuplai',
				'$alamat_penyuplai',
				'$no_telp_penyuplai')");
  header('location:../../main.php?page='.$page);
}

// Update penyuplai
elseif ($page=='penyuplai' AND $act=='update'){
$kode_penyuplai=mysql_real_escape_string($_POST[kode_penyuplai]);
$nama_penyuplai=mysql_real_escape_string($_POST[nama_penyuplai]);
$alamat_penyuplai=mysql_real_escape_string($_POST[alamat_penyuplai]);
$no_telp_penyuplai=mysql_real_escape_string($_POST[no_telp_penyuplai]);
  mysql_query("UPDATE penyuplai SET
					kode_penyuplai   = '$kode_penyuplai',
					nama_penyuplai   = '$nama_penyuplai',
					alamat_penyuplai   = '$alamat_penyuplai',
					no_telp_penyuplai   = '$no_telp_penyuplai'
                           WHERE kode_penyuplai       = '$_POST[id]'");
  header('location:../../main.php?page='.$page);
 }
 
?>