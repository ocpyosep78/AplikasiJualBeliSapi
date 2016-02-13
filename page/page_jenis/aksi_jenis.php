<?php
session_start();
include "../../config/koneksi.php";

$page=$_GET[page];
$act=$_GET[act];

// Hapus jenis
if ($page=='jenis' AND $act=='hapus'){
  mysql_query("DELETE FROM jenis WHERE kode_jenis_sapi='$_GET[id]'");
  header('location:../../main.php?page='.$page);
}

// Input jenis
elseif ($page=='jenis' AND $act=='input'){
$kode_jenis_sapi=mysql_real_escape_string($_POST['kode_jenis_sapi']);
$keterangan_sapi=mysql_real_escape_string($_POST['keterangan_sapi']);
mysql_query("INSERT INTO jenis
	                       VALUES(
				'$kode_jenis_sapi',
				'$keterangan_sapi')");
  header('location:../../main.php?page='.$page);
}

// Update jenis
elseif ($page=='jenis' AND $act=='update'){
$kode_jenis_sapi=mysql_real_escape_string($_POST['kode_jenis_sapi']);
$keterangan_sapi=mysql_real_escape_string($_POST['keterangan_sapi']);
  mysql_query("UPDATE jenis SET
					kode_jenis_sapi   = '$kode_jenis_sapi',
					keterangan_sapi   = '$keterangan_sapi'
                           WHERE kode_jenis_sapi       = '$_POST[id]'");
  header('location:../../main.php?page='.$page);
 }
 
?>