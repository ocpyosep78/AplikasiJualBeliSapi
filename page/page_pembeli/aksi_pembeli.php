<?php
session_start();
include "../../config/koneksi.php";

$page=$_GET[page];
$act=$_GET[act];

// Hapus pembeli
if ($page=='pembeli' AND $act=='hapus'){
  mysql_query("DELETE FROM pembeli WHERE kode_pembeli='$_GET[id]'");
  header('location:../../main.php?page='.$page);
}

// Input pembeli
elseif ($page=='pembeli' AND $act=='input'){
$kode_pembeli=mysql_real_escape_string($_POST[kode_pembeli]);
$nama_pembeli=mysql_real_escape_string($_POST[nama_pembeli]);
$alamat_pembeli=mysql_real_escape_string($_POST[alamat_pembeli]);
$no_telp_pembeli=mysql_real_escape_string($_POST[no_telp_pembeli]);
mysql_query("INSERT INTO pembeli
	                       VALUES(
				'$kode_pembeli',
				'$nama_pembeli',
				'$alamat_pembeli',
				'$no_telp_pembeli')");
  header('location:../../main.php?page='.$page);
}

// Update pembeli
elseif ($page=='pembeli' AND $act=='update'){
$kode_pembeli=mysql_real_escape_string($_POST[kode_pembeli]);
$nama_pembeli=mysql_real_escape_string($_POST[nama_pembeli]);
$alamat_pembeli=mysql_real_escape_string($_POST[alamat_pembeli]);
$no_telp_pembeli=mysql_real_escape_string($_POST[no_telp_pembeli]);
  mysql_query("UPDATE pembeli SET
					kode_pembeli   = '$kode_pembeli',
					nama_pembeli   = '$nama_pembeli',
					alamat_pembeli   = '$alamat_pembeli',
					no_telp_pembeli   = '$no_telp_pembeli'
                           WHERE kode_pembeli       = '$_POST[id]'");
  header('location:../../main.php?page='.$page);
 }
 
?>