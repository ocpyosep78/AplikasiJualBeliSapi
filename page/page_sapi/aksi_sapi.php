<?php
session_start();
include "../../config/koneksi.php";

$page=$_GET[page];
$act=$_GET[act];

// Hapus sapi
if ($page=='sapi' AND $act=='hapus'){
  mysql_query("DELETE FROM sapi WHERE kode_sapi='$_GET[id]'");
  header('location:../../main.php?page='.$page);
}

// Input sapi
elseif ($page=='sapi' AND $act=='input'){
$kode_sapi=mysql_real_escape_string($_POST[kode_sapi]);
$kode_jenis_sapi=mysql_real_escape_string($_POST[kode_jenis_sapi]);
$berat_sapi=mysql_real_escape_string($_POST[berat_sapi]);
$harga_sapi=mysql_real_escape_string($_POST[harga_sapi]);
$jumlah_sapi=mysql_real_escape_string($_POST[jumlah_sapi]);
mysql_query("INSERT INTO sapi
	                       VALUES(
				'$kode_sapi',
				'$kode_jenis_sapi',
				'$harga_sapi',
				'$berat_sapi',
				'$jumlah_sapi')");
  header('location:../../main.php?page='.$page);
}

// Update sapi
elseif ($page=='sapi' AND $act=='update'){
$kode_sapi=mysql_real_escape_string($_POST[kode_sapi]);
$kode_jenis_sapi=mysql_real_escape_string($_POST[kode_jenis_sapi]);
$berat_sapi=mysql_real_escape_string($_POST[berat_sapi]);
$harga_sapi=mysql_real_escape_string($_POST[harga_sapi]);
$jumlah_sapi=mysql_real_escape_string($_POST[jumlah_sapi]);
  mysql_query("UPDATE sapi SET
					kode_sapi   = '$kode_sapi',
					kode_jenis_sapi   = '$kode_jenis_sapi',
					berat_sapi   = '$berat_sapi',
					harga_sapi   = '$harga_sapi',
					jumlah_sapi   = '$jumlah_sapi'
                           WHERE kode_sapi       = '$_POST[id]'");
  header('location:../../main.php?page='.$page);
 }
 
?>